@extends('base')

@section('content')
<div class="container">
    <h2>Edit Assigned Vehicles for Reservation #{{ $reservation->id }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reservationvehicle.update', $reservation->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="vehicle_id">Select Vehicles</label>
            <select name="vehicle_id[]" id="vehicle_id" class="form-control" multiple required>
                @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}" 
                        @if($reservation->vehicles->contains($vehicle->id)) selected @endif>
                        {{ $vehicle->name }} ({{ $vehicle->registration_number }})
                    </option>
                @endforeach
            </select>
            <small class="text-muted">Hold CTRL to select multiple vehicles</small>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('reservationvehicle.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
