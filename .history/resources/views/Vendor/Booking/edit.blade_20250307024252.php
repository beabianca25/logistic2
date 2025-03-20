@extends('base')

@section('content')
<div class="container">
    <h2>Edit Vendor Booking</h2>

    <form action="{{ route('booking.update', $vendorBooking->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="vendor_id" class="form-label">Vendor</label>
            <select name="vendor_id" id="vendor_id" class="form-control">
                @foreach($vendors as $vendor)
                    <option value="{{ $vendor->id }}" {{ $vendorBooking->vendor_id == $vendor->id ? 'selected' : '' }}>
                        {{ $vendor->business_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="booking_type" class="form-label">Booking Type</label>
            <input type="text" name="booking_type" id="booking_type" class="form-control" value="{{ $vendorBooking->booking_type }}" required>
        </div>

        <div class="mb-3">
            <label for="pickup_location" class="form-label">Pickup Location</label>
            <input type="text" name="pickup_location" id="pickup_location" class="form-control" value="{{ $vendorBooking->pickup_location }}" required>
        </div>

        <div class="mb-3">
            <label for="dropoff_location" class="form-label">Dropoff Location</label>
            <input type="text" name="dropoff_location" id="dropoff_location" class="form-control" value="{{ $vendorBooking->dropoff_location }}" required>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea name="notes" id="notes" class="form-control">{{ $vendorBooking->notes }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update Booking</button>
    </form>
</div>
@endsection
