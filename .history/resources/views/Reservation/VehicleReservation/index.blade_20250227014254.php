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

    <!-- Success Alert -->
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success') }}",
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif

    <!-- Error Alert -->
    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: "{{ session('error') }}",
                timer: 3000,
                showConfirmButton: false
            });
        </script>
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
                            <span class="badge bg-info">{{ $vehicle->id }}</span>
                        @endforeach
                    @else
                        <span class="text-muted">No Vehicle Assigned</span>
                    @endif
                </td>
                <td>{{ optional($reservation->driver)->driver_name ?? 'No Driver Assigned' }}</td>
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
                    <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $reservation->id }}">Delete</button>
                    
                    <form id="delete-form-{{ $reservation->id }}" action="{{ route('reservation.destroy', $reservation->id) }}" method="POST" class="d-none">
                        @csrf
                        @method('DELETE')
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

<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Delete confirmation
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function () {
                let reservationId = this.getAttribute('data-id');
                
                Swal.fire({
                    title: "Are you sure?",
                    text: "This action cannot be undone!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + reservationId).submit();
                    }
                });
            });
        });
    });
</script>

@endsection
