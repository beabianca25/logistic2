@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/vehicle_reservation') }}">Fleet Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vehicle Reservation List</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="row" style="font-size: 0.9rem; font-family: serif;">
                    <div class="col-md-12">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Vehicle Reservation List</h3>
                            <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#createReservationModal" style="font-size: 0.9rem; font-family: serif;">
                                Create New Reservation
                            </button>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0" style="font-size: 0.9rem; font-family: serif;">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Customer Name</th>
                                            <th>Vehicle</th>
                                            <th>Release Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($releases as $release)
                                            <tr>
                                                <td>{{ '' . str_pad(strtoupper(dechex($release->id)), 4, '0', STR_PAD_LEFT) }}</td>
                                                <td>{{ $release->customer_name }}</td>
                                                <td>{{ $release->vehicle->id }}</td> {{-- Assuming there's a name attribute in vehicle --}}
                                                <td>{{ $release->release_date }}</td>
                                                </td>

                                                <td>
                                                    <div class="d-flex justify-content-around align-items-center">
                                                        <a href="{{ route('release.show', $release->id) }}"
                                                            class="btn btn-info btn-sm mx-0">
                                                            <i class="fas fa-eye"></i>
                                                        </a>

                                                        <a href="{{ route('release.edit', $release->id) }}"
                                                            class="btn btn-warning btn-sm mx-0">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <form action="{{ route('release.destroy', $release->id) }}"
                                                            method="POST" id="deleteForm{{ $release->id }}"
                                                            class="mx-0">
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
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Button to trigger modal -->
    <div class="text-end mb-3">

    </div>

    <!-- Modal for creating a new reservation -->
    <div class="modal fade" id="createReservationModal" tabindex="-1" aria-labelledby="createReservationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="font-size: 0.9rem; font-family: serif;">
                <div class="modal-header">
                    <h5 class="modal-title" id="createReservationModalLabel">Create New Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Uncomment the below code to show errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('release.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="vehicle_id" class="form-label">Vehicle</label>
                            <select class="form-control" id="vehicle_id" name="vehicle_id" required>
                                <option value="">Select a vehicle</option>
                                @foreach ($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_type }} ({{ $vehicle->license_plate }})</option>
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
                            <label for="reservation_date" class="form-label">Reservation Date</label>
                            <input type="datetime-local" class="form-control" id="reservation_date" name="reservation_date" required>
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
                            <label for="released_by" class="form-label">Released By</label>
                            <input type="text" class="form-control" id="released_by" name="released_by" required>
                        </div>
                        <div class="mb-3">
                            <label for="condition_report" class="form-label">Condition Report</label>
                            <textarea class="form-control" id="condition_report" name="condition_report"></textarea>
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
                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea class="form-control" id="notes" name="notes"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
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


    <script>
        function confirmDelete(vendorId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#d33', // Red color for delete confirmation
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form if confirmed
                    document.getElementById('deleteForm' + vendorId).submit();
                }
            });
        }
    </script>

@endsection
