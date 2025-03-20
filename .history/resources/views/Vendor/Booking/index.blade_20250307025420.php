@extends('base')

@section('content')
<div class="container">
    <h2>Vendor Bookings</h2>
    <a href="{{ route('booking.create') }}" class="btn btn-primary mb-3">Create New Booking</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Vendor</th>
                <th>Booking Type</th>
                <th>Pickup Location</th>
                <th>Dropoff Location</th>
                <th>Booking Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ $booking->vendor->business_name }}</td>
                <td>{{ $booking->booking_type }}</td>
                <td>{{ $booking->pickup_location }}</td>
                <td>{{ $booking->dropoff_location }}</td>
                <td>{{ $booking->booking_date }}</td>
                <td>{{ $booking->status }}</td>
                <td>
                    <a href="{{ route('booking.show', $booking->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('booking.edit', $booking->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <button class="btn btn-danger btn-sm delete-booking" data-id="{{ $booking->id }}">Delete</button>
                    <form id="delete-form-{{ $booking->id }}" action="{{ route('booking.destroy', $booking->id) }}" method="POST" style="display:none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.delete-booking').forEach(button => {
            button.addEventListener('click', function() {
                let bookingId = this.getAttribute('data-id');
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
                        document.getElementById('delete-form-' + bookingId).submit();
                    }
                });
            });
        });
    });
</script>
@endsection
