<!-- resources/views/Audit/Report/index.blade.php -->

@extends('base')

@section('content')
<!-- Inside your index.blade.php view file -->

<div class="container">
    <h2>Audit Reports</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Supply/Asset Name</th>
                <th>Report Title</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($auditReports as $report)
                <tr>
                    <td>{{ $report->id }}</td>
                    <td>
                        @if ($report->auditable_type == 'App\Models\Supply')
                            {{ $report->auditable->supply_name }} <!-- Display supply name -->
                        @elseif ($report->auditable_type == 'App\Models\Asset')
                            {{ $report->auditable->asset_name }} <!-- Display asset name -->
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $report->report_title }}</td>
                    <td>{{ $report->status }}</td>
                    <td>
                        <a href="{{ route('audit.show', $report) }}" class="btn btn-primary">View</a>
                        <a href="{{ route('document.create', $report) }}" class="btn btn-success">Submit to Document Tracking</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        {{ $auditReports->links() }}
    </div>
</div>

@endsection
