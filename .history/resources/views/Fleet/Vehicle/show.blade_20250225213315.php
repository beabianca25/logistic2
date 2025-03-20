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
                        <div class="container">
                            <div class="row">
                                <!-- General Information Section -->
                                <div class="col-md-6">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h4>General Information</h4>
                                        </div>
                                        <div class="card-body row">
                                            <div class="col-md-6">
                                                <p><strong>Vehicle Type:</strong> {{ $vehicle->vehicle_type }}</p>
                                                <p><strong>Model:</strong> {{ $vehicle->model }}</p>
                                                <p><strong>Manufacturer:</strong> {{ $vehicle->manufacturer }}</p>
                                                <p><strong>Year of Manufacture:</strong> {{ $vehicle->year_of_manufacture }}</p>
                                                <p><strong>License Plate:</strong> {{ $vehicle->license_plate }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>VIN:</strong> {{ $vehicle->vin }}</p>
                                                <p><strong>Capacity:</strong> {{ $vehicle->capacity }}</p>
                                                <p><strong>Fuel Type:</strong> {{ $vehicle->fuel_type }}</p>
                                                <p><strong>Mileage:</strong> {{ $vehicle->mileage ?? 'N/A' }}</p>
                                                <p><strong>Color:</strong> {{ $vehicle->color ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        
                                <!-- Technical & Maintenance Details -->
                                <div class="col-md-6">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h4>Technical Details</h4>
                                        </div>
                                        <div class="card-body">
                                            <p><strong>Engine Number:</strong> {{ $vehicle->engine_number }}</p>
                                            <p><strong>Chassis Number:</strong> {{ $vehicle->chassis_number }}</p>
                                            <p><strong>GPS Tracking ID:</strong> {{ $vehicle->gps_tracking_id ?? 'N/A' }}</p>
                                            <p><strong>Last Maintenance Date:</strong> {{ $vehicle->last_maintenance_date ?? 'N/A' }}</p>
                                            <p><strong>Next Maintenance Due:</strong> {{ $vehicle->next_maintenance_due ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                        
                                <!-- Financial Details -->
                                <div class="col-md-6">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h4>Financial Details</h4>
                                        </div>
                                        <div class="card-body">
                                            <p><strong>Purchase Date:</strong> {{ $vehicle->purchase_date ?? 'N/A' }}</p>
                                            <p><strong>Purchase Price:</strong> ${{ number_format($vehicle->purchase_price, 2) ?? 'N/A' }}</p>
                                            <p><strong>Depreciation Value:</strong> ${{ number_format($vehicle->depreciation_value, 2) ?? 'N/A' }}</p>
                                            <p><strong>Registration Expiry Date:</strong> {{ $vehicle->registration_expiry_date ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                        
                                <!-- Ownership & Status Details -->
                                <div class="col-md-6">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h4>Ownership & Status</h4>
                                        </div>
                                        <div class="card-body">
                                            <p><strong>Owner Name:</strong> {{ $vehicle->owner_name ?? 'N/A' }}</p>
                                            <p><strong>Leasing Details:</strong> {{ $vehicle->leasing_details ?? 'N/A' }}</p>
                                            <p><strong>Current Status:</strong> {{ $vehicle->current_status }}</p>
                                            <p><strong>Insurance Info:</strong> {{ $vehicle->insurance_info ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                        
                                <!-- Additional Details -->
                                <div class="col-md-6">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h4>Additional Information</h4>
                                        </div>
                                        <div class="card-body">
                                            <p><strong>Remarks:</strong> {{ $vehicle->remarks ?? 'N/A' }}</p>
                                            <p><strong>Image:</strong></p>
                                            @if ($vehicle->image_path)
                                                <img src="{{ asset('storage/' . $vehicle->image_path) }}" alt="Vehicle Image" class="img-fluid" width="200">
                                            @else
                                                <p>No Image Available</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>

                    <!-- Driver Details Tab -->
                    <div class="tab-pane fade" id="driver-details" role="tabpanel" aria-labelledby="driver-details-tab">
                        <div class="container">
                            <div class="row">
                                @foreach ($vehicle->drivers as $driver)
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-header">
                                                <h4>Driver Information</h4>
                                            </div>
                                            <div class="card-body row">
                                                <div class="col-md-6 text-center">
                                                    @if ($driver->profile_picture)
                                                        <img src="{{ asset('storage/' . $driver->profile_picture) }}" width="100px" alt="Profile Picture" class="img-fluid rounded">
                                                    @else
                                                        <p>No image uploaded</p>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <p><strong>Name:</strong> {{ $driver->driver_name }}</p>
                                                    <p><strong>Date of Birth:</strong> {{ $driver->date_of_birth }}</p>
                                                    <p><strong>Gender:</strong> {{ $driver->gender }}</p>
                                                    <p><strong>National ID:</strong> {{ $driver->national_id_number }}</p>
                                                    <p><strong>License Number:</strong> {{ $driver->license_number }}</p>
                                                    <p><strong>License Category:</strong> {{ $driver->license_category }}</p>
                                                    <p><strong>License Expiry:</strong> {{ $driver->license_expiry_date }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-header">
                                                <h4>Contact & Employment</h4>
                                            </div>
                                            <div class="card-body">
                                                <p><strong>Contact Number:</strong> {{ $driver->contact_number }}</p>
                                                <p><strong>Email:</strong> {{ $driver->email }}</p>
                                                <p><strong>Address:</strong> {{ $driver->address }}</p>
                                                <p><strong>Employment Status:</strong> {{ $driver->employment_status }}</p>
                                                <p><strong>Hire Date:</strong> {{ $driver->hire_date }}</p>
                                                <p><strong>Termination Date:</strong> {{ $driver->termination_date ?? 'N/A' }}</p>
                                                <p><strong>Driving Experience:</strong> {{ $driver->driving_experience_years }} years</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-header">
                                                <h4>Additional Details</h4>
                                            </div>
                                            <div class="card-body">
                                                <p><strong>Assigned Routes:</strong> {{ $driver->assigned_routes }}</p>
                                                <p><strong>Certifications:</strong> {{ $driver->certifications }}</p>
                                                <p><strong>Background Check:</strong> {{ $driver->background_check_status ? 'Passed' : 'Not Passed' }}</p>
                                                <p><strong>Accident History:</strong> {{ $driver->accident_history }}</p>
                                                <p><strong>Training Completed:</strong> {{ $driver->training_completed }}</p>
                                                <p><strong>Violation Records:</strong> {{ $driver->violation_records }}</p>
                                                <p><strong>Medical Certificate:</strong> 
                                                    @if ($driver->medical_fitness_certificate)
                                                        <a href="{{ asset('storage/' . $driver->medical_fitness_certificate) }}" target="_blank">View Certificate</a>
                                                    @else
                                                        No certificate uploaded
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-header">
                                                <h4>Emergency & Status</h4>
                                            </div>
                                            <div class="card-body">
                                                <p><strong>Blood Type:</strong> {{ $driver->blood_type }}</p>
                                                <p><strong>Emergency Contact:</strong> {{ $driver->emergency_contact_name }}</p>
                                                <p><strong>Emergency Contact Number:</strong> {{ $driver->emergency_contact_number }}</p>
                                                <p><strong>Status:</strong> {{ $driver->status }}</p>
                                                <p><strong>Remarks:</strong> {{ $driver->remarks }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                    </div>


                    <!-- Maintenance Records Tab -->
                    <div class="tab-pane fade" id="maintenance-schedule" role="tabpanel"
                        aria-labelledby="maintenance-schedule-tab">
                        <h3>Maintenance Information</h3>
                        @foreach ($vehicle->maintenances as $maintenance)
                            <table class="table table-bordered">
                                <tr>
                                    <th>Vehicle</th>
                                    <td>{{ $maintenance->vehicle->license_plate ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Maintenance Type</th>
                                    <td>{{ $maintenance->maintenance_type }}</td>
                                </tr>
                                <tr>
                                    <th>Maintenance Date</th>
                                    <td>{{ $maintenance->maintenance_date }}</td>
                                </tr>
                                <tr>
                                    <th>Service Vendor</th>
                                    <td>{{ $maintenance->service_vendor }}</td>
                                </tr>
                                <tr>
                                    <th>Service Vendor Contact</th>
                                    <td>{{ $maintenance->service_vendor_contact }}</td>
                                </tr>
                                <tr>
                                    <th>Labor Cost</th>
                                    <td>${{ number_format($maintenance->labor_cost, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Parts Cost</th>
                                    <td>${{ number_format($maintenance->parts_cost, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Total Cost</th>
                                    <td>${{ number_format($maintenance->total_cost, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Parts Replaced</th>
                                    <td>{{ $maintenance->parts_replaced }}</td>
                                </tr>
                                <tr>
                                    <th>Odometer Reading</th>
                                    <td>{{ $maintenance->odometer_reading }} km</td>
                                </tr>
                                <tr>
                                    <th>Issue Reported</th>
                                    <td>{{ $maintenance->issue_reported }}</td>
                                </tr>
                                <tr>
                                    <th>Issue Fixed</th>
                                    <td>{{ $maintenance->issue_fixed }}</td>
                                </tr>
                                <tr>
                                    <th>Technician Name</th>
                                    <td>{{ $maintenance->technician_name }}</td>
                                </tr>
                                <tr>
                                    <th>Maintenance Status</th>
                                    <td>{{ $maintenance->maintenance_status }}</td>
                                </tr>
                                <tr>
                                    <th>Approved By</th>
                                    <td>{{ $maintenance->approver->name ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        @endforeach
                    </div>


                    <!-- Fuel Records Tab -->
                    <div class="tab-pane fade" id="fuel-records" role="tabpanel" aria-labelledby="fuel-records-tab">
                        <h3>Fuel Information</h3>
                        @foreach ($vehicle->fuels as $fuel)
                            <table class="table table-bordered">
                                <tr>
                                    <th>Vehicle</th>
                                    <td>{{ $fuel->vehicle->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Refill Date</th>
                                    <td>{{ $fuel->refill_date }}</td>
                                </tr>
                                <tr>
                                    <th>Fuel Amount (Liters)</th>
                                    <td>{{ $fuel->fuel_amount }}</td>
                                </tr>
                                <tr>
                                    <th>Cost Per Liter</th>
                                    <td>{{ $fuel->cost }}</td>
                                </tr>
                                <tr>
                                    <th>Total Cost</th>
                                    <td>{{ $fuel->total_cost ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Fuel Station</th>
                                    <td>{{ $fuel->fuel_station }}</td>
                                </tr>
                                <tr>
                                    <th>Station Location</th>
                                    <td>{{ $fuel->fuel_station_location ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Fuel Type</th>
                                    <td>{{ $fuel->fuel_type }}</td>
                                </tr>
                                <tr>
                                    <th>Odometer Reading</th>
                                    <td>{{ $fuel->odometer_reading ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Fuel Efficiency</th>
                                    <td>{{ $fuel->fuel_efficiency ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Method</th>
                                    <td>{{ $fuel->payment_method }}</td>
                                </tr>
                                <tr>
                                    <th>Receipt Number</th>
                                    <td>{{ $fuel->receipt_number ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Vendor Contact</th>
                                    <td>{{ $fuel->vendor_contact ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Fuel Status</th>
                                    <td>{{ $fuel->fuel_status }}</td>
                                </tr>
                                <tr>
                                    <th>Approved By</th>
                                    <td>{{ $fuel->approvedBy->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $fuel->created_at }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{ $fuel->updated_at }}</td>
                                </tr>
                            </table>
                        @endforeach
                    </div>



                    <!-- Trip Details Tab -->
                    <div class="tab-pane fade" id="trip-detail" role="tabpanel" aria-labelledby="trip-detail-tab">
                        <h3>Trip Details</h3>
                        @foreach ($vehicle->trips as $trip)
                            <table class="table">
                                <tr>
                                    <th>Trip ID</th>
                                    <td>{{ str_pad(strtoupper(dechex($trip->id)), 4, '0', STR_PAD_LEFT) }}</td>
                                </tr>
                                <tr>
                                    <th>Vehicle</th>
                                    <td>{{ optional($trip->vehicle)->license_plate ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Driver</th>
                                    <td>{{ optional($trip->driver)->name ?? 'Unassigned' }}</td>
                                </tr>
                                <tr>
                                    <th>Starting Location</th>
                                    <td>{{ $trip->starting_location }}</td>
                                </tr>
                                <tr>
                                    <th>Destination</th>
                                    <td>{{ $trip->destination }}</td>
                                </tr>
                                <tr>
                                    <th>Trip Type</th>
                                    <td>{{ $trip->trip_type }}</td>
                                </tr>
                                <tr>
                                    <th>Departure Time</th>
                                    <td>{{ \Carbon\Carbon::parse($trip->departure_time)->format('Y-m-d H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Expected Arrival</th>
                                    <td>{{ \Carbon\Carbon::parse($trip->expected_arrival_time)->format('Y-m-d H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ ucfirst($trip->status) }}</td>
                                </tr>
                                <tr>
                                    <th>Route Details</th>
                                    <td>{{ $trip->route_details ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Distance (KM)</th>
                                    <td>{{ $trip->distance_km ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Fuel Cost</th>
                                    <td>${{ number_format($trip->fuel_cost, 2) ?? '0.00' }}</td>
                                </tr>
                                <tr>
                                    <th>Trip Expenses</th>
                                    <td>${{ number_format($trip->trip_expenses, 2) ?? '0.00' }}</td>
                                </tr>
                            </table>
                        @endforeach
                    </div>

                </div>

                <a href="{{ route('vehicle.index') }}" class="btn btn-secondary mt-3">Back</a>
            </div>
        </div>
    </div>
@endsection
