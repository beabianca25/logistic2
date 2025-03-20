@extends('base')

@section('content')
    <div class="container">
        <h1>Booking Details</h1>
        <a href="{{ route('booking.index') }}" class="btn btn-secondary mb-3">Back to Bookings</a>

        <div class="card">
            <div class="card-body">
              <h3> <p><strong>Service Type:</strong> {{ $booking->service_type }}</p></h3>
                <p><strong>Full Name:</strong> {{ $booking->name }}</p>
                <p><strong>Email:</strong> {{ $booking->email }}</p>
                <p><strong>Phone Number:</strong> {{ $booking->phone_number }}</p>
                <p><strong>Address:</strong> {{ $booking->address }}</p>
                <p><strong>Booking Date & Time:</strong> {{ \Carbon\Carbon::parse($booking->booking_date)->format('F d, Y h:i A') }}</p>
                <p><strong>Status:</strong> <span class="badge bg-warning">{{ $booking->status }}</span></p>
                <p><strong>Payment Status:</strong> <span class="badge bg-primary">{{ $booking->payment_status }}</span></p>

                <!-- Conditional Fields -->
                @if($booking->number_of_people)
                    <p><strong>Number of People:</strong> {{ $booking->number_of_people }}</p>
                @endif

                @if($booking->venue_name)
                    <p><strong>Venue:</strong> {{ $booking->venue_name }}</p>
                @endif

                @if($booking->pickup_location || $booking->dropoff_location)
                    <p><strong>Pickup Location:</strong> {{ $booking->pickup_location }}</p>
                    <p><strong>Dropoff Location:</strong> {{ $booking->dropoff_location }}</p>
                @endif

                @if($booking->destination)
                    <p><strong>Destination:</strong> {{ $booking->destination }}</p>
                @endif

                @if($booking->departure_date || $booking->return_date)
                    <p><strong>Departure Date:</strong> {{ $booking->departure_date }}</p>
                    <p><strong>Return Date:</strong> {{ $booking->return_date }}</p>
                @endif

                @if($booking->special_requests)
                    <p><strong>Special Requests:</strong> {{ $booking->special_requests }}</p>
                @endif

                <a href="{{ route('booking.edit', $booking->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection
