@extends('base')

@section('content')
<div class="container">
    <h2>Vendor Bookings</h2>
    <a href="{{ route('booking.create') }}" class="btn btn-primary mb-3">Create New Booking</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Vendor</th>
                <th>Booking Type</th>
                <th>Pickup Location</th>
                <th>Dropoff Location</th>
                <th>Booking Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ $booking->vendor->business_name }}</td>
                <td>{{ $booking->booking_type }}</td>
                <td>{{ $booking->pickup_location }}</td>
                <td>{{ $booking->dropoff_location }}</td>
                <td>{{ $booking->booking_date }}</td>
                <td>{{ $booking->status }}</td>
                <td>
                    <a href="{{ route('booking.show', $booking->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('booking.edit', $booking->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
