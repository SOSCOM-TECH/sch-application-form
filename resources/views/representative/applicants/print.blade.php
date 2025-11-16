<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Applicants - Printable</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none; }
        }
    </style>
    </head>
<body>
    <div class="container my-4">
        <div class="no-print mb-3">
            <button class="btn btn-primary" onclick="window.print()">Print</button>
        </div>
        <h3>Applicants</h3>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Submission Ref</th>
                        <th>Form</th>
                        <th>Payment Ref</th>
                        <th>Payment Status</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($submissions as $s)
                        <tr>
                            <td>{{ $s->reference }}</td>
                            <td>{{ $s->form->title }}</td>
                            <td>{{ optional($s->payment)->reference }}</td>
                            <td>{{ optional($s->payment)->status }}</td>
                            <td>{{ number_format(optional($s->payment)->amount ?? 0) }}</td>
                            <td>{{ $s->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>


