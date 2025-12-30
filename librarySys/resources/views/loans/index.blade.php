@extends('layouts.app')

@section('title', 'Loans')

@section('content')
    <h1>Loans</h1>

    @if (session('success'))
        <p style="color: green;"><strong>{{ session('success') }}</strong></p>
    @endif

    @if ($loans->isEmpty())
        <p>No loans yet.</p>
    @else
        <table border="1" cellpadding="8">
            <thead>
            <tr>
                <th>Book</th>
                <th>Borrower</th>
                <th>Borrowed At</th>
                <th>Due Date</th>
                <th>Returned At</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($loans as $loan)
                <tr>
                    <td>
                        {{ $loan->book->title }}
                        — {{ $loan->book->author->name }}
                    </td>
                    <td>{{ $loan->borrower->name }}</td>
                    <td>{{ $loan->borrowed_at }}</td>
                    <td>{{ $loan->due_date }}</td>
                    <td>{{ $loan->returned_at ?? 'Not returned' }}</td>
                    <td>
                        @if($loan->returned_at === null)
                            <form method="POST" action="/loans/{{ $loan->id }}/return">
                                @csrf
                                <button type="submit">Mark Returned</button>
                            </form>
                        @else
                            —
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
