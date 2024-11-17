@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/fleet') }}">Fleet Management</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/fleet') }}">Manage Details</a></li>
            <li class="breadcrumb-item active" aria-current="page">Maintenance List</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="row" style="font-size: 0.9rem; font-family: serif;">
                    <div class="col-md-12">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Maintenance List</h3>
                            <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#createAuctionModal" style="font-size: 0.9rem; font-family: serif;">
                                Create New Maintenance
                            </button>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0" style="font-size: 0.9rem; font-family: serif;">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Refill Date</th>
                                            <th>Fuel Amount</th>
                                            <th>Cost</th>
                                            <th>Fuel Station</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($fuels as $fuel)
                                        <tr>
                                            <td>{{ $fuel->vehicle->license_plate ?? 'N/A' }}</td>
                                            <td>{{ $fuel->refill_date->format('Y-m-d') }}</td>
                                            <td>{{ $fuel->fuel_amount }} L</td>
                                            <td>${{ $fuel->cost }}</td>
                                            <td>{{ $fuel->fuel_station }}</td>
                                            <td>{{ ucfirst($fuel->status) }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-around align-items-center">
                                                        <a href="{{ route('maintenance.show', $maintenance->id) }}"
                                                            class="btn btn-info btn-sm mx-0">
                                                            <i class="fas fa-eye"></i>
                                                        </a>

                                                        <a href="{{ route('maintenance.edit', $maintenance->id) }}"
                                                            class="btn btn-warning btn-sm mx-0">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <form action="{{ route('maintenance.destroy', $maintenance->id) }}"
                                                            method="POST" id="deleteForm{{ $maintenance->id }}"
                                                            class="mx-0">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                onclick="confirmDelete({{ $maintenance->id }})">
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
            <div class="modal-content" style="font-size: 0.9rem; font-family: serif;">
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

                    <form action="{{ route('maintenance.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="vehicle_id">Vehicle</label>
                            <select name="vehicle_id" class="form-control">
                                <option value="">Select a Vehicle</option>
                                @foreach ($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_type }} -
                                        {{ $vehicle->license_plate }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="maintenance_type">Maintenance Type</label>
                            <input type="text" name="maintenance_type" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="maintenance_date">Maintenance Date</label>
                            <input type="date" name="maintenance_date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="service_vendor">Service Vendor</label>
                            <input type="text" name="service_vendor" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="cost">Cost</label>
                            <input type="number" name="cost" class="form-control" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control">
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Save Maintenance</button>
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
