<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function index(Request $request): View
    {
        $query = Payment::with(['form', 'school', 'representative'])->latest();

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }
        if ($schoolId = $request->get('school_id')) {
            $query->where('school_id', $schoolId);
        }

        $payments = $query->paginate(20)->withQueryString();
        return view('admin.payments.index', compact('payments'));
    }
}


