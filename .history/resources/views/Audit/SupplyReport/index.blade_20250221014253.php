@extends('base')

@section('content')

    <div class="container mt-5">
        <h2>Supply Reports</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Supply Name</th>
                    <th>Remaining Stock</th> <!-- Added column for remaining stock -->
                    <th>Report Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Location</th>
                    <th>Report Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($supplyReports) && $supplyReports->count() > 0)
                @foreach ($supplyReports as $report)
                    <tr>
                        <td>{{ $report->id }}</td>
                        <td>{{ optional($report->supply)->supply_name ?? 'No Supply' }}</td>
                        <td>{{ optional($report->supply)->remaining_stock ?? 'N/A' }}</td>
                        <td>{{ $report->report_title }}</td>
                        <td>{{ $report->report_details }}</td>
                        <td>{{ $report->status }}</td>
                        <td>{{ $report->document_status }}</td>
                        <td>{{ $report->submitted_at }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8" class="text-center">No Supply Reports Available</td>
                </tr>
            @endif
            
            </tbody>
        </table>
        
    </div>

@endsection
