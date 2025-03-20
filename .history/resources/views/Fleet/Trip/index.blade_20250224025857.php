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
                            <a href="{{ route('trip.create') }}" class="btn btn-sm btn-primary float-end" style="font-size: 0.9rem; font-family: sans-serif;">
                                <i class="fas fa-plus"></i> Create New Trip
                            </a>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0" style="font-size: 0.9rem; font-family: sans-serif;">
                                    <thead>
                                        <tr>
                                            <th>Trip ID</th>
                                            <th>Vehicle</th>
                                            <th>Driver</th>
                                            <th>Starting Location</th>
                                            <th>Destination</th>
                                            <th>Trip Type</th>
                                            <th>Departure Time</th>
                                            <th>Expected Arrival</th>
                                            <th>Status</th>
                                            <th>Distance (km)</th>
                                            <th>Fuel Cost</th>
                                            <th>Expenses</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($trips as $trip)
                                            <tr>
                                                <td>{{ str_pad(strtoupper(dechex($trip->id)), 4, '0', STR_PAD_LEFT) }}</td>
                                                <td>{{ optional($trip->vehicle)->license_plate ?? 'N/A' }}</td>
                                                <td>{{ optional($trip->driver)->driver_name ?? 'Unassigned' }}</td>
                                                <td>{{ $trip->starting_location }}</td>
                                                <td>{{ $trip->destination }}</td>
                                                <td>{{ $trip->trip_type }}</td>
                                                <td>{{ \Carbon\Carbon::parse($trip->departure_time)->format('Y-m-d H:i') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($trip->expected_arrival_time)->format('Y-m-d H:i') }}</td>
                                                <td>{{ ucfirst($trip->status) }}</td>
                                                <td>{{ $trip->distance_km ?? 'N/A' }}</td>
                                                <td>${{ number_format($trip->fuel_cost, 2) ?? '0.00' }}</td>
                                                <td>${{ number_format($trip->trip_expenses, 2) ?? '0.00' }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-around align-items-center">
                                                        <a href="{{ route('trip.show', $trip->id) }}" class="btn btn-info btn-sm mx-0">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('trip.edit', $trip->id) }}" class="btn btn-warning btn-sm mx-0">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('trip.destroy', $trip->id) }}" method="POST" id="deleteForm{{ $trip->id }}" class="mx-0">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $trip->id }})">
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
        </div>
    </div>

    <script>
        function confirmDelete(tripId) {
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
                    document.getElementById('deleteForm' + tripId).submit();
                }
            });
        }
    </script>

@endsection
