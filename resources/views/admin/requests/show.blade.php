<x-app-layout>

    @if (session('status'))
        <div class="alert alert-success mb-3">{{ session('status') }}</div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3">{{ $request->school_name }}</h4>
                    <p class="mb-1"><strong>Type:</strong> {{ $request->school_type ?: '-' }}</p>
                    <p class="mb-1"><strong>Registration #:</strong> {{ $request->registration_number ?: '-' }}</p>
                    <p class="mb-1"><strong>Address:</strong> {{ $request->address ?: '-' }}</p>
                    <p class="mb-3"><strong>Status:</strong>
                        <span class="badge badge-{{ $request->status === 'approved' ? 'success' : ($request->status === 'rejected' ? 'danger' : 'warning') }}">{{ ucfirst($request->status) }}</span>
                    </p>

                    <p class="mb-1"><strong>Representative:</strong> {{ $request->representative->name }} ({{ $request->representative->email }})</p>

                    @if ($request->status === 'rejected' && $request->rejection_reason)
                        <div class="alert alert-warning mt-3">
                            <strong>Rejection reason:</strong> {{ $request->rejection_reason }}
                        </div>
                    @endif
                </div>
            </div>

            @if ($request->status === 'pending')
                <div class="card mt-3">
                    <div class="card-body d-flex gap-2">
                        <form method="POST" action="{{ route('admin.requests.approve', $request) }}" class="me-2">
                            @csrf
                            <button type="submit" class="btn btn-success">Approve</button>
                        </form>
                        <form method="POST" action="{{ route('admin.requests.reject', $request) }}" class="d-flex align-items-center">
                            @csrf
                            <input type="text" name="rejection_reason" class="form-control me-2" placeholder="Rejection reason" required>
                            <button type="submit" class="btn btn-danger">Reject</button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    @if ($request->logo_path)
                        <img src="{{ asset('storage/' . $request->logo_path) }}" alt="Logo" class="img-fluid rounded mb-3">
                    @endif
                    @if ($request->proof_documents)
                        <strong>Proof Documents</strong>
                        <ul class="mt-2">
                            @foreach ($request->proof_documents as $doc)
                                <li><a href="{{ asset('storage/' . $doc) }}" target="_blank">View document</a></li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>


