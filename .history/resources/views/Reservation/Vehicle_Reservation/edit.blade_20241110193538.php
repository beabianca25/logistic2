@extends('base')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/document') }}">Document</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/document') }}">Document Submission</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Details</li>
    </ol>
</nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Document Request
                            <a href="{{ route('document.index') }}" class="btn btn-danger float-end">Back</a>
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

                        <form action="{{ route('vehicle_reservation.update', $vehiclereservation) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="vehicle_id">Vehicle</label>
                                <select name="vehicle_id" id="vehicle_id" class="form-control" required>
                                    @foreach($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}" {{ $vehicle->id == $vehiclereservation->vehicle_id ? 'selected' : '' }}>{{ $vehicle->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="driver_id">Driver</label>
                                <select name="driver_id" id="driver_id" class="form-control" required>
                                    @foreach($drivers as $driver)
                                        <option value="{{ $driver->id }}" {{ $driver->id == $vehiclereservation->driver_id ? 'selected' : '' }}>{{ $driver->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="seats">Seats</label>
                                <input type="number" name="seats" id="seats" class="form-control" value="{{ $vehiclereservation->seats }}" required>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="available" {{ $vehiclereservation->status == 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="booked" {{ $vehiclereservation->status == 'booked' ? 'selected' : '' }}>Booked</option>
                                    <option value="maintenance" {{ $vehiclereservation->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                    <option value="inactive" {{ $vehiclereservation->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" name="location" id="location" class="form-control" value="{{ $vehiclereservation->location }}">
                            </div>
                            <div class="form-group">
                                <label for="availability_date">Availability Date</label>
                                <input type="datetime-local" name="availability_date" id="availability_date" class="form-control" value="{{ $reservation->availability_date ? \Carbon\Carbon::parse($reservation->availability_date)->format('Y-m-d H:i') : }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Update Reservation</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
