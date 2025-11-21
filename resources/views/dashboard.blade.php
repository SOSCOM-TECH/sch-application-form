
<x-app-layout>


    <div class="row align-items-center mb-3 border-bottom no-gutters">
        <div class="col">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">
                        Dashboard
                    </a>
                </li>
            </ul>
        </div>
    </div>

    @role('school_representative')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">School Verification Status</h4>
                </div>
                <div class="card-body">
                    @php
                        $request = auth()->user()->schoolRegistrationRequest;
                        $school = auth()->user()->school;
                    @endphp

                    @if ($school)
                        <div class="alert alert-success">
                            <i class="ti ti-badge-check"></i>
                            Your school is verified and active. You can now access form builder, payments, and applicant dashboard.
                        </div>
                    @elseif ($request && $request->status === 'pending')
                        <div class="alert alert-warning">
                            <i class="ti ti-timer"></i>
                            Your school registration request is under review. We will notify you once approved.
                        </div>
                        <div class="d-flex align-items-center">
                            @if ($request->logo_path)
                                <img src="{{ asset('storage/' . $request->logo_path) }}" alt="Logo" class="rounded me-3" style="height:48px;">
                            @endif
                            <div>
                                <div><strong>{{ $request->school_name }}</strong></div>
                                <div class="text-muted">Submitted {{ $request->created_at->diffForHumans() }}</div>
                                <a href="{{ route('rep.requests.show', $request) }}" class="btn btn-sm btn-primary mt-2">View details</a>
                            </div>
                        </div>
                    @elseif ($request && $request->status === 'rejected')
                        <div class="alert alert-danger">
                            <i class="ti ti-alert"></i>
                            Your request was rejected. Reason: {{ $request->rejection_reason }}
                        </div>
                        <a href="{{ route('rep.requests.create') }}" class="btn btn-warning">Resubmit Registration Request</a>
                    @else
                        <div class="alert alert-info">
                            <i class="ti ti-info-alt"></i>
                            To unlock your dashboard features, first submit your school registration for verification.
                        </div>
                        {{-- PRICING CARDS --}}
<div class="row mt-4 justify-content-center">

    {{-- STANDARD --}}
    <div class="col-lg-3 col-md-4 col-10 mb-3">
        <div class="card h-100 shadow-sm">
            <div class="card-body text-center p-2">
                <h6 class="card-title mb-1">Standard Commission</h6>
                <p class="text-muted small mb-2">Perfect for schools starting their digital journey</p>
                <div class="fw-bold text-primary fs-2 mb-1">15%</div>
                <p class="text-muted small mb-2">Platform fee per application</p>
            </div>
            <div class="card-footer bg-transparent border-0 pb-2">
                <a href="{{ route('rep.requests.create', ['commission' => 15]) }}" class="btn btn-primary w-100 btn-sm">
                    Submit School Registration
                </a>
            </div>
        </div>
    </div>

    {{-- PREMIUM --}}
    <div class="col-lg-3 col-md-4 col-10 mb-3">
        <div class="card h-100 shadow-sm border-primary">
            <div class="card-header bg-primary text-white text-center py-1">
                <span class="badge bg-light text-primary small">BEST VALUE</span>
            </div>
            <div class="card-body text-center p-2">
                <h6 class="card-title mb-1">Premium Commission</h6>
                <p class="text-muted small mb-2">Best value for high-volume schools</p>
                <div class="fw-bold text-primary fs-2 mb-1">10%</div>
                <p class="text-muted small mb-2">Lower platform fee</p>
            </div>
            <div class="card-footer bg-transparent border-0 pb-2">
                <a href="{{ route('rep.requests.create', ['commission' => 10]) }}" class="btn btn-primary w-100 btn-sm">
                    Submit School Registration
                </a>
            </div>
        </div>
    </div>

