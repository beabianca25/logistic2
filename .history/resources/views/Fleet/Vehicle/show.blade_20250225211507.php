@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: sans-serif;">
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

                            <table class="table table-bordered">
                                <tr>
                                    <th>Vehicle Type</th>
                                    <td>{{ $vehicle->vehicle_type }}</td>
                                </tr>
                                <tr>
                                    <th>Model</th>
                                    <td>{{ $vehicle->model }}</td>
                                </tr>
                                <tr>
                                    <th>Manufacturer</th>
                                    <td>{{ $vehicle->manufacturer }}</td>
                                </tr>
                                <tr>
                                    <th>Year of Manufacture</th>
                                    <td>{{ $vehicle->year_of_manufacture }}</td>
                                </tr>
                                <tr>
                                    <th>License Plate</th>
                                    <td>{{ $vehicle->license_plate }}</td>
                                </tr>
                                <tr>
                                    <th>VIN</th>
                                    <td>{{ $vehicle->vin }}</td>
                                </tr>
                                <tr>
                                    <th>Capacity</th>
                                    <td>{{ $vehicle->capacity }}</td>
                                </tr>
                                <tr>
                                    <th>Fuel Type</th>
                                    <td>{{ $vehicle->fuel_type }}</td>
                                </tr>
                                <tr>
                                    <th>Mileage</th>
                                    <td>{{ $vehicle->mileage ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Color</th>
                                    <td>{{ $vehicle->color ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Engine Number</th>
                                    <td>{{ $vehicle->engine_number }}</td>
                                </tr>
                                <tr>
                                    <th>Chassis Number</th>
                                    <td>{{ $vehicle->chassis_number }}</td>
                                </tr>
                                <tr>
                                    <th>GPS Tracking ID</th>
                                    <td>{{ $vehicle->gps_tracking_id ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Last Maintenance Date</th>
                                    <td>{{ $vehicle->last_maintenance_date ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Next Maintenance Due</th>
                                    <td>{{ $vehicle->next_maintenance_due ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Purchase Date</th>
                                    <td>{{ $vehicle->purchase_date ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Purchase Price</th>
                                    <td>${{ number_format($vehicle->purchase_price, 2) ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Depreciation Value</th>
                                    <td>${{ number_format($vehicle->depreciation_value, 2) ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Registration Expiry Date</th>
                                    <td>{{ $vehicle->registration_expiry_date ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Owner Name</th>
                                    <td>{{ $vehicle->owner_name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Leasing Details</th>
                                    <td>{{ $vehicle->leasing_details ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Current Status</th>
                                    <td>{{ $vehicle->current_status }}</td>
                                </tr>
                                <tr>
                                    <th>Insurance Info</th>
                                    <td>{{ $vehicle->insurance_info ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Remarks</th>
                                    <td>{{ $vehicle->remarks ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Image</th>
                                    <td>
                                        @if ($vehicle->image_path)
                                            <img src="{{ asset('storage/' . $vehicle->image_path) }}" alt="Vehicle Image" class="img-fluid" width="200">
                                        @else
                                            No Image Available
                                        @endif
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div>

                    <!-- Driver Details Tab -->
                    <div class="tab-pane fade" id="driver-details" role="tabpanel" aria-labelledby="driver-details-tab">
                        <h3>Driver Information</h3>
                        @foreach ($vehicle->drivers as $driver)
                            <p><strong>Name:</strong> {{ $driver->driver_name }}</p>
                            <p><strong>License Number:</strong> {{ $driver->license_number }}</p>
                            <p><strong>Contact:</strong> {{ $driver->contact_number }}</p>
                            <p><strong>Email:</strong> {{ $driver->email }}</p>
                            <p><strong>Address:</strong> {{ $driver->address }}</p>
                        @endforeach
                    </div>
                    

                    <!-- Maintenance Records Tab -->
                    <div class="tab-pane fade" id="maintenance-schedule" role="tabpanel" aria-labelledby="maintenance-schedule-tab">
                        <h3>Maintenance Information</h3>
                        @foreach ($vehicle->maintenances as $maintenance)
                            <p><strong>Type:</strong> {{ $maintenance->maintenance_type }}</p>
                            <p><strong>Date:</strong> {{ $maintenance->maintenance_date }}</p>
                            <p><strong>Service Vendor:</strong> {{ $maintenance->service_vendor }}</p>
                            <p><strong>Cost:</strong> {{ $maintenance->cost }}</p>
                            <p><strong>Status:</strong> {{ $maintenance->status }}</p>
                        @endforeach
                    </div>
                    

                    <!-- Fuel Records Tab -->
                    <div class="tab-pane fade" id="fuel-records" role="tabpanel" aria-labelledby="fuel-records-tab">
                        <h3>Fuel Information</h3>
                        @foreach ($vehicle->fuels as $fuel)
                            <p><strong>Refill Date:</strong> {{ $fuel->refill_date }}</p>
                            <p><strong>Amount:</strong> {{ $fuel->fuel_amount }}</p>
                            <p><strong>Cost:</strong> {{ $fuel->cost }}</p>
                            <p><strong>Station:</strong> {{ $fuel->fuel_station }}</p>
                            <p><strong>Status:</strong> {{ $fuel->status }}</p>
                            <hr>
                        @endforeach
                    </div>
                    


                    <!-- Trip Details Tab -->
                    <div class="tab-pane fade" id="trip-detail" role="tabpanel" aria-labelledby="trip-detail-tab">
                        <h3>Trip Details</h3>
                        @foreach ($vehicle->trips as $trip)
                            <p><strong>Starting Location:</strong> {{ $trip->starting_location }}</p>
                            <p><strong>Destination:</strong> {{ $trip->destination }}</p>
                            <p><strong>Departure:</strong> {{ $trip->departure_time }}</p>
                            <p><strong>Expected Arrival:</strong> {{ $trip->expected_arrival_time }}</p>
                            <p><strong>Status:</strong> {{ $trip->status }}</p>
                            <hr>
                        @endforeach
                    </div>
                    
                </div>

                <a href="{{ route('vehicle.index') }}" class="btn btn-secondary mt-3">Back</a>
            </div>
        </div>
    </div>
@endsection
