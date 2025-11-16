<x-app-layout>
    <div class="row page-titles mx-0 border">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Verification Audit History</h4>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
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
                            <tr><td colspan="4">No audit records.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $audits->links() }}
        </div>
    </div>
</x-app-layout>


