<!DOCTYPE html>
<html>
<head>
    <title>{{ $book->title }}</title>
</head>
<body>
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
</body>
</html>
