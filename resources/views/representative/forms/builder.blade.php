<x-app-layout>

    <div class="row page-titles mx-0 border">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Form Builder</h4>
                <span class="text-muted">{{ $form->title }}</span>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 d-flex justify-content-end align-items-center">
            <div class="btn-group me-2">
                <a href="{{ route('rep.forms.preview', $form) }}" class="btn btn-outline-secondary"><i class="ti ti-eye"></i> Preview</a>
            </div>
            @if ($form->is_active)
                <div class="btn-group me-2">
                    <form method="POST" action="{{ route('rep.forms.unpublish', $form) }}">
                        @csrf
                        <button class="btn btn-warning"><i class="ti ti-eye-off"></i> Unpublish</button>
                    </form>
                </div>
                <a href="{{ route('public.apply.form', $form->slug) }}" target="_blank" class="btn btn-success">
                    <i class="ti ti-link"></i> Public URL
                </a>
            @else
                <form method="POST" action="{{ route('rep.forms.publish', $form) }}">
                    @csrf
                    <button class="btn btn-primary"><i class="ti ti-upload"></i> Publish</button>
                </form>
            @endif
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Add Field</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('rep.forms.fields.store', $form) }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Label</label>
                            <input type="text" name="label" class="form-control" required>
                            <x-input-error :messages="$errors->get('label')" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Type</label>
                            <select name="type" class="form-control" id="field-type" required>
                                <option value="text">Text</option>
                                <option value="number">Number</option>
                                <option value="textarea">Textarea</option>
                                <option value="select">Select</option>
                                <option value="file">File</option>
                                <option value="date">Date</option>
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>
                        <div class="mb-3" id="options-wrapper" style="display:none;">
                            <label class="form-label">Options (comma-separated)</label>
                            <input type="text" name="options" class="form-control" placeholder="e.g. Male, Female">
                            <small class="text-muted">Only for Select type</small>
                        </div>
                        <div class="form-check mb-3">
                            <input type="checkbox" name="required" value="1" class="form-check-input" id="required">
                            <label for="required" class="form-check-label">Required</label>
                        </div>
                        <x-primary-button>Add Field</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Fields</h4>
                </div>
                <div class="card-body">
                    @if ($form->fields->isEmpty())
                        <p class="text-muted">No fields yet. Add your first field.</p>
                    @else
                        @if ($form->is_active)
                            <div class="alert alert-info">
                                This form is currently <strong>published</strong>. Changes will reflect immediately. Public link:
                                <a href="{{ route('public.apply.form', $form->slug) }}" target="_blank">{{ route('public.apply.form', $form->slug) }}</a>
                            </div>
                        @endif
                        <ul class="list-group">
                            @foreach ($form->fields as $field)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $field->label }}</strong>
                                        <span class="badge badge-light text-uppercase ms-2">{{ $field->type }}</span>
                                        @if ($field->required)
                                            <span class="badge badge-warning ms-2">Required</span>
                                        @endif
                                        @if ($field->type === 'select' && $field->options)
                                            <div class="small text-muted">Options: {{ implode(', ', $field->options) }}</div>
                                        @endif
                                    </div>
                                    <form method="POST" action="{{ route('rep.forms.fields.destroy', [$form, $field]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"><i class="ti ti-trash"></i></button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        const typeSelect = document.getElementById('field-type');
        const optionsWrapper = document.getElementById('options-wrapper');
        function toggleOptions() {
            optionsWrapper.style.display = typeSelect.value === 'select' ? 'block' : 'none';
        }
        typeSelect.addEventListener('change', toggleOptions);
        toggleOptions();
    </script>

</x-app-layout>


