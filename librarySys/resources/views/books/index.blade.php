@extends('layouts.app')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0">Books</h1>
    <a href="/books/create" class="btn btn-primary">Add Book</a>
</div>


@section('content')
    <h1 class="mb-4">Books</h1>

    @include('books._filters')

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
