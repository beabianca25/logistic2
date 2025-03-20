@extends('base')

@section('content')
<div class="container">
    <h2>Create Vendor Booking</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('booking.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="vendor_id" class="form-label">Vendor</label>
            <select name="vendor_id" id="vendor_id" class="form-control">
                @foreach($vendors as $vendor)
                    <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="booking_type" class="form-label">Booking Type</label>
            <input type="text" name="booking_type" id="booking_type" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="pickup_location" class="form-label">Pickup Location</label>
            <input type="text" name="pickup_location" id="pickup_location" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="dropoff_location" class="form-label">Dropoff Location</label>
            <input type="text" name="dropoff_location" id="dropoff_location" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea name="notes" id="notes" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="booking_date" class="form-label">Booking Date</label>
            <input type="datetime-local" name="booking_date" id="booking_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Create Booking</button>
    </form>
</div>
@endsection
