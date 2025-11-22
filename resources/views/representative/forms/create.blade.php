<x-app-layout>

    <div class="row align-items-center mb-3 border-bottom">
        <div class="col">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">
                        Create New Form
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('rep.forms.store') }}" id="formCreateForm">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label class="form-label">Form Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                       value="{{ old('title') }}" required>
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Application Fee (TZS)</label>
                                <input type="number" name="application_fee" class="form-control @error('application_fee') is-invalid @enderror"
                                       value="{{ old('application_fee', 0) }}" min="0">
                                <x-input-error :messages="$errors->get('application_fee')" class="mt-2" />
                            </div>
                        </div>

                        <hr class="my-4">

                        <h5 class="mb-3">Payment Account Configuration</h5>
                        <p class="text-muted small mb-4">Configure where you want to receive payments for this form. This cannot be changed later.</p>

                        @if($paymentAccounts && $paymentAccounts->count() > 0)
                            <div class="form-group mb-4">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="use_existing_account"
                                           id="useExisting" value="1" {{ old('use_existing_account', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="useExisting">
                                        <strong>Use Existing Payment Account</strong>
                                    </label>
                                </div>
                                <select name="payment_account_id" id="payment_account_id"
                                        class="form-control @error('payment_account_id') is-invalid @enderror"
                                        style="{{ old('use_existing_account', true) ? '' : 'display:none;' }}">
                                    <option value="">-- Select Account --</option>
                                    @foreach($paymentAccounts as $account)
                                        <option value="{{ $account->id }}" {{ old('payment_account_id') == $account->id ? 'selected' : '' }}>
                                            {{ $account->display_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('payment_account_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="use_existing_account"
                                           id="createNew" value="0" {{ old('use_existing_account') === '0' || old('use_existing_account') === false ? 'checked' : '' }}>
                                    <label class="form-check-label" for="createNew">
                                        <strong>Create New Payment Account</strong>
                                    </label>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-info mb-4">
                                <i class="ti ti-info-alt"></i> No existing payment accounts. Please create a new one below.
                            </div>
                            <input type="hidden" name="use_existing_account" value="0">
                        @endif

                        <div id="newAccountSection" style="{{ ($paymentAccounts && $paymentAccounts->count() > 0 && old('use_existing_account', true)) ? 'display:none;' : '' }}">
                            <div class="form-group mb-3">
                                <label class="form-label">Payment Type <span class="text-danger">*</span></label>
                                <select name="payment_type" id="payment_type"
                                        class="form-control @error('payment_type') is-invalid @enderror" required>
                                    <option value="">-- Select Type --</option>
                                    <option value="bank" {{ old('payment_type') == 'bank' ? 'selected' : '' }}>Bank Account</option>
                                    <option value="mobile" {{ old('payment_type') == 'mobile' ? 'selected' : '' }}>Mobile Money</option>
                                </select>
                                @error('payment_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Bank Account Fields --}}
                            <div id="bankFields" style="display:none;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Bank <span class="text-danger">*</span></label>
                                            <select name="bank_provider" id="bank_provider"
                                                    class="form-control @error('bank_provider') is-invalid @enderror">
                                                <option value="">-- Select Bank --</option>
                                                <option value="CRDB" {{ old('bank_provider') == 'CRDB' ? 'selected' : '' }}>CRDB</option>
                                                <option value="NMB" {{ old('bank_provider') == 'NMB' ? 'selected' : '' }}>NMB</option>
                                                <option value="NBC" {{ old('bank_provider') == 'NBC' ? 'selected' : '' }}>NBC</option>
                                            </select>
                                            @error('bank_provider')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Account Number <span class="text-danger">*</span></label>
                                            <input type="text" name="account_number" id="account_number"
                                                   class="form-control @error('account_number') is-invalid @enderror"
                                                   value="{{ old('account_number') }}">
                                            @error('account_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Account Name <span class="text-danger">*</span></label>
                                    <input type="text" name="account_name" id="account_name"
                                           class="form-control @error('account_name') is-invalid @enderror"
                                           value="{{ old('account_name') }}">
                                    @error('account_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Mobile Money Fields --}}
                            <div id="mobileFields" style="display:none;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Mobile Provider <span class="text-danger">*</span></label>
                                            <select name="mobile_provider" id="mobile_provider"
                                                    class="form-control @error('mobile_provider') is-invalid @enderror">
                                                <option value="">-- Select Provider --</option>
                                                <option value="mpesa" {{ old('mobile_provider') == 'mpesa' ? 'selected' : '' }}>M-Pesa</option>
                                                <option value="tigopesa" {{ old('mobile_provider') == 'tigopesa' ? 'selected' : '' }}>TigoPesa</option>
                                                <option value="airtel_money" {{ old('mobile_provider') == 'airtel_money' ? 'selected' : '' }}>Airtel Money</option>
                                                <option value="halo_pesa" {{ old('mobile_provider') == 'halo_pesa' ? 'selected' : '' }}>Halo Pesa</option>
                                            </select>
                                            @error('mobile_provider')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                            <input type="text" name="phone_number" id="phone_number"
                                                   class="form-control @error('phone_number') is-invalid @enderror"
                                                   value="{{ old('phone_number') }}"
                                                   placeholder="07XXXXXXXX or 06XXXXXXXX"
                                                   maxlength="10">
                                            <small class="form-text text-muted">Must start with 07 or 06, 10 digits total</small>
                                            @error('phone_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Mobile Account Name <span class="text-danger">*</span></label>
                                    <input type="text" name="mobile_name" id="mobile_name"
                                           class="form-control @error('mobile_name') is-invalid @enderror"
                                           value="{{ old('mobile_name') }}">
                                    @error('mobile_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="text-end">
                            <a href="{{ route('rep.forms.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Create Form</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const useExisting = document.getElementById('useExisting');
            const createNew = document.getElementById('createNew');
            const paymentAccountSelect = document.getElementById('payment_account_id');
            const newAccountSection = document.getElementById('newAccountSection');
            const paymentType = document.getElementById('payment_type');
            const bankFields = document.getElementById('bankFields');
            const mobileFields = document.getElementById('mobileFields');
            const form = document.getElementById('formCreateForm');

            function toggleAccountSection() {
                if (useExisting && useExisting.checked) {
                    newAccountSection.style.display = 'none';
                    if (paymentAccountSelect) {
                        paymentAccountSelect.style.display = 'block';
                        paymentAccountSelect.required = true;
                    }
                    // Clear and disable new account fields
                    const paymentType = document.getElementById('payment_type');
                    if (paymentType) {
                        paymentType.required = false;
                        paymentType.value = '';
                        togglePaymentFields();
                    }
                } else {
                    newAccountSection.style.display = 'block';
                    if (paymentAccountSelect) {
                        paymentAccountSelect.style.display = 'none';
                        paymentAccountSelect.required = false;
                        paymentAccountSelect.value = '';
                    }
                    const paymentType = document.getElementById('payment_type');
                    if (paymentType) {
                        paymentType.required = true;
                    }
                }
            }

            function togglePaymentFields() {
                const type = paymentType.value;
                if (type === 'bank') {
                    bankFields.style.display = 'block';
                    mobileFields.style.display = 'none';
                    document.getElementById('bank_provider').required = true;
                    document.getElementById('account_number').required = true;
                    document.getElementById('account_name').required = true;
                    document.getElementById('mobile_provider').required = false;
                    document.getElementById('phone_number').required = false;
                    document.getElementById('mobile_name').required = false;
                } else if (type === 'mobile') {
                    bankFields.style.display = 'none';
                    mobileFields.style.display = 'block';
                    document.getElementById('bank_provider').required = false;
                    document.getElementById('account_number').required = false;
                    document.getElementById('account_name').required = false;
                    document.getElementById('mobile_provider').required = true;
                    document.getElementById('phone_number').required = true;
                    document.getElementById('mobile_name').required = true;
                } else {
                    bankFields.style.display = 'none';
                    mobileFields.style.display = 'none';
                    document.getElementById('bank_provider').required = false;
                    document.getElementById('account_number').required = false;
                    document.getElementById('account_name').required = false;
                    document.getElementById('mobile_provider').required = false;
                    document.getElementById('phone_number').required = false;
                    document.getElementById('mobile_name').required = false;
                }
            }

            // Phone number validation
            const phoneInput = document.getElementById('phone_number');
            if (phoneInput) {
                phoneInput.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, ''); // Remove non-digits
                    if (value.length > 0 && !value.startsWith('07') && !value.startsWith('06')) {
                        value = value.substring(0, 0);
                    }
                    if (value.length > 10) {
                        value = value.substring(0, 10);
                    }
                    e.target.value = value;
                });
            }

            if (useExisting) {
                useExisting.addEventListener('change', toggleAccountSection);
            }
            if (createNew) {
                createNew.addEventListener('change', toggleAccountSection);
            }
            if (paymentType) {
                paymentType.addEventListener('change', togglePaymentFields);
            }

            // Initialize on page load
            toggleAccountSection();
            togglePaymentFields();
        });
    </script>

</x-app-layout>
