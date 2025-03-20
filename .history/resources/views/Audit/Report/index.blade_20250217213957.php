<!-- resources/views/audit_reports/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Audit Reports</h1>

    <a href="{{ route('audit_reports.create') }}" class="btn btn-primary">Create New Report</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Title</th>
                <th>Details</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($auditReports as $report)
                <tr>
                    <td>{{ $report->report_title }}</td>
                    <td>{{ $report->report_details }}</td>
                    <td>{{ $report->status }}</td>
                    <td>{{ $report->report_date }}</td>
                    <td>
                        <a href="{{ route('report.show', $report) }}" class="btn btn-info">View</a>
                        <a href="{{ route('report.edit', $report) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('report.destroy', $report) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
