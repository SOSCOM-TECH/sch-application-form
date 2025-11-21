<x-guest-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        @if ($form->school->logo_path)
                            <img src="{{ asset('storage/' . $form->school->logo_path) }}" alt="Logo" class="me-2" style="height:32px;">
                        @endif
                        <h4 class="mb-0">{{ $form->school->name }} — Application Payment</h4>
                    </div>
                    <div class="card-body">
                        @if(isset($submission))
                            <div class="alert alert-info mb-3">
                                <strong>Submission Reference:</strong> {{ $submission->reference }}
                            </div>
                        @endif
                        <p class="mb-3">Application fee: <strong>{{ number_format($form->application_fee) }} TZS</strong></p>
                        <p class="text-muted mb-3">Please complete your payment to finalize your application submission.</p>
                        <form method="POST" action="{{ route('public.apply.simulate', $form->slug) }}">
                            @csrf
                            @if(isset($submission))
                                <input type="hidden" name="sub" value="{{ $submission->reference }}">
                            @endif
                            <div class="mb-3">
                                <label class="form-label">Mobile Number</label>
                                <input type="text" name="phone" class="form-control" placeholder="e.g. 0712XXXXXX" required>
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>
                            <x-primary-button>Complete Payment</x-primary-button>
                        </form>
                        <p class="text-muted mt-3">Simulation only. Real integrations (M-Pesa, Airtel Money, Tigo Pesa) will be added later.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>



