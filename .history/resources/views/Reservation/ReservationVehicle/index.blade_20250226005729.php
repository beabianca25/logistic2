@extends('base')

@section('content')
<div class="container">
    <h2 class="mb-4">Vehicle Reservations</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Reservation ID</th>
                <th>Reserved Vehicles</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reservations as $reservation)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $reservation->id }}</td>
                    <td>
                        @if($reservation->vehicles->count() > 0)
                            <ul>
                                @foreach ($reservation->vehicles as $vehicle)
                                    <li>{{ $vehicle->name }} ({{ $vehicle->registration_number }})</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-muted">No vehicles assigned</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('reservation_vehicle.destroy', $reservation->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this reservation?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No reservations found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('reservation_vehicle.create') }}" class="btn btn-primary">Assign Vehicle to Reservation</a>
</div>
@endsection
