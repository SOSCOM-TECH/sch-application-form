<x-app-layout>

    <div class="row align-items-center mb-3 border-bottom no-gutters">
        <div class="col">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">
                        Packages
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.packages.create') }}" class="btn btn-sm btn-primary">
                <i class="fe fe-plus"></i> Create Package
            </a>
        </div>
    </div>

    <div class="row my-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>System %</th>
                                    <th>School %</th>
                                    <th>Total %</th>
                                    <th>Status</th>
                                    <th>Schools</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($packages as $package)
                                    <tr>
                                        <td>
                                            <strong>{{ $package->sort_order }}</strong>
                                        </td>
                                        <td>
                                            <strong>{{ $package->name }}</strong>
                                            @if($package->description)
                                                <br><small class="text-muted">{{ Str::limit($package->description, 50) }}</small>
                                            @endif
                                        </td>
                                        <td>{{ $package->system_percentage }}%</td>
                                        <td>{{ $package->school_percentage }}%</td>
                                        <td><strong>{{ $package->total_percentage }}%</strong></td>
                                        <td>
                                            <span class="badge badge-{{ $package->is_active ? 'success' : 'secondary' }}">
                                                {{ $package->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>{{ $package->schools_count }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.packages.show', $package) }}" class="btn btn-sm btn-info">
                                                    <i class="fe fe-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.packages.edit', $package) }}" class="btn btn-sm btn-primary">
                                                    <i class="fe fe-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.packages.destroy', $package) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this package?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fe fe-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No packages found. <a href="{{ route('admin.packages.create') }}">Create one</a></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $packages->links() }}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