</div>

                    @endif
                </div>
            </div>
        </div>
    </div>
    @php($payoutSummary = $schoolPayoutSummary ?? ['received' => 0, 'withdrawn' => 0, 'outstanding' => 0, 'system_share' => 0])
    @if ($school)
    <div class="row mt-3">
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <span class="mr-3"><i class="ti ti-wallet"></i></span>
                        <div class="media-body text-right">
                            <p class="fs-14 mb-2">School Amount Received</p>
                            <span class="fs-28">{{ number_format($payoutSummary['received']) }}</span>
                            <small class="text-muted d-block mt-1">From successful payments</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <span class="mr-3"><i class="ti ti-credit-card"></i></span>
                        <div class="media-body text-right">
                            <p class="fs-14 mb-2">Withdrawn</p>
                            <span class="fs-28">{{ number_format($payoutSummary['withdrawn']) }}</span>
                            <small class="text-muted d-block mt-1">Outstanding {{ number_format($payoutSummary['outstanding']) }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <span class="mr-3"><i class="ti ti-layout"></i></span>
                        <div class="media-body text-right">
                            <p class="fs-14 mb-2">System Share</p>
                            <span class="fs-28">{{ number_format($payoutSummary['system_share']) }}</span>
                            <small class="text-muted d-block mt-1">Commission retained</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endrole

    @role('admin')
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <span class="mr-3"><i class="ti ti-briefcase"></i></span>
                        <div class="media-body text-right">
                            <p class="fs-14 mb-2">Total Schools</p>
                            <span class="fs-28">{{ number_format($totalSchools ?? 0) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <span class="mr-3"><i class="ti ti-clipboard"></i></span>
                        <div class="media-body text-right">
                            <p class="fs-14 mb-2">Pending Requests</p>
                            <span class="fs-28">{{ number_format($pendingRequests ?? 0) }}</span>
                            @php($totalReq = max(($pendingRequests ?? 0) + ($approvedRequests ?? 0), 0))
                            @php($approvalPct = $totalReq > 0 ? number_format((($approvedRequests ?? 0) / $totalReq) * 100, 0) : 0)
                            <div class="progress mt-2" style="height:6px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $totalReq > 0 ? number_format((($pendingRequests ?? 0)/$totalReq)*100,0) : 0 }}%"></div>
                            </div>
                            <small class="text-muted d-block mt-1">{{ $approvalPct }}% approved</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <span class="mr-3"><i class="ti ti-money"></i></span>
                        <div class="media-body text-right">
                            <p class="fs-14 mb-2">Revenue (TZS)</p>
                            <span class="fs-28">{{ number_format($totalRevenueTzs ?? 0) }}</span>
                            <small class="text-muted d-block mt-1">MTD growth {{
                                isset($revenueGrowthPct) ? number_format($revenueGrowthPct) . '%' : '—'
                            }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <span class="mr-3"><i class="ti ti-user"></i></span>
                        <div class="media-body text-right">
                            <p class="fs-14 mb-2">Admin Users</p>
                            <span class="fs-28">{{ number_format($totalUsers ?? 0) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4 col-lg-6 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <span class="mr-3"><i class="ti ti-server"></i></span>
                        <div class="media-body text-right">
                            <p class="fs-14 mb-2">System Amount (SOSCOM)</p>
                            <span class="fs-28">{{ number_format($systemAmountReceived ?? 0) }}</span>
                            <small class="text-muted d-block mt-1">Withdrawn {{ number_format($systemAmountWithdrawn ?? 0) }} · Outstanding {{ number_format($systemAmountOutstanding ?? 0) }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <span class="mr-3"><i class="ti ti-building"></i></span>
                        <div class="media-body text-right">
                            <p class="fs-14 mb-2">Schools Amount (All)</p>
                            <span class="fs-28">{{ number_format($schoolsAmountReceived ?? 0) }}</span>
                            <small class="text-muted d-block mt-1">Withdrawn {{ number_format($schoolsAmountWithdrawn ?? 0) }} · Outstanding {{ number_format($schoolsAmountOutstanding ?? 0) }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <span class="mr-3"><i class="ti ti-bar-chart"></i></span>
                        <div class="media-body text-right">
                            <p class="fs-14 mb-2">Gross Amount</p>
                            <span class="fs-28">{{ number_format(($totalRevenueTzs ?? 0)) }}</span>
                            <small class="text-muted d-block mt-1">System + Schools</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Requests Trend</h4>
                </div>
                <div class="card-body">
                    <div id="adminRequestsTrend" class="ct-chart ct-major-twelfth"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Revenue Breakdown</h4>
                </div>
                <div class="card-body">
                    <div id="adminRevenueBreakdown" class="ct-chart ct-square"></div>
                    <div class="text-center mt-2">
                        <span class="badge badge-success mr-2">Approved</span>
                        <span class="badge badge-secondary">Pending</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Recent Payments & Withdrawals</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Ref</th>
                                    <th>School</th>
                                    <th>System Amount</th>
                                    <th>System Withdrawn</th>
                                    <th>School Amount</th>
                                    <th>School Withdrawn</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse (($systemLedger ?? collect()) as $payment)
                                    <tr>
                                        <td>{{ $payment->reference }}</td>
                                        <td>{{ $payment->school->name ?? '—' }}</td>
                                        <td>{{ number_format($payment->system_amount) }}</td>
                                        <td>
                                            <span class="badge badge-{{ $payment->system_withdrawn ? 'success' : 'secondary' }}">
                                                {{ $payment->system_withdrawn ? 'Withdrawn' : 'Pending' }}
                                            </span>
                                        </td>
                                        <td>{{ number_format($payment->school_amount) }}</td>
                                        <td>
                                            <span class="badge badge-{{ $payment->school_withdrawn ? 'success' : 'secondary' }}">
                                                {{ $payment->school_withdrawn ? 'Withdrawn' : 'Pending' }}
                                            </span>
                                        </td>
                                        <td>{{ $payment->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">No payments recorded yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            try {
                var approved = parseInt({{ (int) ($approvedRequests ?? 0) }}) || 0;
                var pending = parseInt({{ (int) ($pendingRequests ?? 0) }}) || 0;
                var totalRevenue = parseInt({{ (int) ($totalRevenueTzs ?? 0) }}) || 0;

                var periods = ['W-6','W-5','W-4','W-3','W-2','W-1','Now'];
                function spread(total, points) {
                    var out = new Array(points).fill(0);
                    for (var i = 0; i < total; i++) out[i % points]++;
                    return out;
                }

                var approvedSeries = spread(approved, 7);
                var pendingSeries = spread(pending, 7);

                new Chartist.Line('#adminRequestsTrend', {
                    labels: periods,
                    series: [approvedSeries, pendingSeries]
                }, {
                    fullWidth: true,
                    chartPadding: { right: 20 },
                    low: 0,
                    showPoint: true
                });

                // Revenue donut: naive split: approved contributes most, pending minimal placeholder
                var approvedRev = Math.max(Math.round(totalRevenue * 0.9), 0);
                var pendingRev = Math.max(totalRevenue - approvedRev, 0);

                new Chartist.Pie('#adminRevenueBreakdown', {
                    series: [approvedRev, pendingRev]
                }, {
                    donut: true,
                    donutWidth: 40,
                    startAngle: 0,
                    showLabel: false
                });
            } catch (e) {
                // silent
            }
        });
    </script>
    @endrole

   </x-app-layout>
