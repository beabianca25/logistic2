@extends('base')

@section('content')
<nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: sans-serif;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/fleet') }}">Fleet Management</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/trip') }}">Trip List</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Trip</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4>Create New Trip
                    <a href="{{ route('trip.index') }}" class="btn btn-danger float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('trip.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="vehicle_id">Vehicle</label>
                        <select name="vehicle_id" class="form-control">
                            <option value="">Select a Vehicle</option>
                            @foreach ($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_type }} - {{ $vehicle->license_plate }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="driver_id">Driver</label>
                        <select name="driver_id" class="form-control">
                            <option value="">Assign a Driver</option>
                            @foreach ($drivers as $driver)
                                <option value="{{ $driver->id }}">{{ $driver->name }} - {{ $driver->license_number }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="starting_location">Starting Location</label>
                        <input type="text" name="starting_location" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="destination">Destination</label>
                        <input type="text" name="destination" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="trip_type">Trip Type</label>
                        <select name="trip_type" class="form-control">
                            <option value="One-Way">One-Way</option>
                            <option value="Round-Trip">Round-Trip</option>
                            <option value="Multi-Stop">Multi-Stop</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="departure_time">Departure Time</label>
                        <input type="datetime-local" name="departure_time" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="expected_arrival_time">Expected Arrival Time</label>
                        <input type="datetime-local" name="expected_arrival_time" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="route_details">Route Details</label>
                        <textarea name="route_details" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="distance_km">Distance (KM)</label>
                        <input type="number" step="0.01" name="distance_km" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="passenger_count">Passenger Count</label>
                        <input type="number" name="passenger_count" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="fuel_consumed">Fuel Consumed (Liters)</label>
                        <input type="number" step="0.01" name="fuel_consumed" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="fuel_cost">Fuel Cost</label>
                        <input type="number" step="0.01" name="fuel_cost" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="trip_expenses">Other Trip Expenses</label>
                        <input type="number" step="0.01" name="trip_expenses" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="gps_tracking_id">GPS Tracking ID</label>
                        <input type="text" name="gps_tracking_id" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="incident_report">Incident Report</label>
                        <textarea name="incident_report" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="weather_conditions">Weather Conditions</label>
                        <input type="text" name="weather_conditions" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="delay_reason">Delay Reason</label>
                        <textarea name="delay_reason" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="cargo_details">Cargo Details</label>
                        <textarea name="cargo_details" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="trip_notes">Trip Notes</label>
                        <textarea name="trip_notes" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="Scheduled">Scheduled</option>
                            <option value="Ongoing">Ongoing</option>
                            <option value="Completed">Completed</option>
                            <option value="Delayed">Delayed</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success mt-3">Save Trip</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
