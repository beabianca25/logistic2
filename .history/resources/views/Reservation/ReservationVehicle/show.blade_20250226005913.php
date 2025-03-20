@extends('base')

@section('content')
<div class="container">
    <h2>Reservation Details</h2>
    
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Reservation ID: {{ $reservation->id }}</h4>
            <h5>Assigned Vehicles:</h5>
            @if($reservation->vehicles->count() > 0)
                <ul>
                    @foreach ($reservation->vehicles as $vehicle)
                        <li>{{ $vehicle->name }} ({{ $vehicle->registration_number }})</li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">No vehicles assigned.</p>
            @endif
        </div>
    </div>

    <a href="{{ route('reservationvehicle.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
