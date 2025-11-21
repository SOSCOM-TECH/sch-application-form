<x-app-layout>



    <div class="row align-items-center mb-3 border-bottom no-gutters">
        <div class="col">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">
                        Awaiting School Approval
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="row my-2">
        <div class="col-md-12">
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
        </div>
    </div>

</x-app-layout>


