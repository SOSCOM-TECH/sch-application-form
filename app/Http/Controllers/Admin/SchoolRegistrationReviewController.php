<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\SchoolRegistrationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SchoolRegistrationReviewController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->get('status', 'pending');
        $requests = SchoolRegistrationRequest::where('status', $status)
            ->latest()
            ->paginate(20);
        return view('admin.requests.index', compact('requests', 'status'));
    }

    public function show(SchoolRegistrationRequest $requestModel): View
    {
        return view('admin.requests.show', ['request' => $requestModel]);
    }

    public function approve(SchoolRegistrationRequest $requestModel): RedirectResponse
    {
        if ($requestModel->status !== 'pending') {
            return back()->with('status', 'Request is not pending.');
        }

        // Create School
        $school = School::create([
            'user_id' => $requestModel->user_id,
            'name' => $requestModel->school_name,
            'type' => $requestModel->school_type,
            'registration_number' => $requestModel->registration_number,
            'logo_path' => $requestModel->logo_path,
            'address' => $requestModel->address,
            'status' => 'active',
        ]);

        // Update request status
        $requestModel->update([
            'status' => 'approved',
            'rejection_reason' => null,
        ]);

        return redirect()->route('admin.requests.show', $requestModel)->with('status', 'Request approved and school created.');
    }

    public function reject(Request $httpRequest, SchoolRegistrationRequest $requestModel): RedirectResponse
    {
        $validated = $httpRequest->validate([
            'rejection_reason' => ['required', 'string', 'max:2000'],
        ]);

        $requestModel->update([
            'status' => 'rejected',
            'rejection_reason' => $validated['rejection_reason'],
        ]);

        return redirect()->route('admin.requests.show', $requestModel)->with('status', 'Request rejected.');
    }
}


