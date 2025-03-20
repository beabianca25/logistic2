@extends('base')

@section('content')
<div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/reservation') }}">Reservations</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/reservation') }}">Vehicle Reservations</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Details</li>
        </ol>
    </nav>

    <h2>Edit Reservation</h2>

    <form action="{{ route('reservation.update', $reservation->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Customer Name</label>
            <input type="text" name="customer_name" class="form-control" value="{{ $reservation->customer_name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Customer Contact</label>
            <input type="text" name="customer_contact" class="form-control" value="{{ $reservation->customer_contact }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Select Vehicles</label>
            <select name="vehicle_ids[]" class="form-control" multiple required>
                @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}" @if($reservation->vehicles->contains($vehicle->id)) selected @endif>
                        {{ $vehicle->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Select Driver</label>
            <select name="driver_id" class="form-control" required>
                @foreach($drivers as $driver)
                    <option value="{{ $driver->id }}" @if($reservation->driver_id == $driver->id) selected @endif>
                        {{ $driver->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Reservation Start Date</label>
            <input type="date" name="reservation_start_date" class="form-control" value="{{ $reservation->reservation_start_date }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Reservation End Date</label>
            <input type="date" name="reservation_end_date" class="form-control" value="{{ $reservation->reservation_end_date }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="Pending" @if($reservation->status == 'Pending') selected @endif>Pending</option>
                <option value="Approved" @if($reservation->status == 'Approved') selected @endif>Approved</option>
                <option value="Completed" @if($reservation->status == 'Completed') selected @endif>Completed</option>
                <option value="Cancelled" @if($reservation->status == 'Cancelled') selected @endif>Cancelled</option>
            </select>
        </div>

        <button type="submit" class="btn btn-warning">Update Reservation</button>
    </form>
</div>
@endsection
