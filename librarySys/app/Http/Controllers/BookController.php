<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{
    // Show a list of all books
   public function index(Request $request)
    {
        $query = Book::with(['author', 'category']);

        // Filtering: category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filtering: availability
        if ($request->filled('available')) {
            $query->where('available', $request->available);
        }

        // Sorting
        switch ($request->sort) {
            case 'title_asc':
                $query->orderBy('title', 'asc');
                break;
            case 'title_desc':
                $query->orderBy('title', 'desc');
                break;
            case 'year_asc':
                $query->orderBy('published_year', 'asc');
                break;
            case 'year_desc':
                $query->orderBy('published_year', 'desc');
                break;
            default:
                $query->orderBy('title', 'asc'); // sensible default
                break;
        }

        $books = $query->get();

        // Needed for the filters dropdown
        $categories = Category::orderBy('name')->get();

        return view('books.index', compact('books', 'categories'));
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
