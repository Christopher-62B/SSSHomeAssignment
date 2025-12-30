@extends('layouts.app')

@section('title', 'Borrow a Book')

@section('content')
    <h1>Borrow a Book</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/loans">
        @csrf

        <div style="margin-bottom: 10px;">
            <label>Borrower:</label><br>
            <select name="borrower_id" required>
                <option value="">-- Select Borrower --</option>
                @foreach($borrowers as $borrower)
                    <option value="{{ $borrower->id }}" @selected(old('borrower_id') == $borrower->id)>
                        {{ $borrower->name }} ({{ $borrower->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 10px;">
            <label>Book (available only):</label><br>
            <select name="book_id" required>
                <option value="">-- Select Book --</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}" @selected(old('book_id') == $book->id)>
                        {{ $book->title }} — {{ $book->author->name }} ({{ $book->category->name }})
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 10px;">
            <label>Due date:</label><br>
            <input type="date" name="due_date" value="{{ old('due_date') }}" required>
        </div>

        <button type="submit">Create Loan</button>
    </form>
@endsection
