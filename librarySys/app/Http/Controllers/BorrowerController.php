<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

        // -------------------------------
        // External API validation (KU3.2)
        // Check if email domain has MX records via Google Public DNS
        // -------------------------------
        $domain = strtolower(substr(strrchr($validated['email'], "@"), 1));

        try {
            $response = Http::timeout(3)->get('https://dns.google/resolve', [
                'name' => $domain,
                'type' => 'MX',
            ]);

            if (!$response->successful()) {
                return back()
                    ->withInput()
                    ->withErrors(['email' => 'Could not validate email domain (DNS service unavailable). Try again.']);
            }

            $data = $response->json();

            // Google DNS JSON response includes "Answer" when records exist
            $hasMx = isset($data['Answer']) && is_array($data['Answer']) && count($data['Answer']) > 0;

            if (!$hasMx) {
                return back()
                    ->withInput()
                    ->withErrors(['email' => 'Email domain looks invalid (no MX record found).']);
            }
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['email' => 'Could not validate email domain (network error). Try again.']);
        }

        Borrower::create($validated);

        return redirect('/loans/create')->with('success', 'Borrower added successfully.');
    }

}
