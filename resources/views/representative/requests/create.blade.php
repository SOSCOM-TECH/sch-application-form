<x-app-layout>

    <div class="row page-titles mx-0 border">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>School Registration Request</h4>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('rep.requests.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">School Name</label>
                        <input type="text" class="form-control" name="school_name" value="{{ old('school_name') }}" required>
                        <x-input-error :messages="$errors->get('school_name')" class="mt-2" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">School Type</label>
                        <input type="text" class="form-control" name="school_type" value="{{ old('school_type') }}" placeholder="Secondary, College, etc.">
                        <x-input-error :messages="$errors->get('school_type')" class="mt-2" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Registration Number</label>
                        <input type="text" class="form-control" name="registration_number" value="{{ old('registration_number') }}">
                        <x-input-error :messages="$errors->get('registration_number')" class="mt-2" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Logo</label>
                        <input type="file" class="form-control" name="logo" accept="image/*">
                        <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Proof Documents (multiple allowed)</label>
                        <input type="file" class="form-control" name="proof_documents[]" multiple>
                        <x-input-error :messages="$errors->get('proof_documents')" class="mt-2" />
                    </div>
                </div>

                <div class="text-end">
                    <x-primary-button>Submit Request</x-primary-button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>


