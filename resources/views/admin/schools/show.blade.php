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
                    <p><strong>Status:</strong> 
                        <span class="badge badge-{{ 
                            $school->status==='active' ? 'success' : 
                            ($school->status==='pending' ? 'warning' : 'secondary') 
                        }}">{{ ucfirst($school->status) }}</span>
                    </p>
                    <p><strong>Package:</strong> 
                        @if($school->package)
                            <span class="badge badge-info">{{ $school->package->name }}</span> 
                            (System: {{ $school->package->system_percentage }}%, School: {{ $school->package->school_percentage }}%)
                        @else
                            <span class="text-muted">Not assigned</span>
                            @if($school->commission_rate)
                                <small class="text-muted">(Using legacy rate: {{ $school->commission_rate }}%)</small>
                            @endif
                        @endif
                    </p>
                </div>
                <div class="col-md-6 text-end">
                    @if ($school->status === 'active')
                        <form method="POST" action="{{ route('admin.schools.suspend', $school) }}" class="d-inline">
                            @csrf
                            <button class="btn btn-warning">Suspend</button>
                        </form>
                    @elseif ($school->status === 'pending')
                        <form method="POST" action="{{ route('admin.schools.activate', $school) }}" class="d-inline">
                            @csrf
                            <button class="btn btn-success">Approve & Activate</button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('admin.schools.activate', $school) }}" class="d-inline">
                            @csrf
                            <button class="btn btn-success">Activate</button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <form method="POST" action="{{ route('admin.schools.updatePackage', $school) }}">
                        @csrf
                        <div class="form-group">
                            <label for="package_id">Assign Package</label>
                            <select name="package_id" id="package_id" class="form-control">
                                <option value="">-- No Package (Use Legacy Rate) --</option>
                                @foreach(\App\Models\Package::where('is_active', true)->orderBy('sort_order')->get() as $package)
                                    <option value="{{ $package->id }}" {{ $school->package_id == $package->id ? 'selected' : '' }}>
                                        {{ $package->name }} (System: {{ $package->system_percentage }}%, School: {{ $package->school_percentage }}%)
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Update Package</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>

</x-app-layout>


