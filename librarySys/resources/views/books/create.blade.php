@extends('layouts.app')

@section('title', 'Add Book')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Add Book</h1>
        <a class="btn btn-outline-secondary" href="/books">Back</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/books" class="card card-body">
        @csrf

        <div class="mb-3">
            <label class="form-label">Title <span class="text-danger">*</span></label>
            <input type="text" name="title" value="{{ old('title') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Author <span class="text-danger">*</span></label>
            <select name="author_id" class="form-select" required>
                <option value="">-- Select Author --</option>
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}" @selected(old('author_id') == $author->id)>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Category <span class="text-danger">*</span></label>
            <select name="category_id" class="form-select" required>
                <option value="">-- Select Category --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">ISBN (optional)</label>
            <input type="text" name="isbn" value="{{ old('isbn') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Published Year (optional)</label>
            <input type="number" name="published_year" value="{{ old('published_year') }}"
                   class="form-control" min="1000" max="{{ date('Y') }}">
        </div>

        <button class="btn btn-primary" type="submit">Save</button>
    </form>
@endsection
