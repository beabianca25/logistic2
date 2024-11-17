@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Vendor Portal</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/auction') }}">Auction</a></li>
            <li class="breadcrumb-item active" aria-current="page">Auction Details</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header" style="font-size: 0.9rem; font-family: serif;">
                        <h5>Vehicle Details
                            <a href="{{ route('auction.index') }}" class="btn btn-danger float-end"
                                style="font-size: 0.8rem; font-family: serif;">Back</a>
                        </h5>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
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

                            <h3>Driver Information</h3>
                            <p><strong>Name:</strong> {{ $vehicle->name }}</p>
                            <p><strong>License Number:</strong> {{ $vehicle->license_number }}</p>
                            <p><strong>Contact Number:</strong> {{ $vehicle->contact_number }}</p>
                            <p><strong>License Expiry Date:</strong> {{ $vehicle->license_expiry_date }}</p>
                            <p><strong>Status:</strong> {{ ucfirst($vehicle->status) }}</p>

                            <h3>Maintenance Information</h3>
                            <p><strong>Schedule:</strong> {{ $vehicle->maintenance_schedule }}</p>

                            <h3>Fuel Information</h3>
                            <p><strong>Refill Date:</strong> {{ $vehicle->fuel_refill_date }}</p>


                            <a href="{{ route('vehicle.index') }}" class="btn btn-secondary mt-3">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Vendor Portal</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/auction') }}">Auction</a></li>
            <li class="breadcrumb-item active" aria-current="page">Auction Details</li>
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

                    <!-- Trips Tab -->
                    <div class="tab-pane fade" id="trips" role="tabpanel" aria-labelledby="trips-tab">
                        <h3>Trip Information</h3>
                        <p><strong>Starting Location:</strong> {{ $vehicle->trip_starting_location }}</p>
                        <p><strong>Destination:</strong> {{ $vehicle->trip_destination }}</p>
                        <p><strong>Departure Time:</strong> {{ $vehicle->trip_departure_time }}</p>
                        <p><strong>Expected Arrival Time:</strong> {{ $vehicle->trip_expected_arrival_time }}</p>
                        <p><strong>Status:</strong> {{ ucfirst($vehicle->trip_status) }}</p>
                    </div>

                    <!-- Maintenance Records Tab -->
                    <div class="tab-pane fade" id="maintenance-records" role="tabpanel" aria-labelledby="maintenance-records-tab">
                        <h3>Maintenance Information</h3>
                        <p><strong>Type:</strong> {{ $vehicle->maintenance_type }}</p>
                        <p><strong>Date:</strong> {{ $vehicle->maintenance_date }}</p>
                        <p><strong>Service Vendor:</strong> {{ $vehicle->service_vendor }}</p>
                        <p><strong>Cost:</strong> ${{ number_format($vehicle->maintenance_cost, 2) }}</p>
                        <p><strong>Status:</strong> {{ ucfirst($vehicle->maintenance_status) }}</p>
                    </div>

                    <!-- Fuel Records Tab -->
                    <div class="tab-pane fade" id="fuel-records" role="tabpanel" aria-labelledby="fuel-records-tab">
                        <h3>Fuel Information</h3>
                        <p><strong>Refill Date:</strong> {{ $vehicle->fuel_refill_date }}</p>
                        <p><strong>Fuel Amount:</strong> {{ $vehicle->fuel_amount }} liters</p>
                        <p><strong>Fuel Cost:</strong> ${{ number_format($vehicle->fuel_cost, 2) }}</p>
                        <p><strong>Fuel Station:</strong> {{ $vehicle->fuel_station }}</p>
                    </div>

                    <!-- Expenses Tab -->
                    <div class="tab-pane fade" id="expenses" role="tabpanel" aria-labelledby="expenses-tab">
                        <h3>Expense Information</h3>
                        <p><strong>Type:</strong> {{ $vehicle->expense_type }}</p>
                        <p><strong>Date:</strong> {{ $vehicle->expense_date }}</p>
                        <p><strong>Amount:</strong> ${{ number_format($vehicle->expense_amount, 2) }}</p>
                        <p><strong>Description:</strong> {{ $vehicle->expense_description }}</p>
                    </div>
                </div>

                <a href="{{ route('vehicles.index') }}" class="btn btn-secondary mt-3">Back</a>
            </div>
        </div>
    </div>
@endsection
