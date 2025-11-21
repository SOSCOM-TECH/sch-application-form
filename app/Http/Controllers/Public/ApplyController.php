<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\Payment;
use App\Models\Submission;
use App\Models\SubmissionAnswer;
use App\Models\SubmissionDocument;
use App\Models\ActivityLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PaymentReceived;

class ApplyController extends Controller
{
    public function form(Request $request, string $slug): View
    {
        $form = Form::with('fields', 'documents', 'school')->where('slug', $slug)->firstOrFail();
        abort_unless($form->is_active, 404);

        return view('public.apply.form', compact('form'));
    }

    public function pay(Request $request, string $slug): View
    {
        $form = Form::with('school')->where('slug', $slug)->firstOrFail();
        abort_unless($form->is_active, 404);

        $subRef = $request->query('sub');
        $submission = $subRef ? Submission::where('reference', $subRef)->where('form_id', $form->id)->first() : null;
        abort_unless($submission, 404, 'Submission not found.');

        return view('public.apply.pay', compact('form', 'submission'));
    }

    public function simulate(Request $request, string $slug): RedirectResponse
    {
        $form = Form::with('school')->where('slug', $slug)->firstOrFail();
        abort_unless($form->is_active, 404);

        $validated = $request->validate([
            'phone' => ['required', 'string', 'max:20'],
            'sub' => ['required', 'string'],
        ]);

        $submission = Submission::where('reference', $validated['sub'])->where('form_id', $form->id)->first();
        abort_unless($submission, 404, 'Submission not found.');
        abort_unless(!$submission->payment_id, 400, 'Payment already completed for this submission.');

        $reference = strtoupper(Str::random(10));
        $commissionRate = (int) ($form->school->commission_rate ?? 15);
        $systemAmount = (int) round(($form->application_fee * $commissionRate) / 100);
        $schoolAmount = max(0, $form->application_fee - $systemAmount);
        $payment = Payment::create([
            'representative_id' => $form->school->user_id,
            'school_id' => $form->school_id,
            'form_id' => $form->id,
            'amount' => $form->application_fee,
            'commission_rate' => $commissionRate,
            'commission_amount' => $systemAmount,
            'net_amount' => $schoolAmount,
            'system_amount' => $systemAmount,
            'school_amount' => $schoolAmount,
            'reference' => $reference,
            'status' => 'success',
            'payer_phone' => $validated['phone'],
        ]);

        // Link payment to submission and update status
        $submission->update([
            'payment_id' => $payment->id,
            'status' => 'submitted',
        ]);

        ActivityLog::create([
            'type' => 'payment',
            'school_id' => $form->school_id,
            'form_id' => $form->id,
            'reference' => $payment->reference,
            'message' => 'Payment simulated success',
            'context' => [
                'amount' => $payment->amount,
                'commission' => $payment->commission_amount,
                'system_amount' => $payment->system_amount,
                'school_amount' => $payment->school_amount,
                'submission_ref' => $submission->reference,
            ],
        ]);

        // Notify representative
        $form->school->representative->notify(new PaymentReceived($payment, $form));

        return redirect()->route('public.apply.confirmation', [$form->slug, 'ref' => $submission->reference]);
    }

    public function submit(Request $request, string $slug): RedirectResponse
    {
        $form = Form::with('fields')->where('slug', $slug)->firstOrFail();
        abort_unless($form->is_active, 404);

        // Minimal validation: ensure required fields present
        $rules = [];
        foreach ($form->fields as $field) {
            $key = "fields.{$field->id}";
            switch ($field->type) {
                case 'file':
                    $rules[$key] = $field->required ? 'required|file|mimes:pdf,jpg,jpeg,png' : 'nullable|file|mimes:pdf,jpg,jpeg,png';
                    break;
                default:
                    $rules[$key] = $field->required ? 'required|string' : 'nullable|string';
                    break;
            }
        }
        $validated = $request->validate($rules);

        // Create submission without payment_id
        $submission = Submission::create([
            'form_id' => $form->id,
            'payment_id' => null,
            'reference' => 'SUB-'.strtoupper(Str::random(8)),
            'status' => 'pending_payment',
        ]);

        // Store answers and files
        foreach ($form->fields as $field) {
            $key = "fields.{$field->id}";
            if ($field->type === 'file' && $request->hasFile("fields.{$field->id}")) {
                $file = $request->file("fields.{$field->id}");
                $path = $file->store("submissions/{$submission->id}", 'public');
                SubmissionDocument::create([
                    'submission_id' => $submission->id,
                    'form_field_id' => $field->id,
                    'path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'mime_type' => $file->getClientMimeType(),
                ]);
            } else {
                $value = data_get($validated, $key);
                SubmissionAnswer::create([
                    'submission_id' => $submission->id,
                    'form_field_id' => $field->id,
                    'value' => $value,
                ]);
            }
        }

        ActivityLog::create([
            'type' => 'submission',
            'school_id' => $form->school_id,
            'form_id' => $form->id,
            'reference' => $submission->reference,
            'message' => 'Form submitted, awaiting payment',
        ]);

        // Redirect to payment page with submission reference
        return redirect()->route('public.apply.pay', [$form->slug, 'sub' => $submission->reference]);
    }

    public function confirmation(Request $request, string $slug): View
    {
        $form = Form::with('school')->where('slug', $slug)->firstOrFail();
        $ref = $request->query('ref');
        $submission = Submission::with('payment')->where('reference', $ref)->where('form_id', $form->id)->firstOrFail();
        
        // Ensure payment is completed
        abort_unless($submission->payment_id && $submission->payment, 403, 'Payment is required to view confirmation.');
        
        return view('public.apply.confirmation', compact('form', 'submission'));
    }
}


