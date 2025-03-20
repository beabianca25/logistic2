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
                            <a href="{{ route('vehicle.show', $vehicle->id) }}" class="badge bg-info text-white">
                                {{ $vehicle->model }}
                            </a>
                        @endforeach
                    @else
                        <span class="text-muted">No Vehicle Assigned</span>
                    @endif
                </td>
                <td>
                    @if($reservation->driver)
                        <a href="{{ route('driver.show', $reservation->driver->id) }}" class="badge bg-primary text-white">
                            {{ $reservation->driver->driver_name }}
                        </a>
                    @else
                        <span class="text-muted">No Driver Assigned</span>
                    @endif
                </td>
                
                <td>
                    <span class="badge bg-{{ $reservation->status === 'Pending' ? 'warning' : ($reservation->status === 'Approved' ? 'success' : ($reservation->status === 'Cancelled' ? 'danger' : 'secondary')) }}">
                        {{ $reservation->status }}
                    </span>
                </td>
                <td>{{ $reservation->location ?? 'N/A' }}</td>
                <td>{{ \Carbon\Carbon::parse($reservation->reservation_start_date)->format('Y-m-d') }}</td>
                <td>{{ \Carbon\Carbon::parse($reservation->reservation_end_date)->format('Y-m-d') }}</td>
                <div class="d-flex justify-content-around align-items-center">
                    <a href="{{ route('reservation.show', $reservation->id) }}" class="btn btn-info btn-sm mx-0">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-warning btn-sm mx-0">
                        <i class="fas fa-edit"></i>
                    </a>

                    <form action="{{ route('reservation.destroy', $reservation->id) }}" method="POST" id="deleteForm{{ $supply->id }}" class="mx-0">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $reservation->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
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
