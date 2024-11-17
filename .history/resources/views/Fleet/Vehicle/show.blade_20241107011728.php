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
                        <a class="nav-link active" id="vehicle-info-tab" data-bs-toggle="tab" href="#vehicle-info"
                            role="tab" aria-controls="vehicle-info" aria-selected="true">Vehicle Info</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="driver-details-tab" data-bs-toggle="tab" href="#driver-details"
                            role="tab" aria-controls="driver-details" aria-selected="false">Driver Details</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="maintenance-schedule-tab" data-bs-toggle="tab" href="#maintenance-schedule"
                            role="tab" aria-controls="maintenance-schedule" aria-selected="false">Maintenance
                            Schedule</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="fuel-records-tab" data-bs-toggle="tab" href="#fuel-records" role="tab"
                            aria-controls="fuel-records" aria-selected="false">Fuel Records</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="trip-detail-tab" data-bs-toggle="tab" href="#trip-detail" role="tab"
                            aria-controls="trip-detail" aria-selected="false">Trip Detail</a>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content mt-3" id="vehicleTabContent">
                    <!-- Vehicle Info Tab -->
                    <div class="tab-pane fade show active" id="vehicle-info" role="tabpanel"
                        aria-labelledby="vehicle-info-tab">
                        <h3>Vehicle Information</h3>
                        <div class="vehicle-details">

                            <div class="vehicle-info">
                                <p><strong>Type:</strong> {{ $vehicle->vehicle_type }}</p>
                                <p><strong>Model:</strong> {{ $vehicle->model }}</p>
                                <p><strong>License Plate:</strong> {{ $vehicle->license_plate }}</p>
                                <p><strong>VIN:</strong> {{ $vehicle->vin }}</p>
                                <p><strong>Capacity:</strong> {{ $vehicle->capacity }}</p>
                                <p><strong>Current Status:</strong> {{ $vehicle->current_status }}</p>
                                <p><strong>Insurance Information:</strong> {{ $vehicle->insurance_info }}</p>
                            </div>

                            <div class="vehicle-image">
                                @if ($vehicle->image_path)
                                    <img src="{{ asset('storage/' . $vehicle->image_path) }}" alt="Vehicle Image"
                                        class="img-fluid">
                                @else
                                    <p>No image available.</p>
                                @endif
                            </div>

                        </div>
                    </div>

                    <!-- Driver Details Tab -->
                    <div class="tab-pane fade" id="driver-details" role="tabpanel" aria-labelledby="driver-details-tab">
                        <h3>Driver Information</h3>
                        @foreach ($vehicle->drivers as $driver)
                            <p><strong>Name:</strong> {{ $driver->driver_name }}</p>
                            <p><strong>License Number:</strong> {{ $driver->license_number }}</p>
                            <p><strong>Contact:</strong> {{ $driver->contact_number }}</p>
                            <hr>
                        @endforeach
                    </div>
                    

                    <!-- Maintenance Records Tab -->
                    <div class="tab-pane fade" id="maintenance-schedule" role="tabpanel"
                        aria-labelledby="maintenance-schedule-tab">
                        <h3>Maintenance Information</h3>
                        @foreach ($vehicle->maintenances as $maintenance)
                            <p>Type: {{ $maintenance->maintenance_type }}</p>
                            <p>Date: {{ $maintenance->maintenance_date }}</p>
                            <p>Service Vendor: {{ $maintenance->service_vendor }}</p>
                            <p>Cost: {{ $maintenance->cost }}</p>
                            <p>Status: {{ $maintenance->status }}</p>
                            <hr>
                        @endforeach
                    </div>

                    <!-- Fuel Records Tab -->
                    <div class="tab-pane fade" id="fuel-records" role="tabpanel" aria-labelledby="fuel-records-tab">
                        <h3>Fuel Information</h3>
                        @foreach ($vehicle->fuels as $fuel)
                            <p>Refill Date: {{ $fuel->refill_date }}</p>
                            <p>Amount: {{ $fuel->fuel_amount }}</p>
                            <p>Cost: {{ $fuel->cost }}</p>
                            <p>Station: {{ $fuel->fuel_station }}</p>
                            <p>Status: {{ $fuel->status }}</p>
                            <hr>
                        @endforeach
                    </div>


                    <!-- Trip Details Tab -->
                    <div class="tab-pane fade" id="trip-detail" role="tabpanel" aria-labelledby="trip-detail-tab">
                        <h3>Trip Details</h3>
                        @foreach ($vehicle->trips as $trip)
                            <p>Starting Location: {{ $trip->starting_location }}</p>
                            <p>Destination: {{ $trip->destination }}</p>
                            <p>Departure: {{ $trip->departure_time }}</p>
                            <p>Expected Arrival: {{ $trip->expected_arrival_time }}</p>
                            <p>Status: {{ $trip->status }}</p>
                            <hr>
                        @endforeach
                    </div>
                </div>

                <a href="{{ route('vehicle.index') }}" class="btn btn-secondary mt-3">Back</a>
            </div>
        </div>
    </div>
@endsection
