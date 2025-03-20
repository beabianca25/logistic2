@extends('base')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Vendor Portal</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/auction') }}">Auction</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Auction</li>
    </ol>
</nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create New Auction
                            <a href="{{ route('vehicle.index') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
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
                    
                            {{-- Vehicle Information --}}
                            <h4>Vehicle Information</h4>
                            <div class="form-group">
                                <label>Make</label>
                                <input type="text" name="make" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Model</label>
                                <input type="text" name="model" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Year</label>
                                <input type="number" name="year" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>VIN</label>
                                <input type="text" name="vin" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Registration Number</label>
                                <input type="text" name="registration_number" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Capacity</label>
                                <input type="number" name="capacity" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                    
                            {{-- Driver Information --}}
                            <h4>Driver Information</h4>
                            <div class="form-group">
                                <label>Driver Name</label>
                                <input type="text" name="driver_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>License Number</label>
                                <input type="text" name="license_number" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input type="text" name="driver_contact_number" class="form-control">
                            </div>
                    
                            {{-- Trip Information --}}
                            <h4>Trip Information</h4>
                            <div class="form-group">
                                <label>Starting Location</label>
                                <input type="text" name="trip_starting_location" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Destination</label>
                                <input type="text" name="trip_destination" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Departure Time</label>
                                <input type="datetime-local" name="trip_departure_time" class="form-control">
                            </div>
                    
                            {{-- Maintenance Information --}}
                            <h4>Maintenance Information</h4>
                            <div class="form-group">
                                <label>Maintenance Type</label>
                                <input type="text" name="maintenance_type" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Maintenance Date</label>
                                <input type="date" name="maintenance_date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Service Vendor</label>
                                <input type="text" name="service_vendor" class="form-control">
                            </div>
                    
                            {{-- Fuel Information --}}
                            <h4>Fuel Information</h4>
                            <div class="form-group">
                                <label>Refill Date</label>
                                <input type="date" name="fuel_refill_date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Fuel Amount</label>
                                <input type="number" name="fuel_amount" class="form-control">
                            </div>
                    
                            {{-- Expense Information --}}
                            <h4>Expense Information</h4>
                            <div class="form-group">
                                <label>Expense Type</label>
                                <input type="text" name="expense_type" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Expense Date</label>
                                <input type="date" name="expense_date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="number" name="expense_amount" class="form-control">
                            </div>
                    
                            <button type="submit" class="btn btn-primary mt-3">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
