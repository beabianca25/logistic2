@extends('base')

@section('content')
<div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('reservation.index') }}">Vehicle Reservations</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Details</li>
        </ol>
    </nav>

    <h2>Edit Reservation</h2>

    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: "{{ session('error') }}",
            timer: 3000,
            showConfirmButton: false
        });
    </script>
    @endif

    <form action="{{ route('reservation.update', $reservation->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Customer Name -->
        <div class="mb-3">
            <label class="form-label">Customer Name</label>
            <input type="text" name="customer_name" class="form-control" value="{{ $reservation->customer_name }}" required>
        </div>

        <!-- Customer Contact -->
        <div class="mb-3">
            <label class="form-label">Customer Contact</label>
            <input type="text" name="customer_contact" class="form-control" value="{{ $reservation->customer_contact }}" required>
        </div>

        <!-- Location -->
        <div class="mb-3">
            <label class="form-label">Location</label>
            <input type="text" name="location" class="form-control" value="{{ $reservation->location }}">
        </div>

        <!-- Reservation Notes -->
        <div class="mb-3">
            <label class="form-label">Reservation Notes</label>
            <textarea name="reservation_notes" class="form-control">{{ $reservation->reservation_notes }}</textarea>
        </div>

        <!-- Vehicle Selection -->
        <div class="mb-3">
            <label class="form-label">Select Vehicles</label>
            <div class="border p-2" style="max-height: 200px; overflow-y: auto;">
                @foreach ($vehicles as $vehicle)
                    <div class="form-check">
                        <input type="checkbox" name="vehicle_ids[]" class="form-check-input vehicleCheckbox"
                            value="{{ $vehicle->id }}" id="vehicle-{{ $vehicle->id }}"
                            @if(in_array($vehicle->id, $reservation->vehicles->pluck('id')->toArray())) checked @endif>
                        <label class="form-check-label" for="vehicle-{{ $vehicle->id }}">
                            {{ $vehicle->model }} ({{ $vehicle->vehicle_type }})
                        </label>
                    </div>
                @endforeach
            </div>
            @error('vehicle_ids')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Select Driver -->
        <div class="mb-3">
            <label class="form-label">Select Driver</label>
            <select name="driver_id" class="form-control" required>
                @foreach($drivers as $driver)
                    <option value="{{ $driver->id }}" @if($reservation->driver_id == $driver->id) selected @endif>
                        {{ $driver->driver_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Reservation Start Date -->
        <div class="mb-3">
            <label class="form-label">Reservation Start Date</label>
            <input type="date" name="reservation_start_date" class="form-control" value="{{ $reservation->reservation_start_date }}" required>
        </div>

        <!-- Reservation End Date -->
        <div class="mb-3">
            <label class="form-label">Reservation End Date</label>
            <input type="date" name="reservation_end_date" class="form-control" value="{{ $reservation->reservation_end_date }}" required>
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="Pending" @if($reservation->status == 'Pending') selected @endif>Pending</option>
                <option value="Approved" @if($reservation->status == 'Approved') selected @endif>Approved</option>
                <option value="Completed" @if($reservation->status == 'Completed') selected @endif>Completed</option>
                <option value="Cancelled" @if($reservation->status == 'Cancelled') selected @endif>Cancelled</option>
            </select>
        </div>

        <!-- Total Price -->
        <div class="mb-3">
            <label class="form-label">Total Price</label>
            <input type="number" name="total_price" class="form-control" value="{{ $reservation->total_price }}" min="0" step="0.01">
        </div>

        <!-- User ID (Optional) -->
        <div class="mb-3">
            <label class="form-label">User</label>
            <select name="user_id" class="form-control">
                <option value="">Select User (Optional)</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" @if($reservation->user_id == $user->id) selected @endif>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-warning">Update Reservation</button>
    </form>
</div>
@endsection
