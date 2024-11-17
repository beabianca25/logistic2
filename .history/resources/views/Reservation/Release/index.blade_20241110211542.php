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
                                                <td>{{ $release->id }}</td>
                                                <td>{{ $release->customer_name }}</td>
                                                <td>{{ $release->vehicle->id }}</td> {{-- Assuming there's a name attribute in vehicle --}}
                                                <td>{{ $release->release_date }}</td>
                                                </td>

                                                <td>
                                                    <div class="d-flex justify-content-around align-items-center">
                                                        <a href="{{ route('reservation.show', $reservation->id) }}"
                                                            class="btn btn-info btn-sm mx-0">
                                                            <i class="fas fa-eye"></i>
                                                        </a>

                                                        <a href="{{ route('reservation.edit', $reservation->id) }}"
                                                            class="btn btn-warning btn-sm mx-0">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <form action="{{ route('reservation.destroy', $reservation->id) }}"
                                                            method="POST" id="deleteForm{{ $reservation->id }}"
                                                            class="mx-0">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                onclick="confirmDelete({{ $reservation->id }})">
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

                    <form action="{{ route('reservation.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="vehicle_id">Vehicle</label>
                            <select name="vehicle_id" id="vehicle_id" class="form-control" required>
                                @foreach ($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_type }} -
                                        {{ $vehicle->license_plate }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="driver_id">Driver</label>
                            <select name="driver_id" id="driver_id" class="form-control" required>
                                @foreach ($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->driver_name }} -
                                        {{ $driver->license_number }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="seats">Seats</label>
                            <input type="number" name="seats" id="seats" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="available">Available</option>
                                <option value="booked">Booked</option>
                                <option value="maintenance">Maintenance</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" name="location" id="location" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="availability_date">Availability Date</label>
                            <input type="datetime-local" name="availability_date" id="availability_date"
                                class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Create Reservation</button>
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
