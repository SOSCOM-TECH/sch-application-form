<x-app-layout>



    <div class="row align-items-center mb-3 border-bottom no-gutters">
        <div class="col">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">
                        Applicants
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
                <div class="btn-group">
                    <a href="{{ route('rep.applicants.export.csv') }}" class="btn btn-outline-secondary">Export CSV</a>
                    <a href="{{ route('rep.applicants.export.xlsx') }}" class="btn btn-outline-secondary">Export Excel</a>
                    <a href="{{ route('rep.applicants.export.pdf') }}" class="btn btn-outline-secondary">Print/PDF</a>
                </div>
            </div>

            <form method="GET" class="row g-3 mb-3">
                <div class="col-md-3">
                    <label class="form-label">Payment Status</label>
                    <select name="payment_status" class="form-control" onchange="this.form.submit()">
                        <option value="">All</option>
                        @foreach (['success' => 'Success', 'pending' => 'Pending', 'failed' => 'Failed'] as $key => $label)
                            <option value="{{ $key }}" {{ request('payment_status') === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Submission Date From</label>
                    <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}" onchange="this.form.submit()">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Submission Date To</label>
                    <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}" onchange="this.form.submit()">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Completion Status</label>
                    <select name="completion_status" class="form-control" onchange="this.form.submit()">
                        <option value="">All</option>
                        <option value="submitted" {{ request('completion_status') === 'submitted' ? 'selected' : '' }}>Submitted</option>
                    </select>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Submission Ref</th>
                            <th>Form</th>
                            <th>Payment Ref</th>
                            <th>Payment Status</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($submissions as $s)
                            <tr>
                                <td>{{ $s->reference }}</td>
                                <td>{{ $s->form->title }}</td>
                                <td>{{ optional($s->payment)->reference }}</td>
                                <td><span class="badge badge-{{ optional($s->payment)->status === 'success' ? 'success' : 'secondary' }}">{{ optional($s->payment)->status ?? '-' }}</span></td>
                                <td>{{ number_format(optional($s->payment)->amount ?? 0) }}</td>
                                <td>{{ $s->created_at->format('Y-m-d H:i') }}</td>
                                <td><a href="{{ route('rep.applicants.show', $s) }}" class="btn btn-sm btn-outline-primary">Open</a></td>
                            </tr>
                        @empty
                            <tr><td colspan="7">No applicants found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $submissions->links() }}
        </div>
    </div>
        </div>
    </div>

</x-app-layout>


