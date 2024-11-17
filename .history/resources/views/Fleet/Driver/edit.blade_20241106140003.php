@extends('base')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Fleet Management</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/auction') }}">Vehicle List</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Details</li>
    </ol>
</nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Vehicle Request
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
                            @method('PUT') <!-- This method is required for updating the resource -->
                            
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
                                <input type="number" name="license_plate" id="license_plate" class="form-control" value="{{ old('license_plate', $vehicle->license_plate) }}" required>
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
                                <label for="current_status">Current Status</label>
                                <select name="current_status" id="current_status" class="form-control" required>
                                    <option value="active" {{ old('current_status', $vehicle->current_status) == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('current_status', $vehicle->current_status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    <option value="maintenance" {{ old('current_status', $vehicle->current_status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                    <option value="retired" {{ old('current_status', $vehicle->current_status) == 'retired' ? 'selected' : '' }}>Retired</option>
                                </select>
                            </div>
                    
                            <div class="form-group">
                                <label for="insurance_info">Insurance Information</label>
                                <textarea name="insurance_info" id="insurance_info" class="form-control">{{ old('insurance_info', $vehicle->insurance_info) }}</textarea>
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
