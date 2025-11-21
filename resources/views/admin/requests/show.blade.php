<x-app-layout>



    <div class="row align-items-center mb-3 border-bottom no-gutters">
        <div class="col">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">
                        {{ $request->school_name }}
                    </a>
                </li>
            </ul>
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-success mb-3">{{ session('status') }}</div>
    @endif

    <div class="row my-2">
        <div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <p class="mb-1"><strong>Type:</strong> {{ $request->school_type ?: '-' }}</p>
                    <p class="mb-1"><strong>Registration #:</strong> {{ $request->registration_number ?: '-' }}</p>
                    <p class="mb-1"><strong>Address:</strong> {{ $request->address ?: '-' }}</p>
                    <p class="mb-1"><strong>Status:</strong>
                        <span class="badge badge-{{ $request->status === 'approved' ? 'success' : ($request->status === 'rejected' ? 'danger' : 'warning') }}">{{ ucfirst($request->status) }}</span>
                    </p>
                    <p class="mb-1"><strong>Commission Rate:</strong> {{ $request->commission_rate ?? '-' }}%</p>
                    <p class="mb-1"><strong>Representative:</strong> {{ $request->representative->name }} ({{ $request->representative->email }})</p>

                    @if ($request->status === 'rejected' && $request->rejection_reason)
                        <div class="alert alert-warning mt-3">
                            <strong>Rejection reason:</strong> {{ $request->rejection_reason }}
                        </div>
                    @endif

                    @if ($request->status === 'pending')
                        <div class="mt-3 d-flex gap-2">
                            <form method="POST" action="{{ route('admin.requests.approve', $request) }}">
                                @csrf
                                <button type="submit" class="btn btn-success">Approve</button>
                            </form>
                            <form method="POST" action="{{ route('admin.requests.reject', $request) }}" class="d-flex align-items-center">
                                @csrf
                                <input type="text" name="rejection_reason" class="form-control me-2" placeholder="Rejection reason" required>
                                <button type="submit" class="btn btn-danger">Reject</button>
                            </form>
                        </div>
                    @endif
                </div>
                <div class="col-md-4">
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
        </div>
    </div>

</x-app-layout>


