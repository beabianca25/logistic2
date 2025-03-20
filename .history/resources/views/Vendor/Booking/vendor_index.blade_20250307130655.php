@extends('base')

@section('content')
    <h1>Vendor Bookings</h1>
    <ul>
        @foreach ($bookings as $booking)
            <li>{{ $booking->booking_type }} - {{ $booking->pickup_location }} to {{ $booking->dropoff_location }}</li>
        @endforeach
    </ul>
@endsection
