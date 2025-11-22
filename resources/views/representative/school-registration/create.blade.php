<x-app-layout>

    <div class="row align-items-center mb-3 border-bottom no-gutters">
        <div class="col">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">
                        School Registration
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="row my-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Register Your School</h4>
                </div>
                <div class="card-body">
                    @if($package)
                        <div class="alert alert-info mb-4">
                            <h6 class="alert-heading"><i class="ti ti-info-alt"></i> Selected Package</h6>
                            <p class="mb-1"><strong>{{ $package->name }}</strong></p>
                            <p class="mb-0">
                                Platform Commission: <strong>{{ $package->system_percentage }}%</strong> |
                                Your Earnings: <strong>{{ $package->school_percentage }}%</strong>
                            </p>
                            @if($package->description)
                                <p class="mb-0 mt-2"><small>{{ $package->description }}</small></p>
                            @endif
                        </div>
                    @endif

                    <form method="POST" action="{{ route('rep.school-registration.store') }}" enctype="multipart/form-data">
                        @csrf

                        @if($package)
                            <input type="hidden" name="package_id" value="{{ $package->id }}">
                        @else
                            <div class="form-group">
                                <label for="package_id">Select Package <span class="text-danger">*</span></label>
                                <select name="package_id" id="package_id" class="form-control @error('package_id') is-invalid @enderror" required>
                                    <option value="">-- Select a Package --</option>
                                    @foreach($packages as $pkg)
                                        <option value="{{ $pkg->id }}" {{ old('package_id') == $pkg->id ? 'selected' : '' }}>
                                            {{ $pkg->name }} (Platform: {{ $pkg->system_percentage }}%, School: {{ $pkg->school_percentage }}%)
                                        </option>
                                    @endforeach
                                </select>
                                @error('package_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="name">School Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">School Type</label>
                                    <select class="form-control @error('type') is-invalid @enderror"
                                            id="type" name="type">
                                        <option value="">-- Select Type --</option>
                                        <option value="Primary" {{ old('type') == 'Primary' ? 'selected' : '' }}>Primary</option>
                                        <option value="Secondary" {{ old('type') == 'Secondary' ? 'selected' : '' }}>Secondary</option>
                                        <option value="College" {{ old('type') == 'College' ? 'selected' : '' }}>College</option>
                                        <option value="University" {{ old('type') == 'University' ? 'selected' : '' }}>University</option>
                                        <option value="Other" {{ old('type') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="registration_number">Registration Number</label>
                                    <input type="text" class="form-control @error('registration_number') is-invalid @enderror"
                                           id="registration_number" name="registration_number" value="{{ old('registration_number') }}">
                                    @error('registration_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror"
                                      id="address" name="address" rows="2">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                           id="phone" name="phone" value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           id="email" name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="logo">School Logo</label>
                            <input type="file" class="form-control-file @error('logo') is-invalid @enderror"
                                   id="logo" name="logo" accept="image/*">
                            <small class="form-text text-muted">Maximum file size: 2MB. Supported formats: JPG, PNG</small>
                            @error('logo')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-check"></i> Submit Registration
                            </button>
                            <a href="{{ route('client.dashboard') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

