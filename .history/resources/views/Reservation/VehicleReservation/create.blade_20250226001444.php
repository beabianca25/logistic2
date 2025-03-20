@extends('base')

@section('content')
<div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/reservation') }}">Reservations</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/reservation') }}">Vehicle Reservations</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Reservation</li>
        </ol>
    </nav>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <h2>Create Vehicle Reservation</h2>

    <form action="{{ route('reservation.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Customer Name</label>
            <input type="text" name="customer_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Customer Contact</label>
            <input type="text" name="customer_contact" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Select Vehicles</label>
            <select name="vehicle_ids[]" class="form-control" multiple required>
                @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}">{{ $vehicle->model }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Select Driver</label>
            <select name="driver_id" class="form-control" required>
                @foreach($drivers as $driver)
                    <option value="{{ $driver->id }}">{{ $driver->driver_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Reservation Start Date</label>
            <input type="date" name="reservation_start_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Reservation End Date</label>
            <input type="date" name="reservation_end_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="Pending">Pending</option>
                <option value="Approved">Approved</option>
                <option value="Completed">Completed</option>
                <option value="Cancelled">Cancelled</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Location</label>
            <input type="text" name="location" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Total Price</label>
            <input type="number" step="0.01" name="total_price" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Create Reservation</button>
    </form>
</div>
@endsection
