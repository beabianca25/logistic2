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
                    <th>Remaining Stock</th>
                    <th>Report Title</th>
                    <th>Status</th>
                    <th>Submitted at</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($supplyReports as $report)
                    <tr>
                        <td>{{ $report->id }}</td>
                        <td>{{ $report->supply ? $report->supply->supply_name : 'No Supply' }}</td>
                        <td>{{ $report->supply ? $report->supply->remaining_stock : 'N/A' }}</td>
                        <td>{{ $report->report_title }}</td>
                        <td>
                            @if ($report->status === 'Pending Review')
                                <span class="badge bg-warning text-dark">{{ $report->status }}</span>
                            @elseif ($report->status === 'Reviewed')
                                <span class="badge bg-primary">{{ $report->status }}</span>
                            @else
                                <span class="badge bg-success">{{ $report->status }}</span>
                            @endif
                        </td>
                        <td>{{ $report->submitted_at }}</td>
                        <td>
                            <a href="{{ route('supplyreport.show', $report->id) }}" class="btn btn-info btn-sm">Show</a>
                            <a href="{{ route('supplyreport.edit', $report->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('supplyreport.destroy', $report->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" 
                                        onclick="return confirm('Are you sure you want to delete this report?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>

@endsection
