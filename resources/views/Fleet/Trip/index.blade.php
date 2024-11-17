@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: sans-serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/fleet') }}">Fleet Management</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/fleet') }}">Manage Details</a></li>
            <li class="breadcrumb-item active" aria-current="page">Trip List</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="row" style="font-size: 0.9rem; font-family: sans-serif;">
                    <div class="col-md-12">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Trip List</h3>
                            <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#createAuctionModal" style="font-size: 0.9rem; font-family: sans-serif;">
                                <i class="fas fa-plus"></i> Create New Trip
                            </button>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0" style="font-size: 0.9rem; font-family: sans-serif;">
                                    <thead>
                                        <tr>
                                            <th>Trip ID</th>
                                            <th>Starting Location</th>
                                            <th>Destination</th>
                                            <th>Departure Time</th>
                                            <th>Expected Arrival Time</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($trips as $trip)
                                            <tr>
                                                <td>{{ str_pad(strtoupper(dechex($trip->id)), 4, '0', STR_PAD_LEFT) }}</td>
                                                <td>{{ $trip->starting_location }}</td>
                                                <td>{{ $trip->destination }}</td>
                                                <td>{{ \Carbon\Carbon::parse($trip->departure_time)->format('Y-m-d H:i') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($trip->expected_arrival_time)->format('Y-m-d H:i') }}
                                                </td>

                                                <td>{{ ucfirst($trip->status) }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-around align-items-center">
                                                        <a href="{{ route('trip.show', $trip->id) }}"
                                                            class="btn btn-info btn-sm mx-0">
                                                            <i class="fas fa-eye"></i>
                                                        </a>

                                                        <a href="{{ route('trip.edit', $trip->id) }}"
                                                            class="btn btn-warning btn-sm mx-0">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <form action="{{ route('trip.destroy', $trip->id) }}" method="POST"
                                                            id="deleteForm{{ $trip->id }}" class="mx-0">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                onclick="confirmDelete({{ $trip->id }})">
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

    <!-- Modal for creating a new auction -->
    <div class="modal fade" id="createAuctionModal" tabindex="-1" aria-labelledby="createAuctionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="font-size: 0.9rem; font-family: sans-serif;">
                <div class="modal-header">
                    <h5 class="modal-title" id="createAuctionModalLabel">Create New Trip</h5>
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

                    <form action="{{ route('trip.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="vehicle_id">Vehicle</label>
                            <select name="vehicle_id" class="form-control">
                                <option value="">Select a Vehicle</option>
                                @foreach ($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_type }} -
                                        {{ $vehicle->license_plate }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="starting_location">Starting Location</label>
                            <input type="text" name="starting_location" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="destination">Destination</label>
                            <input type="text" name="destination" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="departure_time">Departure Time</label>
                            <input type="datetime-local" name="departure_time" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="expected_arrival_time">Expected Arrival Time</label>
                            <input type="datetime-local" name="expected_arrival_time" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="Scheduled">Scheduled</option>
                                <option value="Ongoing">Ongoing</option>
                                <option value="Completed">Completed</option>
                                <option value="Delayed">Delayed</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success mt-3">Save Trip</button>
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
