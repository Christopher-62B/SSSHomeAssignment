<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use App\Models\Borrower;


class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'borrower_id',
        'borrowed_at',
        'due_date',
        'returned_at',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function borrower()
    {
        return $this->belongsTo(Borrower::class);
    }

}
