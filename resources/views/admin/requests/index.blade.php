<x-app-layout>

    <div class="row page-titles mx-0 border">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>School Registration Requests</h4>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="GET" class="mb-3">
                <div class="row">
                    <div class="col-md-3">
                        <select name="status" class="form-control" onchange="this.form.submit()">
                            @foreach (['pending','approved','rejected'] as $s)
                                <option value="{{ $s }}" {{ $status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>School</th>
                            <th>Representative</th>
                            <th>Status</th>
                            <th>Submitted</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($requests as $r)
                            <tr>
                                <td>{{ $r->school_name }}</td>
                                <td>{{ $r->representative->name }} ({{ $r->representative->email }})</td>
                                <td><span class="badge badge-{{ $r->status === 'approved' ? 'success' : ($r->status === 'rejected' ? 'danger' : 'warning') }}">{{ ucfirst($r->status) }}</span></td>
                                <td>{{ $r->created_at->diffForHumans() }}</td>
                                <td><a href="{{ route('admin.requests.show', $r) }}" class="btn btn-sm btn-primary">Open</a></td>
                            </tr>
                        @empty
                            <tr><td colspan="5">No requests.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $requests->links() }}
        </div>
    </div>

</x-app-layout>


