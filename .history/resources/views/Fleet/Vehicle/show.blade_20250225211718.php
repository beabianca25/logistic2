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
                        <table class="table table-bordered">
                            <tr>
                                <th>Profile Picture</th>
                                <td>
                                    @if ($driver->profile_picture)
                                        <img src="{{ asset('storage/' . $driver->profile_picture) }}" width="100px" alt="Profile Picture">
                                    @else
                                        No image uploaded
                                    @endif
                                </td>
                            </tr>
                            <tr><th>Driver Name</th><td>{{ $driver->driver_name }}</td></tr>
                            <tr><th>Date of Birth</th><td>{{ $driver->date_of_birth }}</td></tr>
                            <tr><th>Gender</th><td>{{ $driver->gender }}</td></tr>
                            <tr><th>National ID Number</th><td>{{ $driver->national_id_number }}</td></tr>
                            <tr><th>License Number</th><td>{{ $driver->license_number }}</td></tr>
                            <tr><th>License Category</th><td>{{ $driver->license_category }}</td></tr>
                            <tr><th>License Expiry Date</th><td>{{ $driver->license_expiry_date }}</td></tr>
                            <tr><th>Contact Number</th><td>{{ $driver->contact_number }}</td></tr>
                            <tr><th>Email</th><td>{{ $driver->email }}</td></tr>
                            <tr><th>Address</th><td>{{ $driver->address }}</td></tr>
                            <tr><th>Employment Status</th><td>{{ $driver->employment_status }}</td></tr>
                            <tr><th>Hire Date</th><td>{{ $driver->hire_date }}</td></tr>
                            <tr><th>Termination Date</th><td>{{ $driver->termination_date }}</td></tr>
                            <tr><th>Driving Experience (Years)</th><td>{{ $driver->driving_experience_years }}</td></tr>
                            <tr><th>Assigned Routes</th><td>{{ $driver->assigned_routes }}</td></tr>
                            <tr><th>Certifications</th><td>{{ $driver->certifications }}</td></tr>
                            <tr><th>Background Check Status</th><td>{{ $driver->background_check_status ? 'Passed' : 'Not Passed' }}</td></tr>
                            <tr><th>Accident History</th><td>{{ $driver->accident_history }}</td></tr>
                            <tr><th>Training Completed</th><td>{{ $driver->training_completed }}</td></tr>
                            <tr><th>Violation Records</th><td>{{ $driver->violation_records }}</td></tr>
                            <tr><th>Medical Fitness Certificate</th>
                                <td>
                                    @if ($driver->medical_fitness_certificate)
                                        <a href="{{ asset('storage/' . $driver->medical_fitness_certificate) }}" target="_blank">View Certificate</a>
                                    @else
                                        No certificate uploaded
                                    @endif
                                </td>
                            </tr>
                            <tr><th>Blood Type</th><td>{{ $driver->blood_type }}</td></tr>
                            <tr><th>Emergency Contact Name</th><td>{{ $driver->emergency_contact_name }}</td></tr>
                            <tr><th>Emergency Contact Number</th><td>{{ $driver->emergency_contact_number }}</td></tr>
                            <tr><th>Status</th><td>{{ $driver->status }}</td></tr>
                            <tr><th>Remarks</th><td>{{ $driver->remarks }}</td></tr>
                        </table>
                        @endforeach
                    </div>
                    

                    <!-- Maintenance Records Tab -->
                    <div class="tab-pane fade" id="maintenance-schedule" role="tabpanel" aria-labelledby="maintenance-schedule-tab">
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
