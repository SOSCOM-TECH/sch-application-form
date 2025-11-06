<x-app-layout>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Roles</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.roles.store') }}" class="mb-3">
                        @csrf
                        <div class="row g-2 align-items-end">
                            <div class="col">
                                <label class="form-label">Role name</label>
                                <input type="text" name="name" class="form-control" placeholder="e.g. reviewer" required>
                                @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-primary">Create Role</button>
                            </div>
                        </div>
                    </form>

                    <ul class="list-group">
                        @foreach($roles as $role)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ $role->name }}</span>
                                <small class="text-muted">{{ $role->permissions()->count() }} permissions</small>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Permissions</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.permissions.store') }}" class="mb-3">
                        @csrf
                        <div class="row g-2 align-items-end">
                            <div class="col">
                                <label class="form-label">Permission name</label>
                                <input type="text" name="name" class="form-control" placeholder="e.g. view reports" required>
                                @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-primary">Create Permission</button>
                            </div>
                        </div>
                    </form>

                    <div class="mb-4">
                        <label class="form-label">Assign permissions to a role</label>
                        <form method="POST" action="{{ route('admin.roles.permissions.sync', $roles->first()) }}">
                            @csrf
                            <div class="mb-2">
                                <select name="role_id" id="roleSelect" class="form-select" onchange="updateAction(this.value)">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" data-action="{{ route('admin.roles.permissions.sync', $role) }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                @foreach($permissions as $permission)
                                    <div class="col-6 col-md-4">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="perm_{{ $permission->id }}">
                                            <label class="form-check-label" for="perm_{{ $permission->id }}">{{ $permission->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button class="btn btn-success mt-2">Save Permissions</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
function updateAction(roleId) {
    const select = document.getElementById('roleSelect');
    const option = select.options[select.selectedIndex];
    const form = option.closest('form');
    form.action = option.dataset.action;
}
</script>
 </x-app-layout>


