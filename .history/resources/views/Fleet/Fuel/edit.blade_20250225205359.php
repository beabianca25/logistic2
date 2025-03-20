@extends('base')

@section('content')
    <div class="container mt-4">
        <h2>Edit Fuel Record</h2>
        <form action="{{ route('fuel.update', $fuel->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="vehicle_id">Vehicle</label>
                <select name="vehicle_id" id="vehicle_id" class="form-control">
                    <option value="">Select Vehicle</option>
                    @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}" {{ $fuel->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                            {{ $vehicle->vehicle_type }} - {{ $vehicle->license_plate }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="refill_date">Refill Date</label>
                <input type="date" name="refill_date" id="refill_date" class="form-control" value="{{ $fuel->refill_date }}" required>
            </div>

            <div class="form-group">
                <label for="fuel_amount">Fuel Amount (liters/gallons)</label>
                <input type="number" step="0.01" name="fuel_amount" id="fuel_amount" class="form-control" value="{{ $fuel->fuel_amount }}" required>
            </div>
            
            <div class="form-group">
                <label for="cost">Cost ($)</label>
                <input type="number" step="0.01" name="cost" id="cost" class="form-control" value="{{ $fuel->cost }}" required>
            </div>
            
            <div class="form-group">
                <label for="fuel_station">Fuel Station</label>
                <input type="text" name="fuel_station" id="fuel_station" class="form-control" value="{{ $fuel->fuel_station }}" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update Fuel Record</button>
        </form>
    </div>
@endsection