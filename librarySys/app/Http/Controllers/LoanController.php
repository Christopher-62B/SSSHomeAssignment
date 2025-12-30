<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrower;
use App\Models\Loan;

class LoanController extends Controller
{
    // List all loans
    public function index()
    {
        $loans = Loan::with(['book.author', 'borrower'])
            ->orderByDesc('borrowed_at')
            ->get();

        return view('loans.index', compact('loans'));
    }

    // Show borrow form
    public function create()
    {
        $borrowers = Borrower::orderBy('name')->get();

        // only show available books
        $books = Book::with(['author', 'category'])
            ->where('available', true)
            ->orderBy('title')
            ->get();

        return view('loans.create', compact('borrowers', 'books'));
    }

    // Store a new loan (borrow)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => ['required', 'exists:books,id'],
            'borrower_id' => ['required', 'exists:borrowers,id'],
            'due_date' => ['required', 'date', 'after_or_equal:today'],
        ]);

        // Safety: ensure book is still available
        $book = Book::findOrFail($validated['book_id']);
        if (!$book->available) {
            return back()->withErrors(['book_id' => 'This book is not available.'])->withInput();
        }

        Loan::create([
            'book_id' => $validated['book_id'],
            'borrower_id' => $validated['borrower_id'],
            'borrowed_at' => now(),
            'due_date' => $validated['due_date'],
            'returned_at' => null,
        ]);

        // mark book unavailable
        $book->available = false;
        $book->save();

        return redirect('/loans')->with('success', 'Loan created successfully.');
    }

    // Mark a loan as returned
    public function markReturned(Loan $loan)
    {
        if ($loan->returned_at !== null) {
            return redirect('/loans')->with('success', 'Loan already returned.');
        }

        $loan->returned_at = now();
        $loan->save();

        // mark book available again
        $book = $loan->book;
        $book->available = true;
        $book->save();

        return redirect('/loans')->with('success', 'Book marked as returned.');
    }
}
