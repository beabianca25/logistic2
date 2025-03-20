@extends('base')

@section('content')
    <div class="container mt-5">
        <a href="{{ route('supplyreport.index') }}" class="btn btn-outline-secondary mb-3">Back</a>

        <h2 class="mb-4">Supply Report Details</h2>

        <div class="card">
            <div class="card-body">
                @foreach ($supplyReports as $report)
                    
               
                <h5 class="card-title">{{ $report->report_title }}</h5>
                <p class="card-text"><strong>Supply Name:</strong> {{ $report->supply ? $report->supply->supply_name : 'No Supply' }}</p>
                <p class="card-text"><strong>Remaining Stock:</strong> {{ $report->supply ? $report->supply->remaining_stock : 'N/A' }}</p>
                <p class="card-text"><strong>Description:</strong> {{ $report->description }}</p>
                <p class="card-text"><strong>Status:</strong> {{ $report->status }}</p>
                <p class="card-text"><strong>Location:</strong> {{ $report->storage_location }}</p>
                <p class="card-text"><strong>Report Date:</strong> {{ $report->report_date }}</p>
                @endforeach
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('supplyreport.edit', $report->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('supplyreport.destroy', $report->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>
@endsection
