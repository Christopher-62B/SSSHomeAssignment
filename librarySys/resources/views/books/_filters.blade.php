<form method="GET" action="/books" class="row g-3 mb-4">

    <div class="col-md-4">
        <label class="form-label">Category</label>
        <select name="category" class="form-select">
            <option value="">All categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(request('category') == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">Availability</label>
        <select name="available" class="form-select">
            <option value="">All</option>
            <option value="1" @selected(request('available') === '1')>Available only</option>
            <option value="0" @selected(request('available') === '0')>Not available</option>
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">Sort</label>
        <select name="sort" class="form-select">
            <option value="">Default</option>
            <option value="title_asc" @selected(request('sort') === 'title_asc')>Title (A–Z)</option>
            <option value="title_desc" @selected(request('sort') === 'title_desc')>Title (Z–A)</option>
            <option value="year_desc" @selected(request('sort') === 'year_desc')>Published Year (Newest)</option>
            <option value="year_asc" @selected(request('sort') === 'year_asc')>Published Year (Oldest)</option>
        </select>
    </div>

    <div class="col-12">
        <button class="btn btn-primary" type="submit">Apply</button>
        <a class="btn btn-outline-secondary ms-2" href="/books">Reset</a>
    </div>

</form>
