@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: sans-serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/vehicle_reservation') }}">Fleet Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vehicle Reservation List</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-transparent d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Vehicle Release List</h3>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#createReservationModal">
                        New Release
                    </button>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped" style="font-size: 0.9rem;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer Name</th>
                                    <th>Vehicle Reservation</th>
                                    <th>Release Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($releases as $release)
                                    <tr>
                                        <td>{{ str_pad(strtoupper(dechex($release->id)), 4, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $release->reservation->customer_name }}</td>
                                        <td>{{ str_pad(strtoupper(dechex($release->reservation->reference_code)), 4, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $release->release_date }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('vehicle_releases.show', $release->id) }}"
                                                    class="btn btn-info btn-sm mx-1">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                <a href="{{ route('vehicle_releases.edit', $release->id) }}"
                                                    class="btn btn-warning btn-sm mx-1">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('vehicle_releases.destroy', $release->id) }}"
                                                    method="POST" id="deleteForm{{ $release->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete({{ $release->id }})">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @if (session('success'))
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: '{{ session('success') }}',
                                showConfirmButton: true,
                            });
                        });
                    </script>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal for creating a new reservation -->
    <div class="modal fade" id="createReservationModal" tabindex="-1" aria-labelledby="createReservationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createReservationModalLabel">
                        <i class="fas fa-plus"></i> Create New Reservation
                    </h5>
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

                    <form action="{{ route('vehicle_releases.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="vehicle_reservation_id" class="form-label">Vehicle Reservation</label>
                            <select class="form-control" id="vehicle_reservation_id" name="vehicle_reservation_id" required>
                                <option value="">Select a reservation</option>
                                @foreach ($reservations as $reservation)
                                    <option value="{{ $reservation->id }}">
                                        {{ str_pad(strtoupper(dechex($reservation->id)), 4, '0', STR_PAD_LEFT) }} - {{ $reservation->vehicle->vehicle_type }} ({{ $reservation->vehicle->license_plate }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Customer Name</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                        </div>

                        <div class="mb-3">
                            <label for="customer_contact" class="form-label">Customer Contact</label>
                            <input type="text" class="form-control" id="customer_contact" name="customer_contact" required>
                        </div>

                        <div class="mb-3">
                            <label for="release_date" class="form-label">Release Date</label>
                            <input type="datetime-local" class="form-control" id="release_date" name="release_date" required>
                        </div>

                        <div class="mb-3">
                            <label for="drop_off_date" class="form-label">Drop-off Date</label>
                            <input type="datetime-local" class="form-control" id="drop_off_date" name="drop_off_date">
                        </div>

                        <div class="mb-3">
                            <label for="total_cost" class="form-label">Total Cost</label>
                            <input type="number" class="form-control" id="total_cost" name="total_cost" required step="0.01">
                        </div>

                        <div class="mb-3">
                            <label for="payment_status" class="form-label">Payment Status</label>
                            <select class="form-control" id="payment_status" name="payment_status">
                                <option value="0">Pending</option>
                                <option value="1">Paid</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(releaseId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm' + releaseId).submit();
                }
            });
        }
    </script>
@endsection
