<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Author::factory(50)->create();
        // Book::each(function (Book $book) {
        //     $book->author_id = rand(1,30);
        //     $book->save();
        // });
        // $max_authors =  5;
        Book::each(function (Book $book)  {
            $authors_id = Author::inRandomOrder()->take(rand(1, 5))->pluck('id');
            $book->authors()->sync($authors_id);    
        });
    }

}
