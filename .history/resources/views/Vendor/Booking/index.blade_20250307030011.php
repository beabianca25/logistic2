@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: sans-serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Vendor Portal</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vendor Bookings</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title d-inline">Vendor Bookings</h3>
                    <a href="{{ route('booking.create') }}" class="btn btn-primary float-end">Create New Booking</a>
                </div>
                
                @if(session('success'))
                    <div class="alert alert-success" style="font-size: 0.9rem; font-family: sans-serif;">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0" style="font-size: 0.9rem; font-family: sans-serif;">
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
                                    <td>{{ str_pad(strtoupper(dechex($booking->id)), 4, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $booking->vendor->business_name }}</td>
                                    <td>{{ ucfirst($booking->booking_type) }}</td>
                                    <td>{{ $booking->pickup_location }}</td>
                                    <td>{{ $booking->dropoff_location }}</td>
                                    <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('F j, Y') }}</td>
                                    <td>{{ ucfirst($booking->status) }}</td>
                                    <td>
                                        <div class="d-flex justify-content-around align-items-center">
                                            <a href="{{ route('booking.show', $booking->id) }}" class="btn btn-info btn-sm mx-0">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('booking.edit', $booking->id) }}" class="btn btn-warning btn-sm mx-0">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm delete-booking mx-0" data-id="{{ $booking->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <form id="delete-form-{{ $booking->id }}" action="{{ route('booking.destroy', $booking->id) }}" method="POST" style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

       
    </div>

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
