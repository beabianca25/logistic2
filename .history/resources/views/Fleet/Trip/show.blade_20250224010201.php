@extends('base')

@section('content')
<nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: sans-serif;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/fleet') }}">Fleet Management</a></li>
        <li class="breadcrumb-item"><a href="{{ route('trip.index') }}">Trip List</a></li>
        <li class="breadcrumb-item active" aria-current="page">Trip Details</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4>Trip Details
                    <a href="{{ route('trip.index') }}" class="btn btn-danger float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>Trip ID</th>
                        <td>{{ str_pad(strtoupper(dechex($trip->id)), 4, '0', STR_PAD_LEFT) }}</td>
                    </tr>
                    <tr>
                        <th>Vehicle</th>
                        <td>{{ optional($trip->vehicle)->license_plate ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Driver</th>
                        <td>{{ optional($trip->driver)->name ?? 'Unassigned' }}</td>
                    </tr>
                    <tr>
                        <th>Starting Location</th>
                        <td>{{ $trip->starting_location }}</td>
                    </tr>
                    <tr>
                        <th>Destination</th>
                        <td>{{ $trip->destination }}</td>
                    </tr>
                    <tr>
                        <th>Trip Type</th>
                        <td>{{ $trip->trip_type }}</td>
                    </tr>
                    <tr>
                        <th>Departure Time</th>
                        <td>{{ \Carbon\Carbon::parse($trip->departure_time)->format('Y-m-d H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Expected Arrival</th>
                        <td>{{ \Carbon\Carbon::parse($trip->expected_arrival_time)->format('Y-m-d H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ ucfirst($trip->status) }}</td>
                    </tr>
                    <tr>
                        <th>Route Details</th>
                        <td>{{ $trip->route_details ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Distance (KM)</th>
                        <td>{{ $trip->distance_km ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Fuel Cost</th>
                        <td>${{ number_format($trip->fuel_cost, 2) ?? '0.00' }}</td>
                    </tr>
                    <tr>
                        <th>Trip Expenses</th>
                        <td>${{ number_format($trip->trip_expenses, 2) ?? '0.00' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
