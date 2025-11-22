<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PackageController extends Controller
{
    public function index(): View
    {
        $packages = Package::withCount('schools')->orderBy('sort_order')->orderBy('name')->paginate(20);
        return view('admin.packages.index', compact('packages'));
    }

    public function create(): View
    {
        return view('admin.packages.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'system_percentage' => ['required', 'integer', 'min:0', 'max:100'],
            'school_percentage' => ['required', 'integer', 'min:0', 'max:100'],
            'is_active' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'features' => ['nullable', 'array'],
        ]);

        // Ensure total doesn't exceed 100%
        $total = $validated['system_percentage'] + $validated['school_percentage'];
        if ($total > 100) {
            return back()->withErrors(['system_percentage' => 'Total percentage (system + school) cannot exceed 100%'])->withInput();
        }

        Package::create($validated);

        return redirect()->route('admin.packages.index')->with('status', 'Package created successfully.');
    }

    public function show(Package $package): View
    {
        $package->load('schools');
        return view('admin.packages.show', compact('package'));
    }

    public function edit(Package $package): View
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'system_percentage' => ['required', 'integer', 'min:0', 'max:100'],
            'school_percentage' => ['required', 'integer', 'min:0', 'max:100'],
            'is_active' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'features' => ['nullable', 'array'],
        ]);

        // Ensure total doesn't exceed 100%
        $total = $validated['system_percentage'] + $validated['school_percentage'];
        if ($total > 100) {
            return back()->withErrors(['system_percentage' => 'Total percentage (system + school) cannot exceed 100%'])->withInput();
        }

        $package->update($validated);

        return redirect()->route('admin.packages.index')->with('status', 'Package updated successfully.');
    }

    public function destroy(Package $package): RedirectResponse
    {
        // Check if package is in use
        if ($package->schools()->count() > 0) {
            return back()->withErrors(['error' => 'Cannot delete package that is assigned to schools.']);
        }

        $package->delete();

        return redirect()->route('admin.packages.index')->with('status', 'Package deleted successfully.');
    }
}
