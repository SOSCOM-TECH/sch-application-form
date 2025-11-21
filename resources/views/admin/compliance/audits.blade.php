<x-app-layout>



    <div class="row align-items-center mb-3 border-bottom no-gutters">
        <div class="col">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">
                        Verification Audit History
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="row my-2">
        <div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>Action</th>
                            <th>Note</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($audits as $a)
                            <tr>
                                <td>{{ $a->school_registration_request_id }}</td>
                                <td>{{ ucfirst($a->action) }}</td>
                                <td>{{ $a->note }}</td>
                                <td>{{ $a->created_at->format('Y-m-d H:i') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4">No audit records found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $audits->links() }}
        </div>
    </div>
        </div>
    </div>

</x-app-layout>


