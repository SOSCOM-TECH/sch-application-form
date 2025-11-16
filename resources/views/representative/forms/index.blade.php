<x-app-layout>

    <div class="row page-titles mx-0 border">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Forms</h4>
                <span class="text-muted">{{ $school->name }}</span>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 d-flex justify-content-end align-items-center">
            <a href="{{ route('rep.forms.create') }}" class="btn btn-primary"><i class="ti ti-plus"></i> New Form</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
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
                            <tr><td colspan="4">No forms yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>


