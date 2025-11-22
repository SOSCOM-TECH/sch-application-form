<?php

namespace App\Http\Controllers\Representative;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\School;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SchoolRegistrationController extends Controller
{
    public function create(Request $request): View|RedirectResponse
    {
        $user = Auth::user();
        
        // Check if user already has a school
        if ($user->school) {
            return redirect()->route('client.dashboard')->with('status', 'You already have a registered school.');
        }

        $packageId = $request->query('package');
        $package = $packageId ? Package::where('id', $packageId)->where('is_active', true)->firstOrFail() : null;
        
        $packages = Package::where('is_active', true)->orderBy('sort_order')->get();

        return view('representative.school-registration.create', compact('package', 'packages'));
    }

    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();
        
        // Check if user already has a school
        if ($user->school) {
            return redirect()->route('client.dashboard')->with('status', 'You already have a registered school.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['nullable', 'string', 'max:100'],
            'registration_number' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:500'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'package_id' => ['required', 'exists:packages,id'],
            'logo' => ['nullable', 'image', 'max:2048'],
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('schools/logos', 'public');
        }

        $package = Package::findOrFail($validated['package_id']);

        $school = School::create([
            'user_id' => $user->id,
            'name' => $validated['name'],
            'type' => $validated['type'] ?? null,
            'registration_number' => $validated['registration_number'] ?? null,
            'address' => $validated['address'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'email' => $validated['email'] ?? null,
            'logo_path' => $logoPath,
            'package_id' => $package->id,
            'commission_rate' => $package->system_percentage, // Keep for backward compatibility
            'status' => 'pending', // Admin needs to activate
        ]);

        return redirect()->route('client.dashboard')->with('status', 'School registration submitted successfully! It will be reviewed by an administrator.');
    }

    public function show(): View|RedirectResponse
    {
        $user = Auth::user();
        $school = $user->school;

        if (!$school) {
            return redirect()->route('client.dashboard')->with('status', 'You need to register your school first.');
        }

        $school->load(['package', 'representative']);

        return view('representative.school-registration.show', compact('school'));
    }
}
