@extends('base')

@section('content')
<div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('reservation.index') }}">Vehicle Reservations</a></li>
            <li class="breadcrumb-item active" aria-current="page">Reservation Details</li>
        </ol>
    </nav>

    <h2>Reservation Details</h2>

    <p><strong>Reference Code:</strong> {{ $reservation->reference_code }}</p>
    <p><strong>Customer Name:</strong> {{ $reservation->customer_name }}</p>
    <p><strong>Customer Contact:</strong> {{ $reservation->customer_contact }}</p>
    <p><strong>Vehicles:</strong>
        @foreach($reservation->vehicles as $vehicle)
            <span class="badge bg-info">{{ $vehicle->name }}</span>
        @endforeach
    </p>
    <p><strong>Driver:</strong> {{ $reservation->driver->name }}</p>
    <p><strong>Status:</strong> {{ $reservation->status }}</p>
    <p><strong>Location:</strong> {{ $reservation->location }}</p>
    <p><strong>Start Date:</strong> {{ $reservation->reservation_start_date }}</p>
    <p><strong>End Date:</strong> {{ $reservation->reservation_end_date }}</p>
    <p><strong>Total Price:</strong> ${{ $reservation->total_price }}</p>
    <p><strong>Notes:</strong> {{ $reservation->reservation_notes }}</p>

    <a href="{{ route('reservation.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
