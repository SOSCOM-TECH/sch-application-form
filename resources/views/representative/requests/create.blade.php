<x-app-layout>



    <div class="row align-items-center mb-3 border-bottom no-gutters">
        <div class="col">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">
                        School Registration Request
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="row my-2">
        <div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('rep.requests.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- Hidden field to store commission rate --}}
                <input type="hidden" name="commission_rate" value="{{ $commission ?? 15 }}">
                
                {{-- Display selected plan --}}
                <div class="alert alert-info mb-4">
                    <strong>Selected Plan:</strong> 
                    {{ $commission == 10 ? 'Premium Commission (10%)' : 'Standard Commission (15%)' }}
                </div>
                
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">School Name</label>
                        <input type="text" class="form-control" name="school_name" value="{{ old('school_name') }}" required>
                        <x-input-error :messages="$errors->get('school_name')" class="mt-2" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">School Type</label>
                        <input type="text" class="form-control" name="school_type" value="{{ old('school_type') }}" placeholder="Secondary, College, etc.">
                        <x-input-error :messages="$errors->get('school_type')" class="mt-2" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Registration Number</label>
                        <input type="text" class="form-control" name="registration_number" value="{{ old('registration_number') }}">
                        <x-input-error :messages="$errors->get('registration_number')" class="mt-2" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Logo</label>
                        <input type="file" class="form-control" name="logo" accept="image/*">
                        <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                    </div>
                    <div class="col-md-6">
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
        </div>
    </div>

</x-app-layout>


