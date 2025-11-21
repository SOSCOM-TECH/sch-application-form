<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\School;
use App\Models\SchoolRegistrationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $user = Auth::user();

        $adminMetrics = $user->hasRole('admin')
            ? $this->adminMetrics()
            : $this->emptyAdminMetrics();

        $school = $user->school;

        return view('dashboard', array_merge($adminMetrics, [
            'authSchool' => $school,
            'schoolPayoutSummary' => $school ? $this->schoolPayoutSummary($school->id) : $this->emptySchoolSummary(),
            'systemLedger' => $adminMetrics['systemLedger'] ?? collect(),
        ]));
    }

    protected function adminMetrics(): array
    {
        $payments = Payment::query()->where('status', 'success');

        $systemAmount = (clone $payments)->sum('system_amount');
        $schoolAmount = (clone $payments)->sum('school_amount');
        $systemWithdrawn = (clone $payments)->where('system_withdrawn', true)->sum('system_amount');
        $schoolWithdrawn = (clone $payments)->where('school_withdrawn', true)->sum('school_amount');

        return [
            'totalSchools' => School::count(),
            'pendingRequests' => SchoolRegistrationRequest::where('status', 'pending')->count(),
            'approvedRequests' => SchoolRegistrationRequest::where('status', 'approved')->count(),
            'totalRevenueTzs' => (clone $payments)->sum('amount'),
            'revenueGrowthPct' => null,
            'totalUsers' => User::count(),
            'systemAmountReceived' => $systemAmount,
            'systemAmountWithdrawn' => $systemWithdrawn,
            'systemAmountOutstanding' => max($systemAmount - $systemWithdrawn, 0),
            'schoolsAmountReceived' => $schoolAmount,
            'schoolsAmountWithdrawn' => $schoolWithdrawn,
            'schoolsAmountOutstanding' => max($schoolAmount - $schoolWithdrawn, 0),
            'systemLedger' => Payment::with('school')
                ->where('status', 'success')
                ->latest()
                ->take(8)
                ->get(),
        ];
    }

    protected function emptyAdminMetrics(): array
    {
        return [
            'totalSchools' => 0,
            'pendingRequests' => 0,
            'approvedRequests' => 0,
            'totalRevenueTzs' => 0,
            'revenueGrowthPct' => null,
            'totalUsers' => 0,
            'systemAmountReceived' => 0,
            'systemAmountWithdrawn' => 0,
            'systemAmountOutstanding' => 0,
            'schoolsAmountReceived' => 0,
            'schoolsAmountWithdrawn' => 0,
            'schoolsAmountOutstanding' => 0,
            'systemLedger' => collect(),
        ];
    }

    protected function schoolPayoutSummary(int $schoolId): array
    {
        $payments = Payment::where('school_id', $schoolId)->where('status', 'success');

        $schoolAmount = (clone $payments)->sum('school_amount');
        $schoolWithdrawn = (clone $payments)->where('school_withdrawn', true)->sum('school_amount');
        $systemShare = (clone $payments)->sum('system_amount');

        return [
            'received' => $schoolAmount,
            'withdrawn' => $schoolWithdrawn,
            'outstanding' => max($schoolAmount - $schoolWithdrawn, 0),
            'system_share' => $systemShare,
        ];
    }

    protected function emptySchoolSummary(): array
    {
        return [
            'received' => 0,
            'withdrawn' => 0,
            'outstanding' => 0,
            'system_share' => 0,
        ];
    }
}


