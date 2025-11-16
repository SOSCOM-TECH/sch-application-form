
<x-app-layout>


    <div class="row page-titles mx-0 border">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Dashboard</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                        <i class="icon-key text-danger"></i>
                        <span class="ml-2 text-danger">Logout </span>
                    </x-responsive-nav-link>
                </form>
            </ol>
        </div>
    </div>

    @role('school_representative')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">School Verification Status</h4>
                </div>
                <div class="card-body">
                    @php
                        $request = auth()->user()->schoolRegistrationRequest;
                        $school = auth()->user()->school;
                    @endphp

                    @if ($school)
                        <div class="alert alert-success">
                            <i class="ti ti-badge-check"></i>
                            Your school is verified and active. You can now access form builder, payments, and applicant dashboard.
                        </div>
                    @elseif ($request && $request->status === 'pending')
                        <div class="alert alert-warning">
                            <i class="ti ti-timer"></i>
                            Your school registration request is under review. We will notify you once approved.
                        </div>
                        <div class="d-flex align-items-center">
                            @if ($request->logo_path)
                                <img src="{{ asset('storage/' . $request->logo_path) }}" alt="Logo" class="rounded me-3" style="height:48px;">
                            @endif
                            <div>
                                <div><strong>{{ $request->school_name }}</strong></div>
                                <div class="text-muted">Submitted {{ $request->created_at->diffForHumans() }}</div>
                                <a href="{{ route('rep.requests.show', $request) }}" class="btn btn-sm btn-primary mt-2">View details</a>
                            </div>
                        </div>
                    @elseif ($request && $request->status === 'rejected')
                        <div class="alert alert-danger">
                            <i class="ti ti-alert"></i>
                            Your request was rejected. Reason: {{ $request->rejection_reason }}
                        </div>
                        <a href="{{ route('rep.requests.create') }}" class="btn btn-warning">Resubmit Registration Request</a>
                    @else
                        <div class="alert alert-info">
                            <i class="ti ti-info-alt"></i>
                            To unlock your dashboard features, first submit your school registration for verification.
                        </div>
                        <a href="{{ route('rep.requests.create') }}" class="btn btn-primary">Submit School Registration</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endrole

   </x-app-layout>
