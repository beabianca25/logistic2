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

    @if($reservations->isEmpty())
        <div class="alert alert-warning">No reservations found.</div>
    @else
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
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
                    @if(isset($reservation->vehicles) && count($reservation->vehicles) > 0)
                        @foreach($reservation->vehicles as $vehicle)
                            <span class="badge bg-info">{{ $vehicle->name }}</span>
                        @endforeach
                    @else
                        <span class="text-muted">No Vehicle Assigned</span>
                    @endif
                </td>
                <td>{{ optional($reservation->driver)->name ?? 'No Driver Assigned' }}</td>
                <td>
                    <span class="badge bg-{{ $reservation->status === 'Pending' ? 'warning' : ($reservation->status === 'Approved' ? 'success' : ($reservation->status === 'Cancelled' ? 'danger' : 'secondary')) }}">
                        {{ $reservation->status }}
                    </span>
                </td>
                <td>{{ $reservation->location ?? 'N/A' }}</td>
                <td>{{ \Carbon\Carbon::parse($reservation->reservation_start_date)->format('Y-m-d') }}</td>
                <td>{{ \Carbon\Carbon::parse($reservation->reservation_end_date)->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('reservation.show', $reservation->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('reservation.destroy', $reservation->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this reservation?');">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    {{-- <div class="d-flex justify-content-center">
        {{ $reservations->links() }}
    </div> --}}
    @endif
</div>
@endsection
