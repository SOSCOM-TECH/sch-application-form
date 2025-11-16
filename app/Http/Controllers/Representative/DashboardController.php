<?php

namespace App\Http\Controllers\Representative;

use App\Http\Controllers\Controller;
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

        return view('representative.dashboard', [
            'school' => $school,
            // Placeholder stats until modules are implemented
            'applicantCount' => 0,
            'paidCount' => 0,
            'revenueTzs' => 0,
            'activeForm' => null,
            'applicationFee' => null,
        ]);
    }
}


