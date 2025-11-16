<x-guest-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0">Submission Received</h4>
                            <small class="text-muted">{{ $form->school->name }}</small>
                        </div>
                        <span class="badge badge-primary">Ref: {{ $submission->reference }}</span>
                    </div>
                    <div class="card-body">
                        <p>Thank you. Your application has been submitted successfully.</p>
                        <ul class="list-unstyled mb-3">
                            <li><strong>Form:</strong> {{ $form->title }}</li>
                            <li><strong>Payment Ref:</strong> {{ $submission->payment->reference }}</li>
                            <li><strong>Submission Ref:</strong> {{ $submission->reference }}</li>
                            <li><strong>Date:</strong> {{ $submission->created_at->format('Y-m-d H:i') }}</li>
                        </ul>
                        <button class="btn btn-outline-secondary" onclick="window.print()"><i class="ti ti-printer"></i> Print Confirmation</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>



