@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/fleet') }}">Fleet Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vehicle List</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="row" style="font-size: 0.9rem; font-family: serif;">
                    <div class="col-md-12">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Vehicle List</h3>
                            <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#createAuctionModal" style="font-size: 0.9rem; font-family: serif;">
                                Create New Vehicle
                            </button>
                        </div>
                        @if (session('status'))
                            <div class="alert alert-success" style="font-size: 0.9rem; font-family: serif;">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0" style="font-size: 0.9rem; font-family: serif;">
                                    <thead>
                                        <tr>
                                            <th>Model</th>
                                            <th>Registration Number</th>
                                            <th>Capacity</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vehicles as $vehicle)
                                        <tr>
                                            <td>{{ $vehicle->make }} {{ $vehicle->model }} {{ $vehicle->model }}</td>
                                            <td>{{ $vehicle->registration_number }}</td>
                                            <td>{{ $vehicle->capacity }}</td>
                                            <td>{{ $vehicle->current_status }}</td>
                                            <td>
                                                <div class="d-flex justify-content-around align-items-center">
                                                    <a href="{{ route('vehicle.show', $vehicle->id) }}"
                                                        class="btn btn-info btn-sm mx-0">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    <a href="{{ route('vehicle.edit', $vehicle->id) }}"
                                                        class="btn btn-warning btn-sm mx-0">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <form action="{{ route('vehicle.destroy', $vehicle->id) }}"
                                                        method="POST" id="deleteForm{{ $vehicle->id }}"
                                                        class="mx-0">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="confirmDelete({{ $vehicle->id }})">
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

                <!-- Button to trigger modal -->
                <div class="text-end mb-3">
                    
                </div>
                
                <!-- Modal for creating a new auction -->
                <div class="modal fade" id="createAuctionModal" tabindex="-1" aria-labelledby="createAuctionModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content" style="font-size: 0.9rem; font-family: serif;">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createAuctionModalLabel">Create New Auction</h5>
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
                
                                <form action="{{ route('vehicle.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                            
                                    {{-- Vehicle Information --}}
                                    <h4>Vehicle Information</h4>
                                    <div class="form-group">
                                        <label>Make</label>
                                        <input type="text" name="make" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Model</label>
                                        <input type="text" name="model" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Year</label>
                                        <input type="number" name="year" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>VIN</label>
                                        <input type="text" name="vin" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Registration Number</label>
                                        <input type="text" name="registration_number" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Capacity</label>
                                        <input type="number" name="capacity" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                            
                                    {{-- Driver Information --}}
                                    <h4>Driver Information</h4>
                                    <div class="form-group">
                                        <label>Driver Name</label>
                                        <input type="text" name="driver_name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>License Number</label>
                                        <input type="text" name="license_number" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Contact Number</label>
                                        <input type="text" name="driver_contact_number" class="form-control">
                                    </div>
                            
                                    {{-- Trip Information --}}
                                    <h4>Trip Information</h4>
                                    <div class="form-group">
                                        <label>Starting Location</label>
                                        <input type="text" name="trip_starting_location" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Destination</label>
                                        <input type="text" name="trip_destination" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Departure Time</label>
                                        <input type="datetime-local" name="trip_departure_time" class="form-control">
                                    </div>
                            
                                    {{-- Maintenance Information --}}
                                    <h4>Maintenance Information</h4>
                                    <div class="form-group">
                                        <label>Maintenance Type</label>
                                        <input type="text" name="maintenance_type" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Maintenance Date</label>
                                        <input type="date" name="maintenance_date" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Service Vendor</label>
                                        <input type="text" name="service_vendor" class="form-control">
                                    </div>
                            
                                    {{-- Fuel Information --}}
                                    <h4>Fuel Information</h4>
                                    <div class="form-group">
                                        <label>Refill Date</label>
                                        <input type="date" name="fuel_refill_date" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Fuel Amount</label>
                                        <input type="number" name="fuel_amount" class="form-control">
                                    </div>
                            
                                    {{-- Expense Information --}}
                                    <h4>Expense Information</h4>
                                    <div class="form-group">
                                        <label>Expense Type</label>
                                        <input type="text" name="expense_type" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Expense Date</label>
                                        <input type="date" name="expense_date" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="number" name="expense_amount" class="form-control">
                                    </div>
                            
                                    <button type="submit" class="btn btn-primary mt-3">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session("success") }}',
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
