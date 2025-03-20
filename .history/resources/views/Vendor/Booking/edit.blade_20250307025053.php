@extends('base')

@section('content')
<div class="container">
    <h2>Edit Vendor Booking</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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

        @php
        use Carbon\Carbon;
    @endphp
    
    <div class="mb-3">
        <label for="booking_date" class="form-label">Booking Date</label>
        <input type="date" name="booking_date" id="booking_date" class="form-control" 
            value="{{ old('booking_date', $vendorBooking->booking_date ? Carbon::parse($vendorBooking->booking_date)->format('Y-m-d') : '') }}" required>
    </div>
    
        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea name="notes" id="notes" class="form-control">{{ $vendorBooking->notes }}</textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control">
                @foreach(['Pending', 'Approved', 'Scheduled', 'Ongoing', 'Completed', 'Cancelled'] as $status)
                    <option value="{{ $status }}" {{ $vendorBooking->status == $status ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Booking</button>
        <a href="{{ route('booking.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
