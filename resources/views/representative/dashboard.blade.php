<x-app-layout>

    <div class="row page-titles mx-0 border">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>{{ $school->name }} — School Dashboard</h4>
                <span class="text-muted">Registration # {{ $school->registration_number ?? '—' }}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <span class="mr-3"><i class="ti ti-user"></i></span>
                        <div class="media-body text-right">
                            <p class="fs-14 mb-2">Applicants</p>
                            <span class="fs-28">{{ $applicantCount }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <span class="mr-3"><i class="ti ti-wallet"></i></span>
                        <div class="media-body text-right">
                            <p class="fs-14 mb-2">Paid</p>
                            <span class="fs-28">{{ $paidCount }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <span class="mr-3"><i class="ti ti-money"></i></span>
                        <div class="media-body text-right">
                            <p class="fs-14 mb-2">Revenue (TZS)</p>
                            <span class="fs-28">{{ number_format($revenueTzs) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <span class="mr-3"><i class="ti ti-agenda"></i></span>
                        <div class="media-body text-right">
                            <p class="fs-14 mb-2">Application Fee</p>
                            <span class="fs-28">{{ $applicationFee ? number_format($applicationFee) . ' TZS' : '—' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Active Form</h4>
                </div>
                <div class="card-body">
                    @if ($activeForm)
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="h5 mb-1">{{ $activeForm->title }}</div>
                                <div class="text-muted">Public link: <a href="#" target="_blank">Open</a></div>
                            </div>
                            <a href="#" class="btn btn-outline-primary btn-sm">Manage</a>
                        </div>
                    @else
                        <p class="mb-2">No active form yet.</p>
                        <a href="#" class="btn btn-primary">Create Application Form</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Quick Actions</h4>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="#" class="btn btn-outline-secondary"><i class="ti ti-pencil-alt"></i> Create Form</a>
                        <a href="#" class="btn btn-outline-secondary"><i class="ti ti-user"></i> View Applicants</a>
                        <a href="#" class="btn btn-outline-secondary"><i class="ti ti-wallet"></i> View Payments</a>
                        <a href="#" class="btn btn-outline-secondary"><i class="ti ti-share"></i> Share Public Link</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>


