@extends('base')

@section('content')
<nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: sans-serif;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/fleet') }}">Fleet Management</a></li>
        <li class="breadcrumb-item"><a href="{{ route('trip.index') }}">Trip List</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Trip</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4>Edit Trip
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

                <form action="{{ route('trip.update', $trip->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="vehicle_id">Vehicle</label>
                        <select name="vehicle_id" class="form-control">
                            <option value="">Select a Vehicle</option>
                            @foreach ($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}" {{ $trip->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                                    {{ $vehicle->vehicle_type }} - {{ $vehicle->license_plate }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="driver_id">Driver</label>
                        <select name="driver_id" class="form-control">
                            <option value="">Assign a Driver</option>
                            @foreach ($drivers as $driver)
                                <option value="{{ $driver->id }}" {{ $trip->driver_id == $driver->id ? 'selected' : '' }}>
                                    {{ $driver->name }} - {{ $driver->license_number }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="starting_location">Starting Location</label>
                        <input type="text" name="starting_location" class="form-control" value="{{ $trip->starting_location }}" required>
                    </div>

                    <div class="form-group">
                        <label for="destination">Destination</label>
                        <input type="text" name="destination" class="form-control" value="{{ $trip->destination }}" required>
                    </div>

                    <div class="form-group">
                        <label for="trip_type">Trip Type</label>
                        <select name="trip_type" class="form-control">
                            <option value="One-Way" {{ $trip->trip_type == 'One-Way' ? 'selected' : '' }}>One-Way</option>
                            <option value="Round-Trip" {{ $trip->trip_type == 'Round-Trip' ? 'selected' : '' }}>Round-Trip</option>
                            <option value="Multi-Stop" {{ $trip->trip_type == 'Multi-Stop' ? 'selected' : '' }}>Multi-Stop</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="departure_time">Departure Time</label>
                        <input type="datetime-local" name="departure_time" class="form-control" value="{{ $trip->departure_time }}" required>
                    </div>

                    <div class="form-group">
                        <label for="expected_arrival_time">Expected Arrival Time</label>
                        <input type="datetime-local" name="expected_arrival_time" class="form-control" value="{{ $trip->expected_arrival_time }}" required>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="Scheduled" {{ $trip->status == 'Scheduled' ? 'selected' : '' }}>Scheduled</option>
                            <option value="Ongoing" {{ $trip->status == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                            <option value="Completed" {{ $trip->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                            <option value="Delayed" {{ $trip->status == 'Delayed' ? 'selected' : '' }}>Delayed</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success mt-3">Update Trip</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
