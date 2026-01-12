<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;


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

    // Show form to create a new book
    public function create()
    {
        $authors = Author::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('books.create', compact('authors', 'categories'));
    }

    // Store the new book
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'isbn' => ['nullable', 'string', 'max:50'],
            'published_year' => ['nullable', 'integer', 'min:1000', 'max:' . now()->year],
            'author_id' => ['required', 'exists:authors,id'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        // Create unique SEO-friendly slug
        $baseSlug = Str::slug($validated['title']);
        $slug = $baseSlug;
        $counter = 2;

        while (Book::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        Book::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'isbn' => $validated['isbn'] ?? null,
            'published_year' => $validated['published_year'] ?? null,
            'author_id' => $validated['author_id'],
            'category_id' => $validated['category_id'],
            'available' => true,
        ]);

        return redirect('/books')->with('success', 'Book added successfully.');
    }

    // Show form to edit a book
    public function edit(string $slug)
    {
        $book = Book::where('slug', $slug)->firstOrFail();
        $authors = Author::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('books.edit', compact('book', 'authors', 'categories'));
    }

    // Update the book
    public function update(Request $request, string $slug)
    {
        $book = Book::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'isbn' => ['nullable', 'string', 'max:50'],
            'published_year' => ['nullable', 'integer', 'min:1000', 'max:' . now()->year],
            'author_id' => ['required', 'exists:authors,id'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        // If title changed, regenerate slug (keep unique)
        if ($validated['title'] !== $book->title) {
            $baseSlug = Str::slug($validated['title']);
            $newSlug = $baseSlug;
            $counter = 2;

            while (Book::where('slug', $newSlug)->where('id', '!=', $book->id)->exists()) {
                $newSlug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $book->slug = $newSlug;
        }

        $book->title = $validated['title'];
        $book->isbn = $validated['isbn'] ?? null;
        $book->published_year = $validated['published_year'] ?? null;
        $book->author_id = $validated['author_id'];
        $book->category_id = $validated['category_id'];
        $book->save();

        return redirect('/books/' . $book->slug)->with('success', 'Book updated successfully.');
    }

    // Delete a book (only if not on loan)
    public function destroy(string $slug)
    {
        $book = Book::where('slug', $slug)->firstOrFail();

        if (!$book->available) {
            return back()->with('success', 'Cannot delete: book is currently on loan.');
        }

        $book->delete();

        return redirect('/books')->with('success', 'Book deleted successfully.');
    }

}
