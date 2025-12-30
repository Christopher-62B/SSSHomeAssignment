<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    // Show a list of all books
    public function index()
    {
        $books = Book::with(['author', 'category'])
            ->orderBy('title')
            ->get();

        return view('books.index', compact('books'));
    }

    // Show one book by slug
    public function show(string $slug)
    {
        $book = Book::with(['author', 'category'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('books.show', compact('book'));
    }
}
