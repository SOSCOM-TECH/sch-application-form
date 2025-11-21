<x-app-layout>



    <div class="row align-items-center mb-3 border-bottom no-gutters">
        <div class="col">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">
                        Form Preview - {{ $form->title }}
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="row my-2">
        <div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="mb-3 text-end">
                <a href="{{ route('rep.forms.builder', $form) }}" class="btn btn-outline-secondary"><i class="ti ti-pencil-alt"></i> Back to Builder</a>
            </div>

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
        </div>
    </div>

</x-app-layout>


