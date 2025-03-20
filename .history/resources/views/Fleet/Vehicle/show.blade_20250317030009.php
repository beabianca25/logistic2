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

        @foreach ($vehicles as $vehicle)
        <div class="card">
            <div class="card-footer text-right">
                <h3 class="card-title">Vehicle List</h3>
                <a href="{{ route('vehicle.location', $vehicle->id) }}" class="btn btn-info-btn-sm">Set Location</a>
                <a href="{{ route('vehicle.locationhistory', $vehicle->id) }}" class="btn btn-primary btn-sm">Location History</a>
            </div>
        </div>
    @endforeach
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
                        <div class="container">
                            <div class="row">
                                @foreach ($vehicle->maintenances as $maintenance)
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-header">
                                                <h4>Maintenance Record</h4>
                                            </div>
                                            <div class="card-body">
                                                <p><strong>Vehicle:</strong> {{ $maintenance->vehicle->license_plate ?? 'N/A' }}</p>
                                                <p><strong>Maintenance Type:</strong> {{ $maintenance->maintenance_type }}</p>
                                                <p><strong>Maintenance Date:</strong> {{ $maintenance->maintenance_date }}</p>
                                                <p><strong>Service Vendor:</strong> {{ $maintenance->service_vendor }}</p>
                                                <p><strong>Service Vendor Contact:</strong> {{ $maintenance->service_vendor_contact }}</p>
                                                <p><strong>Labor Cost:</strong> ${{ number_format($maintenance->labor_cost, 2) }}</p>
                                                <p><strong>Parts Cost:</strong> ${{ number_format($maintenance->parts_cost, 2) }}</p>
                                                <p><strong>Total Cost:</strong> ${{ number_format($maintenance->total_cost, 2) }}</p>
                                                <p><strong>Parts Replaced:</strong> {{ $maintenance->parts_replaced }}</p>
                                                <p><strong>Odometer Reading:</strong> {{ $maintenance->odometer_reading }} km</p>
                                                <p><strong>Issue Reported:</strong> {{ $maintenance->issue_reported }}</p>
                                                <p><strong>Issue Fixed:</strong> {{ $maintenance->issue_fixed }}</p>
                                                <p><strong>Technician Name:</strong> {{ $maintenance->technician_name }}</p>
                                                <p><strong>Maintenance Status:</strong> {{ $maintenance->maintenance_status }}</p>
                                                <p><strong>Approved By:</strong> {{ $maintenance->approver->name ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                    </div>


                    <!-- Fuel Records Tab -->
                    <div class="tab-pane fade" id="fuel-records" role="tabpanel" aria-labelledby="fuel-records-tab">
                        <div class="container">
                            <div class="row">
                                @foreach ($vehicle->fuels as $fuel)
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-header">
                                                <h4>Fuel Refill Information</h4>
                                            </div>
                                            <div class="card-body">
                                                <p><strong>Vehicle:</strong> {{ $fuel->vehicle->name ?? 'N/A' }}</p>
                                                <p><strong>Refill Date:</strong> {{ $fuel->refill_date }}</p>
                                                <p><strong>Fuel Type:</strong> {{ $fuel->fuel_type }}</p>
                                                <p><strong>Fuel Amount:</strong> {{ $fuel->fuel_amount }} Liters</p>
                                                <p><strong>Cost Per Liter:</strong> ${{ number_format($fuel->cost, 2) }}</p>
                                                <p><strong>Total Cost:</strong> ${{ number_format($fuel->total_cost, 2) ?? 'N/A' }}</p>
                                                <p><strong>Odometer Reading:</strong> {{ $fuel->odometer_reading ?? 'N/A' }} km</p>
                                            </div>
                                        </div>
                                    </div>
                        
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-header">
                                                <h4>Transaction & Approval</h4>
                                            </div>
                                            <div class="card-body">
                                                <p><strong>Payment Method:</strong> {{ $fuel->payment_method }}</p>
                                                <p><strong>Receipt Number:</strong> {{ $fuel->receipt_number ?? 'N/A' }}</p>
                                                <p><strong>Fuel Efficiency:</strong> {{ $fuel->fuel_efficiency ?? 'N/A' }}</p>
                                                <p><strong>Fuel Status:</strong> {{ $fuel->fuel_status }}</p>
                                                <p><strong>Approved By:</strong> {{ $fuel->approvedBy->name ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-header">
                                                <h4>Fuel Station Details</h4>
                                            </div>
                                            <div class="card-body">
                                                <p><strong>Fuel Station:</strong> {{ $fuel->fuel_station }}</p>
                                                <p><strong>Station Location:</strong> {{ $fuel->fuel_station_location ?? 'N/A' }}</p>
                                                <p><strong>Vendor Contact:</strong> {{ $fuel->vendor_contact ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </div>
                        
                                   
                        
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-header">
                                                <h4>Record Details</h4>
                                            </div>
                                            <div class="card-body">
                                                <p><strong>Created At:</strong> {{ $fuel->created_at }}</p>
                                                <p><strong>Updated At:</strong> {{ $fuel->updated_at }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div> 
                    </div>



                    <!-- Trip Details Tab -->
                    <div class="tab-pane fade" id="trip-detail" role="tabpanel" aria-labelledby="trip-detail-tab">
                        <div class="container">
                            <div class="row">
                                <!-- Trip Information -->
                                <div class="col-md-6">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h4>Trip Information</h4>
                                        </div>
                                        <div class="card-body">
                                            <p><strong>Trip ID:</strong> 0001</p>
                                            <p><strong>Vehicle:</strong> ABC546</p>
                                            <p><strong>Driver:</strong> Unassigned</p>
                                            <p><strong>Starting Location:</strong> Quezon City</p>
                                            <p><strong>Destination:</strong> Baguio</p>
                                            <p><strong>Trip Type:</strong> One-Way</p>
                                            <p><strong>Departure Time:</strong> 2025-02-22 14:58</p>
                                            <p><strong>Expected Arrival:</strong> 2025-03-05 18:55</p>
                                            <p><strong>Status:</strong> Ongoing</p>
                                        </div>
                                    </div>
                                </div>
                        
                                <!-- Route & Distance -->
                                <div class="col-md-6">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h4>Route & Distance</h4>
                                        </div>
                                        <div class="card-body">
                                            <p><strong>Route Details:</strong> FYU</p>
                                            <p><strong>Distance (KM):</strong> 1233.00</p>
                                        </div>
                                    </div>
                        
                                    <!-- Financial Details (Aligned Below Route & Distance) -->
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h4>Financial Details</h4>
                                        </div>
                                        <div class="card-body">
                                            <p><strong>Fuel Cost:</strong> $1,000.00</p>
                                            <p><strong>Trip Expenses:</strong> $200.00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <a href="{{ route('vehicle.index') }}" class="btn btn-secondary mt-3">Back</a>
            </div>
        </div>
    </div>
@endsection
