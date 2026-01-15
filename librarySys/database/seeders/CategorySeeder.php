<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    

    public function run(): void{
        $categories = [
            [
                'name' => 'Fiction',
                'description' => 'Fictional books',
            ],
            [
                'name' => 'Fantasy',
                'description' => 'Fantasy and adventure books',
            ],
            [
                'name' => 'Science Fiction',
                'description' => 'Science fiction and futuristic themes',
            ],
            [
                'name' => 'Mystery',
                'description' => 'Mystery and crime novels',
            ],
            [
                'name' => 'Romance',
                'description' => 'Romantic novels',
            ],
            [
                'name' => 'Non-Fiction',
                'description' => 'Based on real events and facts',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }

}
