<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    

    public function run(): void{
            $authors = [
            [
                'name' => 'George Orwell',
                'bio'  => 'English novelist and essayist',
            ],
            [
                'name' => 'J. R. R. Tolkien',
                'bio'  => 'Author of The Lord of the Rings',
            ],
            [
                'name' => 'Agatha Christie',
                'bio'  => 'British writer known for detective novels',
            ],
            [
                'name' => 'Stephen King',
                'bio'  => 'American author of horror and suspense novels',
            ],
            [
                'name' => 'Jane Austen',
                'bio'  => 'English novelist known for romantic fiction',
            ],
            [
                'name' => 'Isaac Asimov',
                'bio'  => 'Science fiction writer and professor of biochemistry',
            ],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }
    }

}
