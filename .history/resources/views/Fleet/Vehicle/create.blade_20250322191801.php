@extends('base')

@section('content')
<div class="container mt-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/fleet') }}">Fleet Management</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/vehicle') }}">Vehicle List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Vehicle</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Create New Vehicle</h4>
                    <a href="{{ route('vehicle.index') }}" class="btn btn-danger">Back</a>
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

                    <form action="{{ route('vehicle.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h4 class="mb-3">Vehicle Information</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Vehicle Type</label>
                                    <input type="text" name="vehicle_type" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Model</label>
                                    <input type="text" name="model" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Manufacturer</label>
                                    <input type="text" name="manufacturer" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Year of Manufacture</label>
                                    <input type="number" name="year_of_manufacture" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>License Plate</label>
                                    <input type="text" name="license_plate" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>VIN (Vehicle Identification Number)</label>
                                    <input type="text" name="vin" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Capacity</label>
                                    <input type="number" name="capacity" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Fuel Type</label>
                                    <select name="fuel_type" class="form-control">
                                        <option value="Petrol">Petrol</option>
                                        <option value="Diesel">Diesel</option>
                                        <option value="Electric">Electric</option>
                                        <option value="Hybrid">Hybrid</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>Mileage</label>
                                    <input type="number" name="mileage" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Color</label>
                                    <input type="text" name="color" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label>Engine Number</label>
                                    <input type="text" name="engine_number" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Chassis Number</label>
                                    <input type="text" name="chassis_number" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>GPS Tracking ID</label>
                                    <input type="text" name="gps_tracking_id" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                
                                <div class="mb-3">
                                    <label>Last Maintenance Date</label>
                                    <input type="date" name="last_maintenance_date" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Next Maintenance Due</label>
                                    <input type="date" name="next_maintenance_due" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Purchase Date</label>
                                    <input type="date" name="purchase_date" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Purchase Price</label>
                                    <input type="number" name="purchase_price" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Depreciation Value</label>
                                    <input type="number" name="depreciation_value" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Registration Expiry Date</label>
                                    <input type="date" name="registration_expiry_date" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Owner Name</label>
                                    <input type="text" name="owner_name" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Leasing Details</label>
                                    <textarea name="leasing_details" class="form-control"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label>Current Status</label>
                                    <select name="current_status" class="form-control">
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                        <option value="Maintenance">Maintenance</option>
                                        <option value="Retired">Retired</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>Insurance Info</label>
                                    <input type="text" name="insurance_info" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Image</label>
                                    <input type="file" name="image_path" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Remarks</label>
                                    <textarea name="remarks" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 w-100">Save Vehicle</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
