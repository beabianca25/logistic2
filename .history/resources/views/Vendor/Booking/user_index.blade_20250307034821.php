@extends('base')

@section('content')
    <h2>My Bookings</h2>
    <table>
        <tr>
            <th>Booking Type</th>
            <th>Pickup</th>
            <th>Dropoff</th>
            <th>Status</th>
        </tr>
        @foreach ($bookings as $booking)
        <tr>
            <td>{{ $booking->booking_type }}</td>
            <td>{{ $booking->pickup_location }}</td>
            <td>{{ $booking->dropoff_location }}</td>
            <td>{{ $booking->status }}</td>
        </tr>
        @endforeach
    </table>
@endsection
