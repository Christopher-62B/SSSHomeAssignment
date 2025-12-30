<!DOCTYPE html>
<html>
<head>
    <title>Books</title>
</head>
<body>
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
</body>
</html>
