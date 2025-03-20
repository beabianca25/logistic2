@extends('base')

@section('content')
<div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vehicle Reservations</li>
        </ol>
    </nav>

    <h2>Vehicle Reservations</h2>
    <a href="{{ route('reservation.create') }}" class="btn btn-primary mb-3">Create New Reservation</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Reference Code</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Vehicles</th>
                <th>Driver</th>
                <th>Status</th>
                <th>Location</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
            <tr>
                <td>{{ $reservation->reference_code }}</td>
                <td>{{ $reservation->customer_name }}</td>
                <td>{{ $reservation->customer_contact }}</td>
                <td>
                    @foreach($reservation->vehicles as $vehicle)
                        <span class="badge bg-info">{{ $vehicle->name }}</span>
                    @endforeach
                </td>
                <td>{{ $reservation->driver->name }}</td>
                <td>{{ $reservation->status }}</td>
                <td>{{ $reservation->location }}</td>
                <td>{{ $reservation->reservation_start_date }}</td>
                <td>{{ $reservation->reservation_end_date }}</td>
                <td>
                    <a href="{{ route('reservation.show', $reservation->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('reservation.destroy', $reservation->id) }}" method="POST" style="display:inline-block;">
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
