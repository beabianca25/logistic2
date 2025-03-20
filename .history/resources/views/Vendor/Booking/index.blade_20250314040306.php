@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: sans-serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/bookings') }}">Fleet Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">Booking List</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="row" style="font-size: 0.9rem; font-family: sans-serif;">
                    <div class="col-md-12">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Booking List</h3>
                            <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#createBookingModal" style="font-size: 0.9rem; font-family: sans-serif;">
                                <i class="fas fa-plus"></i> Create New Booking
                            </button>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0" style="font-size: 0.9rem; font-family: sans-serif;">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
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
                                                <td>{{ str_pad(strtoupper(dechex($booking->id)), 4, '0', STR_PAD_LEFT) }}</td>
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
                                                        @endif">
                                                        {{ $booking->status }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge 
                                                        @if($booking->payment_status == 'Pending') bg-warning
                                                        @elseif($booking->payment_status == 'Paid') bg-success
                                                        @elseif($booking->payment_status == 'Cancelled') bg-danger
                                                        @endif">
                                                        {{ $booking->payment_status }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-around align-items-center">
                                                        <a href="{{ route('booking.show', $booking->id) }}" class="btn btn-info btn-sm mx-0">
                                                            <i class="fas fa-eye"></i>
                                                        </a>

                                                        <a href="{{ route('booking.edit', $booking->id) }}" class="btn btn-warning btn-sm mx-0">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="confirmDelete({{ $booking->id }})">
                                                            <i class="fas fa-trash"></i>
                                                        </button>

                                                        <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" id="deleteForm{{ $booking->id }}">
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

                        @if(session('success'))
                            <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: '{{ session('success') }}',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            </script>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Creating Booking -->
    <div class="modal fade" id="createBookingModal" tabindex="-1" aria-labelledby="createBookingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="font-size: 0.9rem; font-family: sans-serif;">
                <div class="modal-header">
                    <h5 class="modal-title" id="createBookingModalLabel">Create New Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('booking.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="service_type" class="form-label">Service Type</label>
                            <input type="text" name="service_type" class="form-control @error('service_type') is-invalid @enderror" value="{{ old('service_type') }}">
                            @error('service_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Approved" {{ old('status') == 'Approved' ? 'selected' : '' }}>Approved</option>
                                <option value="Scheduled" {{ old('status') == 'Scheduled' ? 'selected' : '' }}>Scheduled</option>
                                <option value="Ongoing" {{ old('status') == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                                <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                                <option value="Cancelled" {{ old('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <button type="submit" class="btn btn-success">Create Booking</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Include SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
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
                    document.getElementById('deleteForm' + id).submit();
                }
            });
        }
    </script>
@endsection
