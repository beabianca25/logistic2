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

                        {{-- Vehicle Information --}}
                        <h4>Vehicle Information</h4>
                        <div class="form-group">
                            <label>Vehicle Type</label>
                            <input type="text" name="vehicle_type" class="form-control" value="{{ old('vehicle_type', $vehicle->vehicle_type) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Model</label>
                            <input type="text" name="model" class="form-control" value="{{ old('model', $vehicle->model) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Manufacturer</label>
                            <input type="text" name="manufacturer" class="form-control" value="{{ old('manufacturer', $vehicle->manufacturer) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Year of Manufacture</label>
                            <input type="number" name="year_of_manufacture" class="form-control" value="{{ old('year_of_manufacture', $vehicle->year_of_manufacture) }}" required>
                        </div>
                        <div class="form-group">
                            <label>License Plate</label>
                            <input type="text" name="license_plate" class="form-control" value="{{ old('license_plate', $vehicle->license_plate) }}" required>
                        </div>
                        <div class="form-group">
                            <label>VIN (Vehicle Identification Number)</label>
                            <input type="text" name="vin" class="form-control" value="{{ old('vin', $vehicle->vin) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Capacity</label>
                            <input type="number" name="capacity" class="form-control" value="{{ old('capacity', $vehicle->capacity) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Fuel Type</label>
                            <select name="fuel_type" class="form-control">
                                <option value="Petrol" {{ old('fuel_type', $vehicle->fuel_type) == 'Petrol' ? 'selected' : '' }}>Petrol</option>
                                <option value="Diesel" {{ old('fuel_type', $vehicle->fuel_type) == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                                <option value="Electric" {{ old('fuel_type', $vehicle->fuel_type) == 'Electric' ? 'selected' : '' }}>Electric</option>
                                <option value="Hybrid" {{ old('fuel_type', $vehicle->fuel_type) == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mileage</label>
                            <input type="number" name="mileage" class="form-control" value="{{ old('mileage', $vehicle->mileage) }}">
                        </div>
                        <div class="form-group">
                            <label>Color</label>
                            <input type="text" name="color" class="form-control" value="{{ old('color', $vehicle->color) }}">
                        </div>
                        <div class="form-group">
                            <label>Engine Number</label>
                            <input type="text" name="engine_number" class="form-control" value="{{ old('engine_number', $vehicle->engine_number) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Chassis Number</label>
                            <input type="text" name="chassis_number" class="form-control" value="{{ old('chassis_number', $vehicle->chassis_number) }}" required>
                        </div>
                        <div class="form-group">
                            <label>GPS Tracking ID</label>
                            <input type="text" name="gps_tracking_id" class="form-control" value="{{ old('gps_tracking_id', $vehicle->gps_tracking_id) }}">
                        </div>
                        <div class="form-group">
                            <label>Last Maintenance Date</label>
                            <input type="date" name="last_maintenance_date" class="form-control" value="{{ old('last_maintenance_date', $vehicle->last_maintenance_date) }}">
                        </div>
                        <div class="form-group">
                            <label>Next Maintenance Due</label>
                            <input type="date" name="next_maintenance_due" class="form-control" value="{{ old('next_maintenance_due', $vehicle->next_maintenance_due) }}">
                        </div>
                        <div class="form-group">
                            <label>Purchase Date</label>
                            <input type="date" name="purchase_date" class="form-control" value="{{ old('purchase_date', $vehicle->purchase_date) }}">
                        </div>
                        <div class="form-group">
                            <label>Purchase Price</label>
                            <input type="number" name="purchase_price" class="form-control" value="{{ old('purchase_price', $vehicle->purchase_price) }}">
                        </div>
                        <div class="form-group">
                            <label>Depreciation Value</label>
                            <input type="number" name="depreciation_value" class="form-control" value="{{ old('depreciation_value', $vehicle->depreciation_value) }}">
                        </div>
                        <div class="form-group">
                            <label>Registration Expiry Date</label>
                            <input type="date" name="registration_expiry_date" class="form-control" value="{{ old('registration_expiry_date', $vehicle->registration_expiry_date) }}">
                        </div>
                        <div class="form-group">
                            <label>Owner Name</label>
                            <input type="text" name="owner_name" class="form-control" value="{{ old('owner_name', $vehicle->owner_name) }}">
                        </div>
                        <div class="form-group">
                            <label>Leasing Details</label>
                            <textarea name="leasing_details" class="form-control">{{ old('leasing_details', $vehicle->leasing_details) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Current Status</label>
                            <select name="current_status" class="form-control">
                                <option value="Active" {{ old('current_status', $vehicle->current_status) == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ old('current_status', $vehicle->current_status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="Maintenance" {{ old('current_status', $vehicle->current_status) == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                                <option value="Retired" {{ old('current_status', $vehicle->current_status) == 'Retired' ? 'selected' : '' }}>Retired</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Update Vehicle</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
