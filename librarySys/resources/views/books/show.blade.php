@extends('layouts.app')

@section('title', $book->title)

@section('content')
    <div class="mb-3">
        <a href="/books/{{ $book->slug }}/edit" class="btn btn-outline-primary btn-sm">Edit</a>

        <form method="POST" action="/books/{{ $book->slug }}" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger btn-sm"
                    onclick="return confirm('Delete this book?');">
                Delete
            </button>
        </form>
    </div>


    <a href="/books">← Back to Books</a>

    <h1>{{ $book->title }}</h1>

    <p><strong>Author:</strong> {{ $book->author->name }}</p>
    <p><strong>Category:</strong> {{ $book->category->name }}</p>

    @if($book->isbn)
        <p><strong>ISBN:</strong> {{ $book->isbn }}</p>
    @endif

    @if($book->published_year)
        <p><strong>Published Year:</strong> {{ $book->published_year }}</p>
    @endif

    <p><strong>Available:</strong> {{ $book->available ? 'Yes' : 'No' }}</p>
@endsection
