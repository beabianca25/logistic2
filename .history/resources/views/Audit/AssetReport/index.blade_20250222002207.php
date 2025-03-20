@extends('base') {{-- Extend your main layout --}}

@section('content')
<div class="container">
    <h2 class="my-4">Asset Reports</h2>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Button to add new report --}}
    <a href="{{ route('assetreport.create') }}" class="btn btn-primary mb-3">Add New Report</a>

    {{-- Reports Table --}}
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Asset</th>
                <th>Report Title</th>
                <th>Report Type</th>
                <th>Status</th>
                <th>Report Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($assetReports as $report)
            <tr>
                <td>{{ $report->id }}</td>
                <td>{{ $report->asset->asset_name ?? 'N/A' }}</td> {{-- Show asset name --}}
                <td>{{ $report->report_title }}</td>
                <td>{{ $report->report_type }}</td>
                <td>
                    @if($report->status === 'Pending Review')
                        <span class="badge badge-warning">{{ $report->status }}</span>
                    @elseif($report->status === 'Reviewed')
                        <span class="badge badge-primary">{{ $report->status }}</span>
                    @else
                        <span class="badge badge-success">{{ $report->status }}</span>
                    @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($report->report_date)->format('M d, Y') }}</td>
                <td>
                    {{-- View button --}}
                    <a href="{{ route('assetreport.show', $report->id) }}" class="btn btn-info btn-sm">View</a>

                    {{-- Edit button --}}
                    <a href="{{ route('assetreport.edit', $report->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    {{-- Delete button with confirmation --}}
                    <form action="{{ route('assetreport.destroy', $report->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $reports->links() }}
    </div>
</div>
@endsection
