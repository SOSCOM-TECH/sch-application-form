<x-app-layout>

    <div class="row align-items-center mb-3 border-bottom no-gutters">
        <div class="col">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">
                        Package Details
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.packages.edit', $package) }}" class="btn btn-sm btn-primary">
                <i class="fe fe-edit"></i> Edit
            </a>
            <a href="{{ route('admin.packages.index') }}" class="btn btn-sm btn-secondary">
                <i class="fe fe-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <div class="row my-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">{{ $package->name }}</h4>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Name:</dt>
                        <dd class="col-sm-8">{{ $package->name }}</dd>

                        <dt class="col-sm-4">Description:</dt>
                        <dd class="col-sm-8">{{ $package->description ?? 'N/A' }}</dd>

                        <dt class="col-sm-4">System Percentage:</dt>
                        <dd class="col-sm-8"><strong>{{ $package->system_percentage }}%</strong></dd>

                        <dt class="col-sm-4">School Percentage:</dt>
                        <dd class="col-sm-8"><strong>{{ $package->school_percentage }}%</strong></dd>

                        <dt class="col-sm-4">Total Percentage:</dt>
                        <dd class="col-sm-8"><strong>{{ $package->total_percentage }}%</strong></dd>

                        <dt class="col-sm-4">Status:</dt>
                        <dd class="col-sm-8">
                            <span class="badge badge-{{ $package->is_active ? 'success' : 'secondary' }}">
                                {{ $package->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </dd>

                        <dt class="col-sm-4">Sort Order:</dt>
                        <dd class="col-sm-8">{{ $package->sort_order }}</dd>

               </dl>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Schools Using This Package</h5>
                </div>
                <div class="card-body">
                    @if($package->schools->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>School Name</th>
                                        <th>Representative</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($package->schools as $school)
                                        <tr>
                                            <td>{{ $school->name }}</td>
                                            <td>{{ $school->representative->name }}</td>
                                            <td>
                                                <span class="badge badge-{{ $school->status === 'active' ? 'success' : 'secondary' }}">
                                                    {{ ucfirst($school->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.schools.show', $school) }}" class="btn btn-sm btn-outline-primary">
                                                    View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted mb-0">No schools are currently using this package.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

