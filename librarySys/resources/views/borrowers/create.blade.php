@extends('layouts.app')

@section('title', 'Add Borrower')

@section('content')
    <h1 class="mb-3">Add Borrower</h1>
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

    <form method="POST" action="/borrowers">
        @csrf

        <div class="mb-3">
            <label class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
        </div>


        <button type="submit" class="btn btn-primary">Save Borrower</button>
        <a href="/loans/create" class="btn btn-outline-secondary ms-2">Back</a>
    </form>
@endsection
