@extends('base')

@section('content')

<div class="container mt-5">
    <h2 class="mb-4">Supply Report Details</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $supplyReport->report_title }}</h5>
            <p class="card-text"><strong>Supply Name:</strong> {{ $supplyReport->supply ? $supplyReport->supply->supply_name : 'No Supply' }}</p>
            <p class="card-text"><strong>Remaining Stock:</strong> {{ $supplyReport->supply ? $supplyReport->supply->remaining_stock : 'N/A' }}</p>
            <p class="card-text"><strong>Description:</strong> {{ $supplyReport->description }}</p>
            <p class="card-text"><strong>Status:</strong> {{ $supplyReport->status }}</p>
            <p class="card-text"><strong>Location:</strong> {{ $supplyReport->storage_location }}</p>
            <p class="card-text"><strong>Report Date:</strong> {{ $supplyReport->report_date }}</p>
            
            <a href="{{ route('supplyreport.index') }}" class="btn btn-primary">Back to Reports</a>
        </div>
    </div>
</div>

@endsection
