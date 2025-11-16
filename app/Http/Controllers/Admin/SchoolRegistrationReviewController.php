<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\SchoolRegistrationRequest;
use App\Models\VerificationAudit;
use App\Models\ActivityLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SchoolApproved;
use App\Notifications\SchoolRejected;

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

        VerificationAudit::create([
            'school_registration_request_id' => $requestModel->id,
            'admin_user_id' => Auth::id(),
            'action' => 'approved',
            'note' => 'School approved and created',
        ]);

        ActivityLog::create([
            'type' => 'approval',
            'user_id' => Auth::id(),
            'school_id' => $school->id,
            'reference' => (string) $requestModel->id,
            'message' => 'School approved',
            'context' => ['school' => $school->only(['id','name']), 'request' => $requestModel->only(['id'])],
        ]);

        // Notify representative
        $requestModel->representative->notify(new SchoolApproved($school->name));

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

        VerificationAudit::create([
            'school_registration_request_id' => $requestModel->id,
            'admin_user_id' => Auth::id(),
            'action' => 'rejected',
            'note' => $validated['rejection_reason'],
        ]);

        ActivityLog::create([
            'type' => 'approval',
            'user_id' => Auth::id(),
            'school_id' => null,
            'reference' => (string) $requestModel->id,
            'message' => 'School request rejected',
            'context' => ['request' => $requestModel->only(['id']), 'reason' => $validated['rejection_reason']],
        ]);

        // Notify representative
        $requestModel->representative->notify(new SchoolRejected($validated['rejection_reason']));

        return redirect()->route('admin.requests.show', $requestModel)->with('status', 'Request rejected.');
    }
}


