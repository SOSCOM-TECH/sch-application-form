<x-app-layout>

    <div class="row page-titles mx-0 border">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Payments Ledger</h4>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Ref</th>
                            <th>School</th>
                            <th>Form</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Commission</th>
                            <th>Net to School</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payments as $p)
                            <tr>
                                <td>{{ $p->reference }}</td>
                                <td>{{ $p->school->name }}</td>
                                <td>{{ $p->form->title }}</td>
                                <td><span class="badge badge-{{ $p->status === 'success' ? 'success' : 'secondary' }}">{{ ucfirst($p->status) }}</span></td>
                                <td>{{ number_format($p->amount) }}</td>
                                <td>{{ $p->commission_rate }}% ({{ number_format($p->commission_amount) }})</td>
                                <td>{{ number_format($p->net_amount) }}</td>
                                <td>{{ $p->created_at->format('Y-m-d H:i') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="8">No payments found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $payments->links() }}
        </div>
    </div>

</x-app-layout>


