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
                            <p><strong>Model:</strong> {{ $vehicle->model }}</p>
                            <p><strong>Year:</strong> {{ $vehicle->year }}</p>
                            <p><strong>VIN:</strong> {{ $vehicle->vin }}</p>
                            <p><strong>Registration Number:</strong> {{ $vehicle->registration_number }}</p>
                            <p><strong>Current Status:</strong> {{ ucfirst($vehicle->current_status) }}</p>
                            @if($vehicle->image_path)
                                <p><strong>Image:</strong></p>
                                <img src="{{ asset('storage/' . $vehicle->image_path) }}" alt="Vehicle Image" class="img-fluid mb-3" width="200">
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
