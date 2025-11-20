<?php

namespace App\Http\Controllers\Representative;

use App\Http\Controllers\Controller;
use App\Models\SchoolRegistrationRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SchoolRegistrationRequestController extends Controller
{
    public function create(Request $request): View|RedirectResponse
    {
        $existing = Auth::user()->schoolRegistrationRequest;
        if ($existing) {
            return redirect()->route('rep.requests.show', $existing);
        }
       // Pass commission to the view
       $commission = $request->query('commission', 15); // Default to 15 if not provided
        
       return view('representative.requests.create', compact('commission'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'school_name' => ['required', 'string', 'max:255'],
            'school_type' => ['nullable', 'string', 'max:100'],
            'registration_number' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'commission_rate' => ['required', 'numeric', 'in:10,15'], // Validate it's either 10 or 15
            'logo' => ['nullable', 'image', 'max:2048'],
            'proof_documents.*' => ['nullable', 'file', 'max:4096'],
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('schools/logos', 'public');
        }

        $proofPaths = [];
        if ($request->hasFile('proof_documents')) {
            foreach ($request->file('proof_documents') as $doc) {
                $proofPaths[] = $doc->store('schools/proofs', 'public');
            }
        }

        $req = SchoolRegistrationRequest::create([
            'user_id' => Auth::id(),
            'school_name' => $validated['school_name'],
            'school_type' => $validated['school_type'] ?? null,
            'registration_number' => $validated['registration_number'] ?? null,
            'logo_path' => $logoPath,
            'address' => $validated['address'] ?? null,
            'commission_rate' => $validated['commission_rate'],
            'proof_documents' => $proofPaths ?: null,
            'status' => 'pending',
        ]);

        return redirect()->route('rep.requests.show', $req)->with('status', 'Registration request submitted.');
    }

    public function show(SchoolRegistrationRequest $requestModel): View
    {
        $this->authorizeView($requestModel);
        return view('representative.requests.show', ['request' => $requestModel]);
    }

    protected function authorizeView(SchoolRegistrationRequest $requestModel): void
    {
        abort_unless($requestModel->user_id === Auth::id(), 403);
    }
}


