@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/fleet') }}">Fleet Management</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/vehicle') }}">Manage Detail</a></li>
            <li class="breadcrumb-item active" aria-current="page">Trip Details</li>
        </ol>
    </nav>

    <div class="container">
        <h1>Trip Details</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><strong>Vehicle:</strong> {{ $trip->vehicle ? $trip->vehicle->vehicle_type : 'N/A' }}</h5>
                <p><strong>Starting Location:</strong> {{ $trip->starting_location }}</p>
                <p><strong>Destination:</strong> {{ $trip->destination }}</p>
                <p><strong>Departure Time:</strong> {{ \Carbon\Carbon::parse($trip->departure_time)->format('Y-m-d H:i') }}</p>
                <p><strong>Expected Arrival Time:</strong> {{ \Carbon\Carbon::parse($trip->expected_arrival_time)->format('Y-m-d H:i') }}</p>
                <p><strong>Status:</strong> {{ ucfirst($trip->status) }}</p>
                <a href="{{ route('trip.index') }}" class="btn btn-primary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
