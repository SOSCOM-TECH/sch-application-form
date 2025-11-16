<x-app-layout>

    <div class="row page-titles mx-0 border">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Schools</h4>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="GET" class="row g-3 mb-3">
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control" onchange="this.form.submit()">
                        <option value="">All</option>
                        @foreach (['active','suspended'] as $s)
                            <option value="{{ $s }}" {{ request('status')===$s ? 'selected':'' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Search</label>
                    <input type="text" name="q" class="form-control" value="{{ request('q') }}" placeholder="School name">
                </div>
            </form>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Representative</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($schools as $school)
                            <tr>
                                <td>{{ $school->name }}</td>
                                <td>{{ $school->representative->name }} ({{ $school->representative->email }})</td>
                                <td><span class="badge badge-{{ $school->status==='active' ? 'success' : 'secondary' }}">{{ ucfirst($school->status) }}</span></td>
                                <td>{{ $school->created_at->format('Y-m-d') }}</td>
                                <td><a href="{{ route('admin.schools.show', $school) }}" class="btn btn-sm btn-outline-primary">Open</a></td>
                            </tr>
                        @empty
                            <tr><td colspan="5">No schools found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $schools->links() }}
        </div>
    </div>

</x-app-layout>


