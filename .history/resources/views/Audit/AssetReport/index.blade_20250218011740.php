@extends('base')

@section('content')
<!-- Inside your index.blade.php view file -->

<div class="container">
    <h2>Audit Reports</h2>

    <!-- Asset Reports Table -->
    <h3>Asset Reports</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Asset Name</th>
                <th>Report Title</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($auditReports->where('asset_id', '!=', null) as $report)
            <tr>
                <td>{{ $report->id }}</td>
                <td>{{ $report->asset->asset_name }}</td> <!-- Display asset name -->
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

    <!-- Pagination Links for Asset Reports -->
    <div class="d-flex justify-content-center">
        {{ $auditReports->where('asset_id', '!=', null)->links() }}
    </div>

    <hr>

    <!-- Supply Reports Table -->
    <h3>Supply Reports</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Supply Name</th>
                <th>Report Title</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($auditReports->where('supply_id', '!=', null) as $report)
            <tr>
                <td>{{ $report->id }}</td>
                <td>{{ $report->supply->supply_name }}</td> <!-- Display supply name -->
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

    <!-- Pagination Links for Supply Reports -->
    <div class="d-flex justify-content-center">
        {{ $auditReports->where('supply_id', '!=', null)->links() }}
    </div>
</div>

@endsection

@section('styles')
    <style>
        /* Pagination arrow size */
        .pagination .page-item .page-link {
            font-size: 14px;  /* Adjust to your preferred size */
            padding: 6px 12px; /* Adjust padding to make it smaller */
        }

        .pagination .page-item.active .page-link {
            font-size: 14px;  /* Same font size for active page */
            padding: 6px 12px; /* Same padding for consistency */
        }

        .pagination .page-item .page-link svg {
            width: 16px;  /* Adjust the width of the arrow */
            height: 16px; /* Adjust the height of the arrow */
        }
    </style>
@endsection
