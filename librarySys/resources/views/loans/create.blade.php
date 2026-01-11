@extends('layouts.app')

@section('title', 'Borrow a Book')

@section('content')
    <h1 class="mb-3">Borrow a Book</h1>
    <p class="text-muted"><span class="text-danger">*</span> Required fields</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/loans">
        @csrf

        <div class="mb-3">
            <label class="form-label">Borrower <span class="text-danger">*</span></label>
            <select name="borrower_id" class="form-select" required>
                <option value="">-- Select Borrower --</option>
                @foreach ($borrowers as $borrower)
                    <option value="{{ $borrower->id }}" @selected(old('borrower_id') == $borrower->id)>
                        {{ $borrower->name }} ({{ $borrower->email }})
                    </option>
                @endforeach
            </select>
            <div class="form-text">
                If the borrower is not listed, add them using <a href="/borrowers/create">Add Borrower</a>.
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Book <span class="text-danger">*</span></label>
            <select name="book_id" class="form-select" required>
                <option value="">-- Select Book --</option>
                @foreach ($books as $book)
                    <option value="{{ $book->id }}" @selected(old('book_id') == $book->id)>
                        {{ $book->title }} — {{ $book->author->name }}
                        @if(!$book->available)
                            (Not available)
                        @endif
                    </option>
                @endforeach
            </select>
            <div class="form-text">
                Only available books should be borrowed.
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Due Date <span class="text-danger">*</span></label>
            <input type="date" name="due_date" value="{{ old('due_date') }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Loan</button>
        <a href="/loans" class="btn btn-outline-secondary ms-2">Back</a>
    </form>
@endsection
