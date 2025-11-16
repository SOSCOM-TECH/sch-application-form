<x-app-layout>
    <div class="row page-titles mx-0 border">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Fraud Detection Logs</h4>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Message</th>
                            <th>Context</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($logs as $log)
                            <tr>
                                <td>{{ $log->type }}</td>
                                <td>{{ $log->message }}</td>
                                <td><pre class="mb-0">{{ json_encode($log->context, JSON_PRETTY_PRINT) }}</pre></td>
                                <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4">No logs.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $logs->links() }}
        </div>
    </div>
</x-app-layout>


