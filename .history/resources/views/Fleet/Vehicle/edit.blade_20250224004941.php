@extends('base')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/fleet') }}">Fleet Management</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/vehicle') }}">Vehicle List</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Details</li>
    </ol>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Vehicle Details
                        <a href="{{ route('vehicle.index') }}" class="btn btn-danger float-end">Back</a>
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

                    <form action="{{ route('vehicle.update', $vehicle->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') 

                        <div class="form-group">
                            <label for="vehicle_type">Vehicle Type</label>
                            <select name="vehicle_type" id="vehicle_type" class="form-control" required>
                                <option value="" disabled>Select Vehicle Type</option>
                                <option value="Car" {{ old('vehicle_type', $vehicle->vehicle_type) == 'Car' ? 'selected' : '' }}>Car</option>
                                <option value="Bus" {{ old('vehicle_type', $vehicle->vehicle_type) == 'Bus' ? 'selected' : '' }}>Bus</option>
                                <option value="Truck" {{ old('vehicle_type', $vehicle->vehicle_type) == 'Truck' ? 'selected' : '' }}>Truck</option>
                                <option value="Van" {{ old('vehicle_type', $vehicle->vehicle_type) == 'Van' ? 'selected' : '' }}>Van</option>
                                <option value="Motorcycle" {{ old('vehicle_type', $vehicle->vehicle_type) == 'Motorcycle' ? 'selected' : '' }}>Motorcycle</option>
                                <option value="Other" {{ old('vehicle_type', $vehicle->vehicle_type) == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="model">Model</label>
                            <input type="text" name="model" id="model" class="form-control" value="{{ old('model', $vehicle->model) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="license_plate">License Plate</label>
                            <input type="text" name="license_plate" id="license_plate" class="form-control" value="{{ old('license_plate', $vehicle->license_plate) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="vin">VIN</label>
                            <input type="text" name="vin" id="vin" class="form-control" value="{{ old('vin', $vehicle->vin) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="capacity">Capacity</label>
                            <input type="number" name="capacity" id="capacity" class="form-control" value="{{ old('capacity', $vehicle->capacity) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="fuel_type">Fuel Type</label>
                            <select name="fuel_type" id="fuel_type" class="form-control" required>
                                <option value="Petrol" {{ old('fuel_type', $vehicle->fuel_type) == 'Petrol' ? 'selected' : '' }}>Petrol</option>
                                <option value="Diesel" {{ old('fuel_type', $vehicle->fuel_type) == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                                <option value="Electric" {{ old('fuel_type', $vehicle->fuel_type) == 'Electric' ? 'selected' : '' }}>Electric</option>
                                <option value="Hybrid" {{ old('fuel_type', $vehicle->fuel_type) == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="mileage">Mileage (km)</label>
                            <input type="number" name="mileage" id="mileage" class="form-control" value="{{ old('mileage', $vehicle->mileage) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="year">Year of Manufacture</label>
                            <input type="number" name="year" id="year" class="form-control" value="{{ old('year', $vehicle->year) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="current_status">Current Status</label>
                            <select name="current_status" id="current_status" class="form-control" required>
                                <option value="Active" {{ old('current_status', $vehicle->current_status) == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ old('current_status', $vehicle->current_status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="Maintenance" {{ old('current_status', $vehicle->current_status) == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                                <option value="Retired" {{ old('current_status', $vehicle->current_status) == 'Retired' ? 'selected' : '' }}>Retired</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="insurance_info">Insurance Information</label>
                            <textarea name="insurance_info" id="insurance_info" class="form-control">{{ old('insurance_info', $vehicle->insurance_info) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="additional_notes">Additional Notes</label>
                            <textarea name="additional_notes" id="additional_notes" class="form-control">{{ old('additional_notes', $vehicle->additional_notes) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="image">Vehicle Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                            @if ($vehicle->image_path)
                                <div>
                                    <label>Current Image:</label>
                                    <img src="{{ asset('storage/' . $vehicle->image_path) }}" alt="Vehicle Image" style="max-width: 200px; max-height: 200px;">
                                </div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Update Vehicle</button>
                        <a href="{{ route('vehicle.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
