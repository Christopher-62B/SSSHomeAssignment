@extends('layouts.app')

@section('title', 'Add Borrower')

@section('content')
    <h1>Add Borrower</h1>
    @if (session('success'))
        <p style="color: green;"><strong>{{ session('success') }}</strong></p> 
    @endif


    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/borrowers">
        @csrf

        <div style="margin-bottom: 10px;">
            <label>Name:</label><br>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label>Email:</label><br>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>

        

        <button type="submit">Save Borrower</button>
    </form>
@endsection
