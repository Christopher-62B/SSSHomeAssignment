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
        $orwell = Author::where('name', 'George Orwell')->first();
        $tolkien = Author::where('name', 'J. R. R. Tolkien')->first();

        $fiction = Category::where('name', 'Fiction')->first();
        $fantasy = Category::where('name', 'Fantasy')->first();

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
    }

}
