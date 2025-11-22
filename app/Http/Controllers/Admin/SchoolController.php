<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SchoolController extends Controller
{
    public function index(Request $request): View
    {
        $query = School::query()->with('representative');
        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }
        if ($q = $request->get('q')) {
            $query->where('name', 'like', "%{$q}%");
        }
        $schools = $query->latest()->paginate(20)->withQueryString();
        return view('admin.schools.index', compact('schools'));
    }

    public function show(School $school): View
    {
        $school->load('representative');
        return view('admin.schools.show', compact('school'));
    }

    public function suspend(School $school): RedirectResponse
    {
        $school->update(['status' => 'suspended']);
        return back()->with('status', 'School suspended.');
    }

    public function activate(School $school): RedirectResponse
    {
        $school->update(['status' => 'active']);
        return back()->with('status', 'School activated.');
    }

    public function updatePackage(Request $request, School $school): RedirectResponse
    {
        $validated = $request->validate([
            'package_id' => ['nullable', 'exists:packages,id'],
        ]);

        $school->update(['package_id' => $validated['package_id'] ?? null]);

        $packageName = $school->package ? $school->package->name : 'legacy rate';
        return back()->with('status', "Package updated to: {$packageName}.");
    }
}


