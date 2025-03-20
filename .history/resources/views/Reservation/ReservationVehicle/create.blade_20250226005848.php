@extends('base')

@section('content')
<div class="container">
    <h2 class="mb-4">Assign Vehicle to Reservation</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reservationvehicle.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="vehicle_reservation_id">Select Reservation</label>
            <select name="vehicle_reservation_id" id="vehicle_reservation_id" class="form-control" required>
                <option value="" disabled selected>Choose a Reservation</option>
                @foreach($reservations as $reservation)
                    <option value="{{ $reservation->id }}">Reservation #{{ $reservation->id }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="vehicle_id">Select Vehicles</label>
            <select name="vehicle_id[]" id="vehicle_id" class="form-control" multiple required>
                @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}">{{ $vehicle->name }} ({{ $vehicle->registration_number }})</option>
                @endforeach
            </select>
            <small class="text-muted">Hold CTRL to select multiple vehicles</small>
        </div>

        <button type="submit" class="btn btn-success">Assign Vehicle</button>
        <a href="{{ route('reservationvehicle.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
