<x-app-layout>



    <div class="row align-items-center mb-3 border-bottom no-gutters">
        <div class="col">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">
                        {{ $school->name }}
                    </a>
                </li>
            </ul>
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-success mb-3">{{ session('status') }}</div>
    @endif

    <div class="row my-2">
        <div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Representative:</strong> {{ $school->representative->name }} ({{ $school->representative->email }})</p>
                    <p><strong>Type:</strong> {{ $school->type ?? '-' }}</p>
                    <p><strong>Registration #:</strong> {{ $school->registration_number ?? '-' }}</p>
                    <p><strong>Address:</strong> {{ $school->address ?? '-' }}</p>
                    <p><strong>Status:</strong> <span class="badge badge-{{ $school->status==='active' ? 'success' : 'secondary' }}">{{ ucfirst($school->status) }}</span></p>
                </div>
                <div class="col-md-6 text-end">
                    @if ($school->status === 'active')
                        <form method="POST" action="{{ route('admin.schools.suspend', $school) }}">
                            @csrf
                            <button class="btn btn-warning">Suspend</button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('admin.schools.activate', $school) }}">
                            @csrf
                            <button class="btn btn-success">Activate</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>

</x-app-layout>


