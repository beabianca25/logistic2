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

                <!-- Actions Section -->
                <div class="mt-4">
                    {{-- Uncomment if edit functionality is needed --}}
                    {{-- <a href="{{ route('audit.edit', $auditReport) }}" class="btn btn-warning">Edit</a> --}}
                    
                    {{-- Uncomment if delete functionality is needed --}}
                    {{-- <form action="{{ route('audit.destroy', $auditReport) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete this report?')">Delete</button>
                    </form> --}}
                    
                    <a href="{{ route('audit.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
@endsection
