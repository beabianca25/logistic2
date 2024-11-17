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
                        <h5>Auction Details
                            <a href="{{ route('auction.index') }}" class="btn btn-danger float-end" style="font-size: 0.8rem; font-family: serif;">Back</a>
                        </h5>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h3 class="card-title">Vehicle Information</h3>
                            <p><strong>Make:</strong> {{ $vehicle->make }}</p>
                            <p><strong>Model:</strong> {{ $vehicle->model }}</p>
                            <p><strong>Year:</strong> {{ $vehicle->year }}</p>
                            <p><strong>VIN:</strong> {{ $vehicle->vin }}</p>
                            <p><strong>Registration Number:</strong> {{ $vehicle->registration_number }}</p>
                            <p><strong>Capacity:</strong> {{ $vehicle->capacity }}</p>
                            <p><strong>Current Status:</strong> {{ ucfirst($vehicle->current_status) }}</p>
                            <p><strong>Insurance Information:</strong> {{ $vehicle->insurance_info }}</p>
                            @if($vehicle->image_path)
                                <p><strong>Image:</strong></p>
                                <img src="{{ asset('storage/' . $vehicle->image_path) }}" alt="Vehicle Image" class="img-fluid mb-3" width="200">
                            @endif
                
                            <h3>Driver Information</h3>
                            <p><strong>Name:</strong> {{ $vehicle->name }}</p>
                            <p><strong>License Number:</strong> {{ $vehicle->license_number }}</p>
                            <p><strong>Contact Number:</strong> {{ $vehicle->contact_number }}</p>
                            <p><strong>Email:</strong> {{ $vehicle->email }}</p>
                            <p><strong>Address:</strong> {{ $vehicle->address }}</p>
                            <p><strong>Certifications:</strong> {{ $vehicle->certifications }}</p>
                            <p><strong>License Expiry Date:</strong> {{ $vehicle->license_expiry_date }}</p>
                            <p><strong>Status:</strong> {{ ucfirst($vehicle->status) }}</p>
                
                            <h3>Trip Information</h3>
                            <p><strong>Starting Location:</strong> {{ $vehicle->trip_starting_location }}</p>
                            <p><strong>Destination:</strong> {{ $vehicle->trip_destination }}</p>
                            <p><strong>Departure Time:</strong> {{ $vehicle->trip_departure_time }}</p>
                            <p><strong>Expected Arrival Time:</strong> {{ $vehicle->trip_expected_arrival_time }}</p>
                            <p><strong>Status:</strong> {{ ucfirst($vehicle->trip_status) }}</p>
                
                            <h3>Maintenance Information</h3>
                            <p><strong>Type:</strong> {{ $vehicle->maintenance_type }}</p>
                            <p><strong>Date:</strong> {{ $vehicle->maintenance_date }}</p>
                            <p><strong>Service Vendor:</strong> {{ $vehicle->service_vendor }}</p>
                            <p><strong>Cost:</strong> ${{ number_format($vehicle->maintenance_cost, 2) }}</p>
                            <p><strong>Status:</strong> {{ ucfirst($vehicle->maintenance_status) }}</p>
                
                            <h3>Fuel Information</h3>
                            <p><strong>Refill Date:</strong> {{ $vehicle->fuel_refill_date }}</p>
                            <p><strong>Fuel Amount:</strong> {{ $vehicle->fuel_amount }} liters</p>
                            <p><strong>Fuel Cost:</strong> ${{ number_format($vehicle->fuel_cost, 2) }}</p>
                            <p><strong>Fuel Station:</strong> {{ $vehicle->fuel_station }}</p>
                
                            <h3>Expense Information</h3>
                            <p><strong>Type:</strong> {{ $vehicle->expense_type }}</p>
                            <p><strong>Date:</strong> {{ $vehicle->expense_date }}</p>
                            <p><strong>Amount:</strong> ${{ number_format($vehicle->expense_amount, 2) }}</p>
                            <p><strong>Description:</strong> {{ $vehicle->expense_description }}</p>
                
                            <a href="{{ route('vehicles.index') }}" class="btn btn-secondary mt-3">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
