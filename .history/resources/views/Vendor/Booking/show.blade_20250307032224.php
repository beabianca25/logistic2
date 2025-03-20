@extends('base')

@section('content')
<div class="container">
    <h2>Vendor Booking Details</h2>
    <a href="{{ route('booking.index') }}" class="btn btn-secondary mb-3">Back to List</a>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td>{{ $vendorBooking->id }}</td>
        </tr>
        <tr>
            <th>Vendor</th>
            <td>{{ $vendorBooking->vendor->business_name }}</td>
        </tr>
        <tr>
            <th>Booking Type</th>
            <td>{{ $vendorBooking->booking_type }}</td>
        </tr>
        <tr>
            <th>Pickup Location</th>
            <td>{{ $vendorBooking->pickup_location }}</td>
        </tr>
        <tr>
            <th>Dropoff Location</th>
            <td>{{ $vendorBooking->dropoff_location }}</td>
        </tr>
        <tr>
            <th>Notes</th>
            <td>{{ $vendorBooking->notes }}</td>
        </tr>
        <tr>
            <th>Booking Date</th>
            <td>{{ $vendorBooking->booking_date }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $vendorBooking->status }}</td>
        </tr>
    </table>

    <a href="{{ route('booking.edit', $vendorBooking->id) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('booking.destroy', $vendorBooking->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</button>
    </form>
</div>
@endsection
