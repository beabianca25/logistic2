@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/fleet') }}">Fleet Management</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/vehicle') }}">Vehicle List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vehicle Details</li>
        </ol>
    </nav>

    <div class="container">
        <h1>Vehicle Details</h1>

        <div class="card mb-3">
            <div class="card-body">
                <!-- Tab Navigation -->
                <ul class="nav nav-tabs" id="vehicleTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="vehicle-info-tab" data-bs-toggle="tab" href="#vehicle-info" role="tab" aria-controls="vehicle-info" aria-selected="true">Vehicle Info</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="driver-details-tab" data-bs-toggle="tab" href="#driver-details" role="tab" aria-controls="driver-details" aria-selected="false">Driver Details</a>
                    </li>
                    
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="maintenance-schedule-tab" data-bs-toggle="tab" href="#maintenance-schedule" role="tab" aria-controls="maintenance-schedule" aria-selected="false">Maintenance Schedule</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="fuel-records-tab" data-bs-toggle="tab" href="#fuel-records" role="tab" aria-controls="fuel-records" aria-selected="false">Fuel Records</a>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content mt-3" id="vehicleTabContent">
                    <!-- Vehicle Info Tab -->
                    <div class="tab-pane fade show active" id="vehicle-info" role="tabpanel" aria-labelledby="vehicle-info-tab">
                        <h3>Vehicle Information</h3>
                            <p><strong>Model:</strong> {{ $vehicle->model }}</p>
                            <p><strong>Year:</strong> {{ $vehicle->year }}</p>
                            <p><strong>VIN:</strong> {{ $vehicle->vin }}</p>
                            <p><strong>Registration Number:</strong> {{ $vehicle->registration_number }}</p>
                            <p><strong>Current Status:</strong> {{ ucfirst($vehicle->current_status) }}</p>
                            @if ($vehicle->image_path)
                                <p><strong>Image:</strong></p>
                                <img src="{{ asset('storage/' . $vehicle->image_path) }}" alt="Vehicle Image"
                                    class="img-fluid mb-3" width="200">
                            @endif
                    </div>

                    <!-- Driver Details Tab -->
                    <div class="tab-pane fade" id="driver-details" role="tabpanel" aria-labelledby="driver-details-tab">
                        <h3>Driver Information</h3>
                            <p><strong>Name:</strong> {{ $vehicle->name }}</p>
                            <p><strong>License Number:</strong> {{ $vehicle->license_number }}</p>
                            <p><strong>Contact Number:</strong> {{ $vehicle->contact_number }}</p>
                            <p><strong>License Expiry Date:</strong> {{ $vehicle->license_expiry_date }}</p>
                            <p><strong>Status:</strong> {{ ucfirst($vehicle->status) }}</p>

                    </div>

                    <!-- Maintenance Records Tab -->
                    <div class="tab-pane fade" id="maintenance-records" role="tabpanel" aria-labelledby="maintenance-records-tab">
                        <h3>Maintenance Information</h3>
                            <p><strong>Schedule:</strong> {{ $vehicle->maintenance_schedule }}</p>
                    </div>

                    <!-- Fuel Records Tab -->
                    <div class="tab-pane fade" id="fuel-records" role="tabpanel" aria-labelledby="fuel-records-tab">
                        <h3>Fuel Information</h3>
                        <p><strong>Refill Date:</strong> {{ $vehicle->fuel_refill_date }}</p>
                    </div>
                </div>

                <a href="{{ route('vehicle.index') }}" class="btn btn-secondary mt-3">Back</a>
            </div>
        </div>
    </div>
@endsection
