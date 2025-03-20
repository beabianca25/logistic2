@extends('base')

@section('content')
    <h1>Bookings</h1>
    <a href="{{ route('booking.create') }}" class="btn btn-primary">Create Booking</a>

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

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Service Type</th>
                <th>Status</th>
                <th>Payment Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->name }}</td>
                    <td>{{ $booking->service_type }}</td>
                    <td>
                        <span class="badge 
                            @if($booking->status == 'Pending') bg-warning
                            @elseif($booking->status == 'Approved') bg-info
                            @elseif($booking->status == 'Scheduled') bg-primary
                            @elseif($booking->status == 'Ongoing') bg-success
                            @elseif($booking->status == 'Completed') bg-dark
                            @elseif($booking->status == 'Cancelled') bg-danger
                            @else bg-secondary @endif">
                            {{ $booking->status }}
                        </span>
                    </td>
                    <td>
                        <span class="badge 
                            @if($booking->payment_status == 'Pending') bg-warning
                            @elseif($booking->payment_status == 'Paid') bg-success
                            @elseif($booking->payment_status == 'Cancelled') bg-danger
                            @else bg-secondary @endif">
                            {{ $booking->payment_status }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('booking.show', $booking->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('booking.edit', $booking->id) }}" class="btn btn-warning">Edit</a>
                        <button class="btn btn-danger delete-btn" data-id="{{ $booking->id }}">Delete</button>
                        <form id="delete-form-{{ $booking->id }}" action="{{ route('booking.destroy', $booking->id) }}" method="POST" style="display:none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Include SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const deleteButtons = document.querySelectorAll(".delete-btn");

            deleteButtons.forEach(button => {
                button.addEventListener("click", function () {
                    const bookingId = this.getAttribute("data-id");

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
                            document.getElementById(`delete-form-${bookingId}`).submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
