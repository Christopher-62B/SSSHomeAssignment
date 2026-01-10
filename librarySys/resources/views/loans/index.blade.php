@extends('layouts.app')

@section('title', 'Loans')

@section('content')
    <h1 class="mb-4">Loans</h1>

    @if ($loans->isEmpty())
        <p>No loans yet.</p>
    @else
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
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

                    @php
                        $isOverdue = $loan->returned_at === null
                            && \Carbon\Carbon::parse($loan->due_date)->lt(now()->startOfDay());

                        $daysOverdue = $isOverdue
                            ? \Carbon\Carbon::parse($loan->due_date)->diffInDays(now()->startOfDay())
                            : 0;
                    @endphp

                    <tr class="{{ $isOverdue ? 'table-danger' : '' }}">
                        <td>
                            {{ $loan->book->title }}
                            <br>
                            <small class="text-muted">
                                {{ $loan->book->author->name }}
                            </small>
                        </td>

                        <td>{{ $loan->borrower->name }}</td>
                        <td>{{ $loan->borrowed_at }}</td>

                        <td>
                            {{ $loan->due_date }}
                            @if($isOverdue)
                                <span class="badge bg-danger ms-2">
                                    OVERDUE {{ $daysOverdue }} day{{ $daysOverdue === 1 ? '' : 's' }}
                                </span>
                            @endif
                        </td>

                        <td>
                            {{ $loan->returned_at ?? 'Not returned' }}
                        </td>

                        <td>
                            @if($loan->returned_at === null)
                                <form method="POST" action="/loans/{{ $loan->id }}/return">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">
                                        Mark Returned
                                    </button>
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
