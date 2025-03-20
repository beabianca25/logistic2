<!-- resources/views/Vendor/Booking/vendor_index.blade.php -->
@extends('base')

@section('content')
    <h2>Vendor Bookings</h2>
    <table>
        <tr>
            <th>Booking Type</th>
            <th>Pickup</th>
            <th>Dropoff</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
        @foreach($bookings as $booking)
        <tr>
            <td>{{ $booking->booking_type }}</td>
            <td>{{ $booking->pickup_location }}</td>
            <td>{{ $booking->dropoff_location }}</td>
            <td>{{ $booking->booking_date }}</td>
            <td>{{ $booking->status }}</td>
        </tr>
        @endforeach
    </table>
@endsection
