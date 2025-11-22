<x-app-layout>

    <div class="row align-items-center mb-3 border-bottom no-gutters">
        <div class="col">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">
                        Dashboard
                    </a>
                </li>
            </ul>
        </div>
    </div>

    @role('school_representative')
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">School Verification Status</h4>
                    </div>
                    <div class="card-body">
                        @php
                            $school = auth()->user()->school;
                        @endphp

                        @if ($school)
                            <div class="alert alert-success">
                                <i class="ti ti-badge-check"></i>
                                Your school is verified and active. You can now access form builder, payments, and applicant dashboard.
                            </div>
                        @else
                            <div class="alert alert-info">
                                <i class="ti ti-info-alt"></i>
                                You don't have a school registered yet. Please Register.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @php($payoutSummary = $schoolPayoutSummary ?? ['received' => 0, 'withdrawn' => 0, 'outstanding' => 0, 'system_share' => 0])
        @if ($school)
            <div class="row mb-3">
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="media align-items-center">
                                <span class="mr-3"><i class="ti ti-wallet"></i></span>
                                <div class="media-body text-right">
                                    <p class="fs-14 mb-2">School Amount Received</p>
                                    <span class="fs-28">{{ number_format($payoutSummary['received']) }}</span>
                                    <small class="text-muted d-block mt-1">From successful payments</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="media align-items-center">
                                <span class="mr-3"><i class="ti ti-credit-card"></i></span>
                                <div class="media-body text-right">
                                    <p class="fs-14 mb-2">Withdrawn</p>
                                    <span class="fs-28">{{ number_format($payoutSummary['withdrawn']) }}</span>
                                    <small class="text-muted d-block mt-1">Outstanding {{ number_format($payoutSummary['outstanding']) }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="media align-items-center">
                                <span class="mr-3"><i class="ti ti-layout"></i></span>
                                <div class="media-body text-right">
                                    <p class="fs-14 mb-2">System Share</p>
                                    <span class="fs-28">{{ number_format($payoutSummary['system_share']) }}</span>
                                    <small class="text-muted d-block mt-1">Commission retained</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endrole

</x-app-layout>
