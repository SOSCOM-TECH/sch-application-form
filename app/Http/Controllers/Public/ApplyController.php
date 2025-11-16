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
    public function pay(string $slug): View
    {
        $form = Form::with('school')->where('slug', $slug)->firstOrFail();
        abort_unless($form->is_active, 404);

        return view('public.apply.pay', compact('form'));
    }

    public function simulate(Request $request, string $slug): RedirectResponse
    {
        $form = Form::with('school')->where('slug', $slug)->firstOrFail();
        abort_unless($form->is_active, 404);

        $validated = $request->validate([
            'phone' => ['required', 'string', 'max:20'],
        ]);

        $reference = strtoupper(Str::random(10));
        $commissionRate = 15;
        $commissionAmount = (int) round(($form->application_fee * $commissionRate) / 100);
        $netAmount = max(0, $form->application_fee - $commissionAmount);
        $payment = Payment::create([
            'representative_id' => $form->school->user_id,
            'school_id' => $form->school_id,
            'form_id' => $form->id,
            'amount' => $form->application_fee,
            'commission_rate' => $commissionRate,
            'commission_amount' => $commissionAmount,
            'net_amount' => $netAmount,
            'reference' => $reference,
            'status' => 'success',
            'payer_phone' => $validated['phone'],
        ]);

        ActivityLog::create([
            'type' => 'payment',
            'school_id' => $form->school_id,
            'form_id' => $form->id,
            'reference' => $payment->reference,
            'message' => 'Payment simulated success',
            'context' => ['amount' => $payment->amount, 'commission' => $payment->commission_amount],
        ]);

        // Notify representative
        $form->school->representative->notify(new PaymentReceived($payment, $form));

        return redirect()->route('public.apply.form', [$form->slug, 'ref' => $payment->reference]);
    }

    public function form(Request $request, string $slug): View
    {
        $form = Form::with('fields', 'documents', 'school')->where('slug', $slug)->firstOrFail();
        abort_unless($form->is_active, 404);

        $ref = $request->query('ref');
        $payment = $ref ? Payment::where('reference', $ref)->where('form_id', $form->id)->where('status', 'success')->first() : null;
        abort_unless($payment, 403, 'Payment required to access this form.');

        return view('public.apply.form', compact('form', 'payment'));
    }

    public function submit(Request $request, string $slug): RedirectResponse
    {
        $form = Form::with('fields')->where('slug', $slug)->firstOrFail();
        abort_unless($form->is_active, 404);

        $ref = $request->input('ref');
        $payment = $ref ? Payment::where('reference', $ref)->where('form_id', $form->id)->where('status', 'success')->first() : null;
        abort_unless($payment, 403, 'Payment required to submit this form.');

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

        $submission = Submission::create([
            'form_id' => $form->id,
            'payment_id' => $payment->id,
            'reference' => 'SUB-'.strtoupper(Str::random(8)),
            'status' => 'submitted',
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
            'message' => 'Form submitted',
            'context' => ['payment_ref' => $payment->reference],
        ]);

        return redirect()->route('public.apply.confirmation', [$form->slug, 'ref' => $submission->reference]);
    }

    public function confirmation(Request $request, string $slug): View
    {
        $form = Form::with('school')->where('slug', $slug)->firstOrFail();
        $ref = $request->query('ref');
        $submission = Submission::with('payment')->where('reference', $ref)->where('form_id', $form->id)->firstOrFail();
        return view('public.apply.confirmation', compact('form', 'submission'));
    }
}


