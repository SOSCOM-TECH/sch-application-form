<x-guest-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            @if ($form->school->logo_path)
                                <img src="{{ asset('storage/' . $form->school->logo_path) }}" alt="Logo" class="me-2" style="height:32px;">
                            @endif
                            <div>
                                <h4 class="mb-0">{{ $form->title }}</h4>
                                <small class="text-muted">{{ $form->school->name }}</small>
                            </div>
                        </div>
                        <span class="badge badge-success">Payment Verified</span>
                    </div>
                    <div class="card-body">
                        @if ($form->fields->isEmpty())
                            <p class="text-muted">This form has no fields yet.</p>
                        @else
                            <form method="POST" action="{{ route('public.apply.submit', $form->slug) }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="ref" value="{{ request('ref') }}">
                                @foreach ($form->fields as $field)
                                    <div class="mb-3">
                                        <label class="form-label">{{ $field->label }} @if($field->required)<span class="text-danger">*</span>@endif</label>
                                        @switch($field->type)
                                            @case('text')
                                                <input type="text" name="fields[{{ $field->id }}]" class="form-control" {{ $field->required ? 'required' : '' }}>
                                                @break
                                            @case('number')
                                                <input type="number" name="fields[{{ $field->id }}]" class="form-control" {{ $field->required ? 'required' : '' }}>
                                                @break
                                            @case('textarea')
                                                <textarea name="fields[{{ $field->id }}]" class="form-control" rows="3" {{ $field->required ? 'required' : '' }}></textarea>
                                                @break
                                            @case('select')
                                                <select name="fields[{{ $field->id }}]" class="form-control" {{ $field->required ? 'required' : '' }}>
                                                    <option value="">Select...</option>
                                                    @if ($field->options)
                                                        @foreach ($field->options as $opt)
                                                            <option value="{{ $opt }}">{{ $opt }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @break
                                            @case('file')
                                                <input type="file" name="fields[{{ $field->id }}]" class="form-control" {{ $field->required ? 'required' : '' }}>
                                                @break
                                            @case('date')
                                                <input type="date" name="fields[{{ $field->id }}]" class="form-control" {{ $field->required ? 'required' : '' }}>
                                                @break
                                        @endswitch
                                        <x-input-error :messages="$errors->get('fields.' . $field->id)" class="mt-2" />
                                    </div>
                                @endforeach
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>


