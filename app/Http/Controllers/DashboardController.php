<?php

namespace App\Http\Controllers;

// use App\Models\Author;
use App\Models\Book;
// use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index(){
        
        // $data=DB::select("
        // SELECT 
        //     (SELECT COUNT(*) FROM users) as total_users,
        //     (SELECT COUNT(*) FROM books) as total_books,
        //     (SELECT COUNT(*) FROM authors) as total_authors
        // ")[0],  ;

        $data = [
        'total' => DB::select("
            SELECT 
                (SELECT COUNT(*) FROM users) as total_users,
                (SELECT COUNT(*) FROM books) as total_books,
                (SELECT COUNT(*) FROM authors) as total_authors
        ")[0],

        'books' => Book::select(['id', 'title', 'price'])
                    ->with('authors')
                    ->paginate(10),
        ];

        // $books= Book::count();
        // $users = User::count();
        // $authors = Author::count();
        return view('dashboard', ['senaraiBuku' => $data['books'], 'totalBooks' => $data['total']->total_books, 'totalUsers' => $data['total']->total_users, 'totalAuthors' => $data['total']->total_authors]);
    }
}
