<x-app-layout>

    <div class="row align-items-center mb-3 border-bottom">
        <div class="col">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">
                        @if($school)
                            {{ $school->name }} — Dashboard
                        @else
                            Dashboard
                        @endif
                    </a>
                </li>
            </ul>
        </div>
    </div>

    @if(!$school)
        {{-- No School Registered Section --}}
        <div class="row">
            <div class="col">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Get Started with Your School Registration</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <i class="ti ti-info-alt"></i>
                            <strong>Welcome!</strong> To unlock all dashboard features, you need to register your school first.
                            Choose a commission package that works best for your institution and complete the registration process.
                        </div>

                        @if($packages && $packages->count() > 0)
                            <div class="row">
                                <div class="col mb-3">
                                    <h5 class="mb-3">Available Commission Packages</h5>
                                </div>
                            </div>
                            <div class="row">
                                @foreach($packages as $package)
                                    <div class="col-lg-4 col-md-6 col mb-3">
                                        <div class="card h-100 shadow-sm {{ $package->sort_order == 1 ? 'border-primary' : '' }}">
                                            @if($package->sort_order == 1)
                                                <div class="card-header bg-primary text-center py-2">
                                                    <span class="badge bg-light">RECOMMENDED</span>
                                                </div>
                                            @endif
                                            <div class="card-body text-center p-3">
                                                <h6 class="card-title mb-2">{{ $package->name }}</h6>
                                                @if($package->description)
                                                    <p class="text-muted small mb-2">{{ $package->description }}</p>
                                                @endif
                                                <div class="mb-3">
                                                    <div class="fw-bold text-primary fs-3 mb-1">{{ $package->system_percentage }}%</div>
                                                    <p class="text-muted small mb-0">Platform commission</p>
                                                    <div class="fw-bold text-success fs-5 mt-2">{{ $package->school_percentage }}%</div>
                                                    <p class="text-muted small mb-0">Your earnings</p>
                                                </div>
                                                @if($package->features && count($package->features) > 0)
                                                    <ul class="list-unstyled text-left small mb-3">
                                                        @foreach($package->features as $feature)
                                                            <li><i class="ti ti-check text-success"></i> {{ $feature }}</li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                            <div class="card-footer bg-transparent border-0">
                                                <a href="{{ route('rep.school-registration.create', ['package' => $package->id]) }}" class="btn btn-primary w-100 btn-sm">
                                                    <i class="ti ti-arrow-right"></i> Get Started
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- School Dashboard Content --}}
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <span class="mr-3"><i class="ti ti-user"></i></span>
                                    <div class="media-body text-right">
                                        <p class="fs-14 mb-2">Applicants</p>
                                        <span class="fs-28">{{ $applicantCount ?? 0 }}</span>
                                        <div class="progress mt-2" style="height:6px;">
                                            @php($unpaid = max(($applicantCount ?? 0) - ($paidCount ?? 0), 0))
                                            @php($appPct = ($applicantCount ?? 0) > 0 ? number_format((($paidCount ?? 0) / $applicantCount) * 100, 0) : 0)
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $appPct }}%"></div>
                                        </div>
                                        <small class="text-muted d-block mt-1">{{ $paidCount ?? 0 }} paid, {{ $unpaid }} unpaid</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <span class="mr-3"><i class="ti ti-wallet"></i></span>
                                    <div class="media-body text-right">
                                        <p class="fs-14 mb-2">Paid</p>
                                        <span class="fs-28">{{ $paidCount ?? 0 }}</span>
                                        <div class="progress mt-2" style="height:6px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $appPct }}%"></div>
                                        </div>
                                        <small class="text-muted d-block mt-1">{{ $appPct }}% conversion</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <span class="mr-3"><i class="ti ti-money"></i></span>
                                    <div class="media-body text-right">
                                        <p class="fs-14 mb-2">Revenue (TZS)</p>
                                        <span class="fs-28">{{ number_format($revenueTzs ?? 0) }}</span>
                                        <small class="text-muted d-block mt-1">Avg/paid: {{
                                            ($paidCount ?? 0) > 0
                                            ? number_format(round(($revenueTzs ?? 0) / max($paidCount,1)))
                                            : '—'
                                        }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <span class="mr-3"><i class="ti ti-agenda"></i></span>
                                    <div class="media-body text-right">
                                        <p class="fs-14 mb-2">Application Fee</p>
                                        <span class="fs-28">{{ $applicationFee ? number_format($applicationFee) . ' TZS' : '—' }}</span>
                                        <small class="text-muted d-block mt-1">Configured per applicant</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4 col-lg-6 col mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <span class="mr-3"><i class="ti ti-wallet"></i></span>
                                    <div class="media-body text-right">
                                        <p class="fs-14 mb-2">School Amount Received</p>
                                        <span class="fs-28">{{ number_format($schoolAmountReceived ?? 0) }}</span>
                                        <small class="text-muted d-block mt-1">All successful payments</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <span class="mr-3"><i class="ti ti-arrow-up"></i></span>
                                    <div class="media-body text-right">
                                        <p class="fs-14 mb-2">Withdrawn</p>
                                        <span class="fs-28">{{ number_format($schoolAmountWithdrawn ?? 0) }}</span>
                                        <small class="text-muted d-block mt-1">Outstanding {{ number_format($schoolAmountOutstanding ?? 0) }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <span class="mr-3"><i class="ti ti-layout"></i></span>
                                    <div class="media-body text-right">
                                        <p class="fs-14 mb-2">System Share</p>
                                        <span class="fs-28">{{ number_format($systemShareForSchool ?? 0) }}</span>
                                        <small class="text-muted d-block mt-1">Commission retained</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8 col mb-3">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title">Active Form</h4>
                            </div>
                            <div class="card-body">
                                @if ($activeForm ?? null)
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="h5 mb-1">{{ $activeForm->title }}</div>
                                            <div class="text-muted">Public link: <a href="#" target="_blank">Open</a></div>
                                        </div>
                                        <a href="#" class="btn btn-outline-primary btn-sm">Manage</a>
                                    </div>
                                @else
                                    <p class="mb-2">No active form yet.</p>
                                    <a href="{{ route('rep.forms.create') }}" class="btn btn-primary">Create Application Form</a>
                                @endif
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Applicants Trend</h4>
                            </div>
                            <div class="card-body">
                                <div id="applicantsTrend" class="ct-chart ct-major-twelfth"></div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Recent Payments & Withdrawals</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Ref</th>
                                                <th>Form</th>
                                                <th>Amount</th>
                                                <th>School Amount</th>
                                                <th>School Withdrawn</th>
                                                <th>System Amount</th>
                                                <th>System Withdrawn</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse (($recentPayments ?? collect()) as $payment)
                                                <tr>
                                                    <td>{{ $payment->reference }}</td>
                                                    <td>{{ $payment->form->title ?? '—' }}</td>
                                                    <td>{{ number_format($payment->amount) }}</td>
                                                    <td>{{ number_format($payment->school_amount) }}</td>
                                                    <td>
                                                        <span class="badge badge-{{ $payment->school_withdrawn ? 'success' : 'secondary' }}">
                                                            {{ $payment->school_withdrawn ? 'Withdrawn' : 'Pending' }}
                                                        </span>
                                                    </td>
                                                    <td>{{ number_format($payment->system_amount) }}</td>
                                                    <td>
                                                        <span class="badge badge-{{ $payment->system_withdrawn ? 'success' : 'secondary' }}">
                                                            {{ $payment->system_withdrawn ? 'Withdrawn' : 'Pending' }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $payment->created_at->format('Y-m-d') }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8">No payments yet.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col mb-3">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Revenue Breakdown</h4>
                            </div>
                            <div class="card-body">
                                <div id="revenueBreakdown" class="ct-chart ct-square"></div>
                                <div class="text-center mt-2">
                                    <span class="badge badge-success mr-2">Paid</span>
                                    <span class="badge badge-secondary">Unpaid</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        try {
                            var applicants = parseInt({{ (int) ($applicantCount ?? 0) }}) || 0;
                            var paid = parseInt({{ (int) ($paidCount ?? 0) }}) || 0;
                            var unpaid = Math.max(applicants - paid, 0);

                            // Applicants Trend (simple synthetic split over last 7 periods)
                            var periods = ['W-6','W-5','W-4','W-3','W-2','W-1','Now'];
                            function spread(total, points) {
                                var out = new Array(points).fill(0);
                                for (var i = 0; i < total; i++) out[i % points]++;
                                return out;
                            }
                            var applicantsSeries = spread(applicants, 7);
                            var paidSeries = spread(paid, 7);

                            new Chartist.Line('#applicantsTrend', {
                                labels: periods,
                                series: [
                                    applicantsSeries,
                                    paidSeries
                                ]
                            }, {
                                fullWidth: true,
                                chartPadding: { right: 20 },
                                low: 0,
                                showPoint: true
                            });

                            // Revenue Breakdown (Paid vs Unpaid)
                            new Chartist.Pie('#revenueBreakdown', {
                                series: [paid, unpaid]
                            }, {
                                donut: true,
                                donutWidth: 40,
                                startAngle: 0,
                                showLabel: false
                            });
                        } catch (e) {
                            // fail-safe: do nothing if Chartist not available
                        }
                    });
                </script>
            </div>
        </div>
    @endif

</x-app-layout>
