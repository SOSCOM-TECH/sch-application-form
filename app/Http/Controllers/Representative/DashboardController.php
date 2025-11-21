<?php

namespace App\Http\Controllers\Representative;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\Payment;
use App\Models\Submission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View|RedirectResponse
    {
        $user = Auth::user();
        $school = $user->school;

        if (! $school) {
            return view('representative.awaiting');
        }

        $formIds = Form::where('school_id', $school->id)->pluck('id');
        $applicantCount = Submission::whereIn('form_id', $formIds)->count();
        $paidCount = Submission::whereIn('form_id', $formIds)->whereNotNull('payment_id')->count();

        $payments = Payment::where('school_id', $school->id)->where('status', 'success');
        $schoolAmountReceived = (clone $payments)->sum('school_amount');
        $schoolAmountWithdrawn = (clone $payments)->where('school_withdrawn', true)->sum('school_amount');
        $systemShareForSchool = (clone $payments)->sum('system_amount');
        $recentPayments = $payments->with('form')->latest()->take(8)->get();

        $activeForm = Form::where('school_id', $school->id)->where('is_active', true)->first();

        return view('representative.dashboard', [
            'school' => $school,
            'applicantCount' => $applicantCount,
            'paidCount' => $paidCount,
            'revenueTzs' => $schoolAmountReceived,
            'activeForm' => $activeForm,
            'applicationFee' => $activeForm?->application_fee,
            'schoolAmountReceived' => $schoolAmountReceived,
            'schoolAmountWithdrawn' => $schoolAmountWithdrawn,
            'schoolAmountOutstanding' => max($schoolAmountReceived - $schoolAmountWithdrawn, 0),
            'systemShareForSchool' => $systemShareForSchool,
            'recentPayments' => $recentPayments,
        ]);
    }
}


