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
                    <th>Description</th> <!-- Added -->
                    <th>Status</th>
                    <th>Location</th> <!-- Added -->
                    <th>Report Date</th> <!-- Added -->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($supplyReports as $report)
                    <tr>
                        <td>{{ $report->id }}</td>
                        <td>{{ optional($report->supply)->supply_name ?? 'No Supply' }}</td>
                        <td>{{ optional($report->supply)->remaining_stock ?? 'N/A' }}</td>
                        <td>{{ $report->report_title }}</td>
                        <td>{{ $report->description ?? 'No Description' }}</td> <!-- Display description -->
                        <td>{{ $report->status }}</td>
                        <td>{{ $report->storage_location ?? 'No Location' }}</td> <!-- Display location -->
                        <td>{{ $report->report_date ? \Carbon\Carbon::parse($report->report_date)->format('Y-m-d') : 'No Date' }}</td> <!-- Format date -->
                        <td>
                            <a href="{{ route('supplyreport.edit', $report->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('supplyreport.destroy', $report->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            
        </table>
        
    </div>

@endsection
