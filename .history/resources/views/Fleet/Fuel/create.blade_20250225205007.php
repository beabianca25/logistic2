@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: sans-serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/fleet') }}">Fleet Management</a></li>
            <li class="breadcrumb-item"><a href="{{ route('fuel.index') }}">Fuel List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add New Fuel</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Add New Fuel</div>
                <div class="card-body">
                    <form action="{{ route('fuel.store') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="vehicle_id">Vehicle</label>
                            <select name="vehicle_id" id="vehicle_id" class="form-control">
                                <option value="">Select Vehicle</option>
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_type }} - {{ $vehicle->license_plate }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="refill_date">Refill Date</label>
                            <input type="date" name="refill_date" id="refill_date" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="fuel_amount">Fuel Amount (liters/gallons)</label>
                            <input type="number" step="0.01" name="fuel_amount" id="fuel_amount" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="cost">Cost ($)</label>
                            <input type="number" step="0.01" name="cost" id="cost" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="fuel_station">Fuel Station</label>
                            <input type="text" name="fuel_station" id="fuel_station" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="fuel_station_location">Fuel Station Location</label>
                            <input type="text" name="fuel_station_location" id="fuel_station_location" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="fuel_type">Fuel Type</label>
                            <select name="fuel_type" id="fuel_type" class="form-control">
                                <option value="">Select Fuel Type</option>
                                <option value="Petrol">Petrol</option>
                                <option value="Diesel">Diesel</option>
                                <option value="Electric">Electric</option>
                                <option value="Hybrid">Hybrid</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="odometer_reading">Odometer Reading</label>
                            <input type="number" name="odometer_reading" id="odometer_reading" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="fuel_efficiency">Fuel Efficiency</label>
                            <input type="number" step="0.01" name="fuel_efficiency" id="fuel_efficiency" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="payment_method">Payment Method</label>
                            <select name="payment_method" id="payment_method" class="form-control">
                                <option value="">Select Payment Method</option>
                                <option value="Cash">Cash</option>
                                <option value="Credit Card">Credit Card</option>
                                <option value="Fuel Card">Fuel Card</option>
                                <option value="Company Account">Company Account</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="receipt_number">Receipt Number</label>
                            <input type="text" name="receipt_number" id="receipt_number" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="vendor_contact">Vendor Contact</label>
                            <input type="text" name="vendor_contact" id="vendor_contact" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="fuel_status">Fuel Status</label>
                            <select name="fuel_status" id="fuel_status" class="form-control">
                                <option value="Pending">Pending</option>
                                <option value="Approved">Approved</option>
                                <option value="Rejected">Rejected</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Fuel Record</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
