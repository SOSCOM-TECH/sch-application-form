<x-app-layout>



    <div class="row align-items-center mb-3 border-bottom no-gutters">
        <div class="col">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">
                        School Registration Requests
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="row my-2">
        <div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <form method="GET" class="row g-3 mb-3">
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control" onchange="this.form.submit()">
                        <option value="">All</option>
                        @foreach (['pending','approved','rejected'] as $s)
                            <option value="{{ $s }}" {{ request('status')===$s ? 'selected':'' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
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
                                <td><a href="{{ route('admin.requests.show', $r) }}" class="btn btn-sm btn-outline-primary">Open</a></td>
                            </tr>
                        @empty
                            <tr><td colspan="5">No requests found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $requests->links() }}
        </div>
    </div>
        </div>
    </div>

</x-app-layout>


