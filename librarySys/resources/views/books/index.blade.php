@extends('layouts.app')

@section('title', 'Books')

@section('content')
    <h1 class="mb-4">Books</h1>

    <table class="table table-striped table-hover align-middle">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>
                        <a href="/books/{{ $book->slug }}">
                            {{ $book->title }}
                        </a>
                    </td>
                    <td>{{ $book->author->name }}</td>
                    <td>{{ $book->category->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
