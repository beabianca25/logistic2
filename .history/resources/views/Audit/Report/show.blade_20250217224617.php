<!-- resources/views/Audit/Report/show.blade.php -->

@extends('base')

@section('content')
<div class="container">
    <h2>Audit Report Details</h2>

    <div class="card">
        <div class="card-header">
            <h4>{{ $auditReport->report_title }}</h4>
        </div>
        <div class="card-body">
            <p><strong>Report ID:</strong> {{ $auditReport->id }}</p>
            <p><strong>Status:</strong> {{ $auditReport->status }}</p>
            <p><strong>Location:</strong> {{ $auditReport->location ?? 'N/A' }}</p>
            <p><strong>Report Date:</strong> {{ \Carbon\Carbon::parse($auditReport->report_date)->format('F d, Y') }}</p>
            <p><strong>Report Details:</strong></p>
            <p>{{ $auditReport->report_details }}</p>

            <!-- Display related Supply or Asset based on auditable_type -->
            @if ($auditReport->auditable_type == 'App\Models\Supply')
                <h5>Related Supply:</h5>
                <p><strong>Supply Name:</strong> {{ $auditReport->auditable->supply_name }}</p>
                <p><strong>Remaining Stock:</strong> {{ $auditReport->auditable->remaining_stock }} units</p>
                <p><strong>Unit of Measurement:</strong> {{ $auditReport->auditable->unit_of_measurement }}</p>
                <p><strong>Storage Location:</strong> {{ $auditReport->auditable->storage_location }}</p>
            @elseif ($auditReport->auditable_type == 'App\Models\Asset')
                <h5>Related Asset:</h5>
                <p><strong>Asset Name:</strong> {{ $auditReport->auditable->asset_name }}</p>
                <p><strong>Asset Condition:</strong> {{ $auditReport->auditable->condition }}</p>
                <p><strong>Location:</strong> {{ $auditReport->auditable->location }}</p>
            @else
                <p><strong>No related supply or asset</strong></p>
            @endif

            <!-- Actions Section -->
            <div class="mt-4">
                <a href="{{ route('auditreports.edit', $auditReport) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('report.destroy', $auditReport) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this report?')">Delete</button>
                </form>
                <a href="{{ route('report.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
</div>
@endsection
