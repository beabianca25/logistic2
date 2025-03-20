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
                @foreach ($supplyReports as $report)
                    <tr>
                        <td>{{ $report->id }}</td>
                        <td>{{ $report->supply ? $report->supply->supply_name : 'No Supply' }}</td>
                        <td>{{ $report->supply ? $report->supply->remaining_stock : 'N/A' }}</td> <!-- Display Remaining Stock -->
                        <td>{{ $report->report_title }}</td>
                        <td>{{ $report->description }}</td>
                        <td>{{ $report->status }}</td>
                        <td>{{ $report->storage_location }}</td>
                        <td>{{ $report->report_date }}</td>
                        <td>
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
