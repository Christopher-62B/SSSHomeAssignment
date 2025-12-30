@extends('layouts.app')

@section('title', 'Books')

@section('content')
    <h1>Books</h1>

    <ul>
        @foreach ($books as $book)
            <li>
                <a href="/books/{{ $book->slug }}">
                    {{ $book->title }}
                </a>
                — {{ $book->author->name }} ({{ $book->category->name }})
            </li>
        @endforeach
    </ul>
@endsection
