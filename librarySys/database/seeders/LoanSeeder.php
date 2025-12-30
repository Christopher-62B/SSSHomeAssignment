<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Loan;
use App\Models\Book;
use App\Models\Borrower;
use Carbon\Carbon;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $book = Book::first();
        $borrower = Borrower::first();

        if (!$book || !$borrower) {
            return;
        }

        Loan::create([
            'book_id' => $book->id,
            'borrower_id' => $borrower->id,
            'borrowed_at' => now(),
            'due_date' => now()->addDays(14)->toDateString(),
            'returned_at' => null,
        ]);
    }
}
