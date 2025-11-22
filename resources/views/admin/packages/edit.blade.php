<x-app-layout>

    <div class="row align-items-center mb-3 border-bottom no-gutters">
        <div class="col">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">
                        Edit Package
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="row my-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.packages.update', $package) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Package Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name', $package->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" name="description" rows="3">{{ old('description', $package->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="system_percentage">System Percentage <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control @error('system_percentage') is-invalid @enderror"
                                               id="system_percentage" name="system_percentage"
                                               value="{{ old('system_percentage', $package->system_percentage) }}" min="0" max="100" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">Commission percentage for the system/admin</small>
                                    @error('system_percentage')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="school_percentage">School Percentage <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control @error('school_percentage') is-invalid @enderror"
                                               id="school_percentage" name="school_percentage"
                                               value="{{ old('school_percentage', $package->school_percentage) }}" min="0" max="100" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">Commission percentage for the school</small>
                                    @error('school_percentage')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="total_percentage_display">Total Percentage</label>
                            <input type="text" class="form-control" id="total_percentage_display" readonly>
                            <small class="form-text text-muted">System + School (should not exceed 100%)</small>
                        </div>

                        <div class="form-group">
                            <label for="sort_order">Sort Order</label>
                            <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                   id="sort_order" name="sort_order" value="{{ old('sort_order', $package->sort_order) }}" min="0">
                            <small class="form-text text-muted">Lower numbers appear first</small>
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
                                       {{ old('is_active', $package->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Active
                                </label>
                            </div>
                            <small class="form-text text-muted">Only active packages can be assigned to schools</small>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Package</button>
                            <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const systemInput = document.getElementById('system_percentage');
            const schoolInput = document.getElementById('school_percentage');
            const totalDisplay = document.getElementById('total_percentage_display');
            const MAX = 100;
            let lastEdited = null;

            // Determine which field is currently edited
            systemInput.addEventListener('focus', function() { lastEdited = 'system'; });
            schoolInput.addEventListener('focus', function() { lastEdited = 'school'; });

            function syncPercentages() {
                let system = parseInt(systemInput.value);
                let school = parseInt(schoolInput.value);

                if (isNaN(system)) system = 0;
                if (isNaN(school)) school = 0;

                if (lastEdited === 'system' && document.activeElement === systemInput) {
                    let newSchool = MAX - system;
                    if (newSchool < 0) newSchool = 0;
                    schoolInput.value = newSchool;
                    school = newSchool;
                } else if (lastEdited === 'school' && document.activeElement === schoolInput) {
                    let newSystem = MAX - school;
                    if (newSystem < 0) newSystem = 0;
                    systemInput.value = newSystem;
                    system = newSystem;
                }

                const total = system + school;
                totalDisplay.value = total + '%';

                if (total > MAX) {
                    totalDisplay.classList.add('is-invalid');
                } else {
                    totalDisplay.classList.remove('is-invalid');
                }
            }

            systemInput.addEventListener('input', syncPercentages);
            schoolInput.addEventListener('input', syncPercentages);

            // On initial load, simulate focus based on last user
            systemInput.addEventListener('blur', syncPercentages);
            schoolInput.addEventListener('blur', syncPercentages);

            // Set initial percentages and total
            syncPercentages();
        });
    </script>

</x-app-layout>
