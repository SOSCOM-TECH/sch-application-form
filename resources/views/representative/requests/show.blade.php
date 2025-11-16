<x-app-layout>

    <div class="row page-titles mx-0 border">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Registration Request Status</h4>
            </div>
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-success mb-3">{{ session('status') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h5>{{ $request->school_name }}</h5>
                    <p class="mb-1"><strong>Type:</strong> {{ $request->school_type ?: '-' }}</p>
                    <p class="mb-1"><strong>Registration #:</strong> {{ $request->registration_number ?: '-' }}</p>
                    <p class="mb-1"><strong>Address:</strong> {{ $request->address ?: '-' }}</p>
                    <p class="mb-1"><strong>Status:</strong>
                        <span class="badge badge-{{ $request->status === 'approved' ? 'success' : ($request->status === 'rejected' ? 'danger' : 'warning') }}">
                            {{ ucfirst($request->status) }}
                        </span>
                    </p>
                    @if ($request->status === 'rejected' && $request->rejection_reason)
                        <div class="alert alert-warning mt-3">
                            <strong>Rejection reason:</strong> {{ $request->rejection_reason }}
                        </div>
                    @endif
                </div>
                <div class="col-md-4">
                    @if ($request->logo_path)
                        <img src="{{ asset('storage/' . $request->logo_path) }}" alt="Logo" class="img-fluid rounded mb-3">
                    @endif
                    @if ($request->proof_documents)
                        <div>
                            <strong>Proof Documents</strong>
                            <ul class="mt-2">
                                @foreach ($request->proof_documents as $doc)
                                    <li><a href="{{ asset('storage/' . $doc) }}" target="_blank">View document</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>


