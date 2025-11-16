<x-app-layout>

    <div class="row page-titles mx-0 border">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Awaiting School Approval</h4>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @php
                $request = auth()->user()->schoolRegistrationRequest;
            @endphp

            @if ($request)
                <div class="alert alert-warning">
                    <i class="ti ti-timer"></i>
                    Your school registration request for <strong>{{ $request->school_name }}</strong> is under review.
                </div>
                <a href="{{ route('rep.requests.show', $request) }}" class="btn btn-primary">View Request Details</a>
            @else
                <div class="alert alert-info">
                    <i class="ti ti-info-alt"></i>
                    Submit your school registration to unlock the dashboard.
                </div>
                <a href="{{ route('rep.requests.create') }}" class="btn btn-primary">Submit School Registration</a>
            @endif
        </div>
    </div>

</x-app-layout>


