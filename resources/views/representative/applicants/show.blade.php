<x-app-layout>

    <div class="row page-titles mx-0 border">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Applicant Detail</h4>
                <span class="text-muted">Submission {{ $submission->reference }}</span>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 d-flex justify-content-end align-items-center">
            <button class="btn btn-outline-secondary" onclick="window.print()"><i class="ti ti-printer"></i> Print</button>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <strong>Form:</strong> {{ $submission->form->title }}<br>
                <strong>Payment Ref:</strong> {{ optional($submission->payment)->reference }} ({{ optional($submission->payment)->status }})<br>
                <strong>Submitted:</strong> {{ $submission->created_at->format('Y-m-d H:i') }}
            </div>

            <h5 class="mb-2">Answers</h5>
            <div class="table-responsive mb-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Field</th>
                            <th>Answer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($submission->answers as $answer)
                            <tr>
                                <td>{{ $answer->field->label }}</td>
                                <td>{{ $answer->value }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <h5 class="mb-2">Documents</h5>
            @if ($submission->documents->isEmpty())
                <p class="text-muted">No documents uploaded.</p>
            @else
                <ul>
                    @foreach ($submission->documents as $doc)
                        <li>
                            <a href="{{ asset('storage/' . $doc->path) }}" target="_blank">
                                {{ $doc->original_name ?? basename($doc->path) }}
                            </a>
                            <span class="text-muted">({{ $doc->mime_type }})</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

</x-app-layout>


