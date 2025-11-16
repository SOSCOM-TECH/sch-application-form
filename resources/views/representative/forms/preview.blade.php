<x-app-layout>

    <div class="row page-titles mx-0 border">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Form Preview</h4>
                <span class="text-muted">{{ $form->title }}</span>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 d-flex justify-content-end align-items-center">
            <a href="{{ route('rep.forms.builder', $form) }}" class="btn btn-outline-secondary"><i class="ti ti-pencil-alt"></i> Back to Builder</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if ($form->fields->isEmpty())
                <p class="text-muted">No fields to preview.</p>
            @else
                <form>
                    @foreach ($form->fields as $field)
                        <div class="mb-3">
                            <label class="form-label">{{ $field->label }} @if($field->required)<span class="text-danger">*</span>@endif</label>
                            @switch($field->type)
                                @case('text')
                                    <input type="text" class="form-control" {{ $field->required ? 'required' : '' }}>
                                    @break
                                @case('number')
                                    <input type="number" class="form-control" {{ $field->required ? 'required' : '' }}>
                                    @break
                                @case('textarea')
                                    <textarea class="form-control" rows="3" {{ $field->required ? 'required' : '' }}></textarea>
                                    @break
                                @case('select')
                                    <select class="form-control" {{ $field->required ? 'required' : '' }}>
                                        <option value="">Select...</option>
                                        @if ($field->options)
                                            @foreach ($field->options as $opt)
                                                <option value="{{ $opt }}">{{ $opt }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @break
                                @case('file')
                                    <input type="file" class="form-control" {{ $field->required ? 'required' : '' }}>
                                    @break
                                @case('date')
                                    <input type="date" class="form-control" {{ $field->required ? 'required' : '' }}>
                                    @break
                            @endswitch
                        </div>
                    @endforeach
                </form>
            @endif
        </div>
    </div>

</x-app-layout>


