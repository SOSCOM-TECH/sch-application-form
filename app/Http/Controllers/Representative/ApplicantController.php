<?php

namespace App\Http\Controllers\Representative;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class ApplicantController extends Controller
{
    public function index(Request $request): View
    {
        $school = Auth::user()->school;
        abort_unless($school, 403);

        $query = Submission::with(['form', 'payment'])
            ->whereHas('form', fn($q) => $q->where('school_id', $school->id));

        if ($status = $request->get('payment_status')) {
            $query->whereHas('payment', fn($q) => $q->where('status', $status));
        }
        if ($from = $request->get('date_from')) {
            $query->whereDate('created_at', '>=', $from);
        }
        if ($to = $request->get('date_to')) {
            $query->whereDate('created_at', '<=', $to);
        }
        if ($completion = $request->get('completion_status')) {
            $query->where('status', $completion);
        }

        $submissions = $query->latest()->paginate(20)->withQueryString();
        $forms = Form::where('school_id', $school->id)->pluck('title', 'id');

        return view('representative.applicants.index', compact('submissions', 'forms'));
    }

    public function show(Submission $submission): View
    {
        $school = Auth::user()->school;
        abort_unless($school && $submission->form->school_id === $school->id, 403);
        $submission->load(['form.fields', 'answers.field', 'documents', 'payment']);
        return view('representative.applicants.show', compact('submission'));
    }

    public function exportCsv(Request $request)
    {
        $school = Auth::user()->school;
        abort_unless($school, 403);

        $submissions = Submission::with(['form', 'payment'])
            ->whereHas('form', fn($q) => $q->where('school_id', $school->id))
            ->latest()->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="applicants.csv"',
        ];

        $callback = function () use ($submissions) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Submission Ref', 'Form', 'Payment Ref', 'Payment Status', 'Amount', 'Date']);
            foreach ($submissions as $s) {
                fputcsv($handle, [
                    $s->reference,
                    $s->form->title,
                    optional($s->payment)->reference,
                    optional($s->payment)->status,
                    optional($s->payment)->amount,
                    $s->created_at,
                ]);
            }
            fclose($handle);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function exportXlsx(Request $request)
    {
        // Minimal XLSX via CSV content with Excel mime for compatibility
        $response = $this->exportCsv($request);
        $response->headers->set('Content-Disposition', 'attachment; filename="applicants.xlsx"');
        $response->headers->set('Content-Type', 'application/vnd.ms-excel');
        return $response;
    }

    public function exportPdf(Request $request)
    {
        // Render printable HTML (users can "Save as PDF" from browser)
        $school = Auth::user()->school;
        abort_unless($school, 403);

        $submissions = Submission::with(['form', 'payment'])
            ->whereHas('form', fn($q) => $q->where('school_id', $school->id))
            ->latest()->get();

        return view('representative.applicants.print', compact('submissions'));
    }
}

