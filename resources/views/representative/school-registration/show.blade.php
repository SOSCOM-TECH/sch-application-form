<x-app-layout>

    <div class="row align-items-center mb-3 border-bottom">
        <div class="col">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">
                        Your School Details
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">School Information</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        @if($school->logo_path)
                            <div class="col-md-3 text-center mb-3">
                                <img src="{{ asset('storage/' . $school->logo_path) }}"
                                     alt="{{ $school->name }}"
                                     class="img-fluid rounded"
                                     style="max-height: 150px;">
                            </div>
                        @endif
                        <div class="{{ $school->logo_path ? 'col-md-9' : 'col-md-12' }}">
                            <dl class="row mb-0">
                                <dt class="col-sm-4">School Name:</dt>
                                <dd class="col-sm-8"><strong>{{ $school->name }}</strong></dd>

                                <dt class="col-sm-4">School Type:</dt>
                                <dd class="col-sm-8">{{ $school->type ?? '—' }}</dd>

                                <dt class="col-sm-4">Registration Number:</dt>
                                <dd class="col-sm-8">{{ $school->registration_number ?? '—' }}</dd>

                                <dt class="col-sm-4">Address:</dt>
                                <dd class="col-sm-8">{{ $school->address ?? '—' }}</dd>

                                <dt class="col-sm-4">Phone:</dt>
                                <dd class="col-sm-8">{{ $school->phone ?? '—' }}</dd>

                                <dt class="col-sm-4">Email:</dt>
                                <dd class="col-sm-8">{{ $school->email ?? '—' }}</dd>

                                <dt class="col-sm-4">Status:</dt>
                                <dd class="col-sm-8">
                                    <span class="badge badge-{{
                                        $school->status === 'active' ? 'success' :
                                        ($school->status === 'pending' ? 'warning' : 'secondary')
                                    }}">
                                        {{ ucfirst($school->status) }}
                                    </span>
                                    @if($school->status === 'pending')
                                        <small class="text-muted d-block mt-1">Awaiting administrator approval</small>
                                    @endif
                                </dd>

                                <dt class="col-sm-4">Registered:</dt>
                                <dd class="col-sm-8">{{ $school->created_at->format('F d, Y') }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            @if($school->package)
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0 text-white">Commission Package</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="mb-3">{{ $school->package->name }}</h6>
                                @if($school->package->description)
                                    <p class="text-muted">{{ $school->package->description }}</p>
                                @endif

                                <div class="mt-4">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span>Platform Commission:</span>
                                        <strong class="text-primary">{{ $school->package->system_percentage }}%</strong>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span>Your Earnings:</span>
                                        <strong class="text-success">{{ $school->package->school_percentage }}%</strong>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span><strong>Total:</strong></span>
                                        <strong>{{ $school->package->total_percentage }}%</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if($school->package->features && count($school->package->features) > 0)
                                    <h6 class="mb-3">Package Features:</h6>
                                    <ul class="list-unstyled">
                                        @foreach($school->package->features as $feature)
                                            <li class="mb-2">
                                                <i class="ti ti-check text-success mr-2"></i>
                                                {{ $feature }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Commission Package</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning mb-0">
                            <i class="ti ti-alert-circle"></i>
                            No package assigned. Using legacy commission rate: <strong>{{ $school->commission_rate ?? 15 }}%</strong>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Quick Info</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <small class="text-muted d-block">Representative</small>
                        <strong>{{ $school->representative->name }}</strong>
                        <br>
                        <small class="text-muted">{{ $school->representative->email }}</small>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <small class="text-muted d-block">Account Created</small>
                        <strong>{{ $school->created_at->format('M d, Y') }}</strong>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted d-block">Last Updated</small>
                        <strong>{{ $school->updated_at->format('M d, Y') }}</strong>
                    </div>
                </div>
            </div>

            @if($school->status === 'pending')
                <div class="card mb-3 border-warning">
                    <div class="card-body">
                        <div class="alert alert-warning mb-0">
                            <i class="ti ti-clock"></i>
                            <strong>Pending Approval</strong>
                            <p class="mb-0 mt-2 small">Your school registration is pending administrator review. You'll be notified once it's approved.</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">

                        @if($school->status === 'active')
                            <a href="{{ route('rep.forms.index') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="ti ti-file"></i> Manage Forms
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

