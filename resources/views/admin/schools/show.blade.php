<x-app-layout>

    @if (session('status'))
        <div class="alert alert-success mb-3">{{ session('status') }}</div>
    @endif

    <div class="row page-titles mx-0 border">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>{{ $school->name }}</h4>
                <span class="text-muted">Status: {{ ucfirst($school->status) }}</span>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 d-flex justify-content-end align-items-center">
            @if ($school->status === 'active')
                <form method="POST" action="{{ route('admin.schools.suspend', $school) }}">
                    @csrf
                    <button class="btn btn-warning">Suspend</button>
                </form>
            @else
                <form method="POST" action="{{ route('admin.schools.activate', $school) }}" class="ms-2">
                    @csrf
                    <button class="btn btn-success">Activate</button>
                </form>
            @endif
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <p><strong>Representative:</strong> {{ $school->representative->name }} ({{ $school->representative->email }})</p>
            <p><strong>Type:</strong> {{ $school->type ?? '-' }}</p>
            <p><strong>Registration #:</strong> {{ $school->registration_number ?? '-' }}</p>
            <p><strong>Address:</strong> {{ $school->address ?? '-' }}</p>
        </div>
    </div>

</x-app-layout>


