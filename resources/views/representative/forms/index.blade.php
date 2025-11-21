<x-app-layout>



    <div class="row align-items-center mb-3 border-bottom no-gutters">
        <div class="col">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">
                        Forms
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="row my-2">
        <div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <a href="{{ route('rep.forms.create') }}" class="btn btn-primary"><i class="ti ti-plus"></i> New Form</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Fee (TZS)</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($forms as $form)
                            <tr>
                                <td>{{ $form->title }}</td>
                                <td>{{ number_format($form->application_fee) }}</td>
                                <td><span class="badge badge-{{ $form->is_active ? 'success' : 'secondary' }}">{{ $form->is_active ? 'Yes' : 'No' }}</span></td>
                                <td>
                                    <a href="{{ route('rep.forms.builder', $form) }}" class="btn btn-sm btn-outline-primary">Builder</a>
                                    <a href="{{ route('rep.forms.preview', $form) }}" class="btn btn-sm btn-outline-secondary">Preview</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4">No forms found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        </div>
    </div>

</x-app-layout>


