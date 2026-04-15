<?php

namespace App\Http\Controllers;

// use App\Mail\welcomeEmail;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
// use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    
    //listing buku
    public function index(Request $request){
        
        // $book = DB::insert ('insert into books (id) values (:id)', ['id'=>10]);

        // 1. Ambil input dari user (jika ada)
            $search = $request->input('search');
            $category = $request->input('category');

        // 2. Mulakan query
            $query = Book::query();

        // 3. Logika Carian: Hanya berjalan jika user masukkan keyword
            if ($request->filled('search')) {
                if ($category == 'author') {
                    $query->whereHas('authors', function($q) use ($search) {
                        $q->where('name', 'LIKE', "%{$search}%");
                    });
                } else {
                    $query->where('title', 'LIKE', "%{$search}%");
                }
            }

        // 4. SET DEFAULT PAGINATION: Paparkan 10 data setiap halaman
            $senaraiBuku = $query->paginate(30);

        // 5. Kekalkan parameter search dalam link pagination
            $senaraiBuku->appends(['search' => $search, 'category' => $category]);  

            $book = Book::select(['id', 'title', 'price'])
            ->with('authors')->paginate(10);
    
            // untuk email
            // $emailData = [
            //     'name' => 'Hafizuddin',
            //     'code'=> 'abc123'
            // ];

            // Mail::to('hfzuddinnn@gmail.com')->send(new welcomeEmail($emailData));
            
            return view('books.senaraiBuku',['books'=> $book, 'search'=> $senaraiBuku]);
            // dd($book);
    }

    //papar satu buku
    public function show($id){
        $book = Book::with('authors')->findOrFail($id);
        return view('books.satuBuku', ['buku'=>$book]);
        
        // dd($book);
        // echo "<h2>Title</h2>: ".$book->title."<br>";
        // echo "<h2>Synopsis</h2>: ".$book->synopsis."<br>";
        // echo "<h2>Price</h2>: ".$book->price."<br>";
    }

    //papar senarai penulis
    public function authors(){
        $authors = Author::with('books')->paginate(20);

        return view('books.senaraiPenulis', ['penulis'=>$authors]);
    }

    //papar seorang penulis
    public function author($id){
        $authors = Author::with('books')->findOrFail($id);

        return view('books.penulis', ['penulis'=>$authors]);
    }

    //papar form kemaskini
    public function edit($id){
        
        //jika data tiada, akan return null dan bukan error404
        // ...Boleh guna firstOrfail() dengan where supaya dapat return 404 
        // $try=Book::where('id', $id)->first();
        // dd($try);

        // findorfail return pada error404
        $book = Book::findOrFail($id);
        $author = Author::all();
        return view('books.editBuku', ['buku'=>$book, 'author'=>$author]);
    }

    //kemaskini data sediaada
    public function update(Request $request, $id){
        
        //request adalah ambil data dari form

        $book = Book::findOrFail($id);

        // validate check input memenuhi syarat yang ditetapkan
        $validate = $request->validate([
            'title' => 'required|min:5|max:255',
            'price' => 'required|numeric',
            'synopsis' => 'required|min:10|max:1000',
            'author_id' => 'nullable|array', 
            'new_author' => 'nullable|string|min:10|max:30'
        ]);

        //  dd($request);
        // $book->title = $request->title;
        // $book->price = $request->price;
        // $book->synopsis = $request->synopsis;
        // $book->save();

        $book->update([
            'title' => $request->title,
            'price' => $request->price,
            'synopsis' => $request->synopsis,
        ]);

        $allSelectedIds = $request->author_id ?? [];
        if ($request->filled('new_author')) {
                $newAuthor = Author::firstOrCreate([
                    'name' => $request->new_author
                ]);
                
                // Masukkan ID author baru ini ke dalam array senarai tadi
                if (!in_array($newAuthor->id, $allSelectedIds)) {
                    $allSelectedIds[] = $newAuthor->id;
                }
            }

        // Kemaskini pivot table (Hanya ID dalam array ini akan kekal)
        $book->authors()->sync($allSelectedIds);

        return back()->with('success','Successfully updated book');
    }

    //papar form tambah data
    public function create(){
        //
        $authors = Author::all();
        // nama variable 'authors' mesti sama dengan yang di controller
        return view('books.tambahBuku', compact('authors'));   
    }

    //tambah data baru
    public function store(Request $request){
        //
        $validate = $request->validate([
            'title' => 'required|min:5|max:255',
            'price' => 'required|numeric',
            'synopsis' => 'required|min:10|max:1000',
            'author' => 'required'
            ]);
            // dd($request);

            // Cari jika ada, jika tiada terus 'create'
            $author = Author::firstOrCreate(
                ['name' => $request->author]
            );

            //tambah data guna model
            $book = Book::create($validate);
            $book->authors()->attach($author->id);

            return redirect()->route('senaraiBuku')->with('success','Successfully added new book');
    }

    //delete data
    public function destroy($id){
        $book = Book::findOrFail($id);
        
        // drop relationship in bridge table
        $book->authors()->detach();
        
        $book->delete();
        return back()->with('success','Successfully deleted book');
    }

    public function saveBookmarks($id)
    {
        $book = Book::with('authors')->findOrFail($id);
        
        // Ambil data bookmark sedia ada dari session (jika tiada, buat array kosong)
        $bookmarks = session()->get('bookmarks', []);

        // Jika ID buku sudah ada dalam session, kita buang (Unbookmark)
        if(isset($bookmarks[$id])) {
            unset($bookmarks[$id]);
            $status = 'Successfully removed bookmark!';
        } else {
            // Jika tiada, kita tambah (Bookmark)
            $bookmarks[$id] = [
                "title" => $book->title,
                "price" => $book->price,
                "synopsis" => $book->synopsis,
                "image" => $book->image ?? 'https://placehold.co/400x470',
                // "author" => $book->author
            ];
            $status = 'Successfully bookmarked buku!';
        }

        session()->put('bookmarks', $bookmarks);

        return redirect()->back()->with('success', $status);
    }

    public function showBookmarks()
    {
        $bookmarks = session()->get('bookmarks', []);
        return view('books.bookmark', compact('bookmarks'));
    }
}
