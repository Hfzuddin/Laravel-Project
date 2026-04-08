<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadualController;
use Illuminate\Support\Facades\Route;


//anonimous function/default
//untuk naming the route
Route::get('/', function () {
    return view('welcome');})->name('home');;

//redirect id@name yang ditetapkan sahaja boleh ke mainpage
Route::redirect('/apih', '/');

//'/link http', 'nama view@interface file', attribute@action
Route::view('/saya', 'pelajar',
    ['nama'=> 'Hafiz']);

//Route

//papar interface dalam view
Route::get('/submit',function(){
    return view('submit');
});  

//untuk form submit
Route::post('/submit', function(){
    echo "<h1>Data berjaya dihantar</h1>";
});

//get bersama dengan username @ id
Route::get('/hello/{nama?}', function($nama='Kamu lah'){
    echo "<h1>Selamat datang $nama</h1>";
});

//get dengan controller  [namaController, nama function]
Route::get('/jadual', [JadualController::class, 'index']);

//get dengan controller dan attribute  [namaController, nama function]

Route::get('/jadual/{subjek}', [JadualController::class, 'index']);

//resource router (semua ada)
// Route::resource('user', UserController::class);

//BookController
//nama link saya kena pastikan yg mana diatas dulu
Route::get('/buku/create', [BookController::class,'create'])->name('addBuku');
Route::get('/buku/{id}', [BookController::class,'show'])->name('satu');
Route::get('/buku/{id}/edit', [BookController::class,'edit'])->name('editBuku');
Route::post('/buku/{id}', [BookController::class,'update'])->name('updateBuku');
Route::get('/buku', [BookController::class,'index'])->name('senaraiBuku');
Route::post('/buku', [BookController::class,'store'])->name('simpanBuku');
Route::delete('/buku/{id}', [BookController::class,'destroy'])->name('deleteBuku');

//author list
Route::get('/authors', [BookController::class,'authors'])->name('penulis');
Route::get('/authors/{id}', [BookController::class,'author'])->name('satuPenulis');

// email
Route::get('/email/welcome', function(){
    return new App\Mail\welcomeEmail();
});


//dashboard guna middleware
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// cart
Route::get('/bookmarks', [BookController::class, 'showBookmarks'])->name('showBookmarks');
Route::get('/bookmarks/{id}', [BookController::class, 'saveBookmarks'])->name('saveBookmarks');










//model binding
// Route::get('/guru/{guru}',function(Teacher $guru)
// {
//     echo $guru->name;
// });

//naming model dgn nama login
// Route::get('/login', 
// [
//     AuthController::class,
//     'login'
// ])->name('login');


// //grouping model 
// Route::prefix('admin')->name('admin.')->middleware('auth')->group(function(){
// //url jadi admin/....(prefix diguna untuk URL)

// //admin.index
// Route::get('user', UserController::class, 'index')->name('index');
// //admin.show
// Route::get('user/{id}', UserController::class, 'show')->name('showId');
// //admin.create
// Route::post('user', UserController::class, 'create')->name('create');
// //admin.edit
// Route::get('user/{id}/edit', UserController::class, 'edit')->name('edit');
// //admin.update
// Route::post('user/{id}', UserController::class, 'update')->name('update');
// });