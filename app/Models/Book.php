<?php

namespace App\Models;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

    // untuk protect data yg diisi
    protected $fillable = ['title','price','synopsis'];

    public function authors(){
        return $this->belongsToMany(Author::class, 'author_book');
    }
}
