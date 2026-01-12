<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    

    public function run(): void
    {
        //Authors
        $orwell = Author::where('name', 'George Orwell')->first();
        $tolkien = Author::where('name', 'J. R. R. Tolkien')->first();
        $agatha = Author::where('name', 'Agatha Christie')->first();
        $stephen = Author::where('name', 'Stephen King')->first();
        $jane = Author::where('name', 'Jane Austen')->first();
        $ernest = Author::where('name', 'Ernest Hemingway')->first();
        $isaac = Author::where('name', 'Isaac Asimov')->first();
        $mark = Author::where('name', 'Mark Twain')->first();

        //Categories
        $fiction = Category::where('name', 'Fiction')->first();
        $fantasy = Category::where('name', 'Fantasy')->first();
        $scifi = Category::where('name', 'Sci-Fi')->first();
        $mystery = Category::where('name', 'Mystery')->first();
        $history = Category::where('name', 'History')->first();
        $romance = Category::where('name', 'Romance')->first();
        $nonfic = Category::where('name', 'Non-Fiction')->first();

        Book::create([
            'title' => '1984',
            'slug' => Str::slug('1984'),
            'isbn' => '9780451524935',
            'published_year' => 1949,
            'author_id' => $orwell->id,
            'category_id' => $fiction->id,
            'available' => true,
        ]);

        Book::create([
            'title' => 'The Hobbit',
            'slug' => Str::slug('The Hobbit'),
            'isbn' => '9780547928227',
            'published_year' => 1937,
            'author_id' => $tolkien->id,
            'category_id' => $fantasy->id,
            'available' => true,
        ]);

        Book::create([
            'title' => 'The Lord Of the Rings',
            'slug' => Str::slug('The Lord Of the Rings'),
            'isbn' => '9788845292613',
            'published_year' => 1954,
            'author_id' => $tolkien->id,
            'category_id' => $fantasy->id,
            'available' => true,
        ]);

        Book::create([
            'title' => 'Animal Farm',
            'slug' => Str::slug('Animal Farm'),
            'isbn' => '9780194267533',
            'published_year' => 1945,
            'author_id' => $orwell->id,
            'category_id' => $fiction->id,
            'available' => true,
        ]);
    }

}
