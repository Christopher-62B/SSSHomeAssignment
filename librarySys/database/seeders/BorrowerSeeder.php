<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Borrower;

class BorrowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Borrower::create([
            'name' => 'Alice Borg',
            'email' => 'alice@example.com',
        ]);

        Borrower::create([
            'name' => 'Mark Camilleri',
            'email' => 'mark@example.com',
        ]);
    }
}
