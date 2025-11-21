<x-app-layout>



    <div class="row align-items-center mb-3 border-bottom no-gutters">
        <div class="col">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">
                        Payments Ledger
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="row my-2">
        <div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Ref</th>
                            <th>School</th>
                            <th>Form</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>System (SOSCOM)</th>
                            <th>School Amount</th>
                            <th>System Withdrawn</th>
                            <th>School Withdrawn</th>
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
                                <td>{{ $p->commission_rate }}% ({{ number_format($p->system_amount) }})</td>
                                <td>{{ number_format($p->school_amount) }}</td>
                                <td>
                                    <span class="badge badge-{{ $p->system_withdrawn ? 'success' : 'secondary' }}">
                                        {{ $p->system_withdrawn ? 'Withdrawn' : 'Pending' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-{{ $p->school_withdrawn ? 'success' : 'secondary' }}">
                                        {{ $p->school_withdrawn ? 'Withdrawn' : 'Pending' }}
                                    </span>
                                </td>
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
        </div>
    </div>

</x-app-layout>


