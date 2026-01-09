<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use Illuminate\Http\Request;

class BorrowerController extends Controller
{
    public function create()
    {
        return view('borrowers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:borrowers,email'],
        ]);

        Borrower::create($validated);

        return redirect('/loans/create')->with('success', 'Borrower added successfully.');
    }
}
