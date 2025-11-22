<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FraudLog;
use App\Models\VerificationAudit;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ComplianceController extends Controller
{
    public function audits(Request $request): View
    {
        $audits = VerificationAudit::with('school')->latest()->paginate(20);
        return view('admin.compliance.audits', compact('audits'));
    }

    public function fraud(Request $request): View
    {
        $logs = FraudLog::latest()->paginate(20);
        return view('admin.compliance.fraud', compact('logs'));
    }
}


