@extends('base')

@section('content')
<nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: serif;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/fleet') }}">Fleet Management</a></li>
        <li class="breadcrumb-item active" aria-current="page">Vehicle List</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="row" style="font-size: 0.9rem; font-family: serif;">
                <div class="col-md-12">
                    <div class="card-header border-transparent">
                        <h3 class="card-title">Vehicle List</h3>
                        <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#createAuctionModal" style="font-size: 0.9rem; font-family: serif;">
                            Create New Vehicle
                        </button>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0" style="font-size: 0.9rem; font-family: serif;">
                                <thead>
                                    <tr>
                                        <th>Vehicle</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vehicles as $vehicle)
                                    <tr>
                                        <td>
                                            <!-- Row to contain image and details side-by-side -->
                                            <div class="d-flex">
                                                <!-- Left side: Image -->
                                                <div class="col-md-4">
                                                    <div class="vehicle-image">
                                                        <img src="{{ Storage::url($vehicle->image_path) }}" alt="{{ $vehicle->model }} {{ $vehicle->year }}" class="img-fluid" style="max-width: 100%; height: auto;">
                                                    </div>
                                                </div>
                                                <!-- Right side: Details -->
                                                <div>
                                                    <p><strong>Model:</strong> {{ $vehicle->model }} {{ $vehicle->year }}</p>
                                                    <p><strong>Registration Number:</strong> {{ $vehicle->registration_number }}</p>
                                                    <p><strong>Status:</strong> {{ ucfirst($vehicle->current_status) }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <!-- Action buttons -->
                                            <div class="d-flex justify-content-around align-items-center">
                                                <a href="{{ route('vehicle.show', $vehicle->id) }}" class="btn btn-info btn-sm mx-0">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                <a href="{{ route('vehicle.edit', $vehicle->id) }}" class="btn btn-warning btn-sm mx-0">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('vehicle.destroy', $vehicle->id) }}" method="POST" id="deleteForm{{ $vehicle->id }}" class="mx-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $vehicle->id }})">
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
                        
                                <div class="form-group">
                                    <label for="model">Model</label>
                                    <input type="text" class="form-control" id="model" name="model" required>
                                </div>
                        
                                <div class="form-group">
                                    <label for="year">Year</label>
                                    <input type="number" class="form-control" id="year" name="year" min="1900" max="{{ date('Y') }}" required>
                                </div>
                        
                                <div class="form-group">
                                    <label for="vin">VIN (Vehicle Identification Number)</label>
                                    <input type="text" class="form-control" id="vin" name="vin" required>
                                </div>
                        
                                <div class="form-group">
                                    <label for="registration_number">Registration Number</label>
                                    <input type="text" class="form-control" id="registration_number" name="registration_number" required>
                                </div>
                        
                                <div class="form-group">
                                    <label for="current_status">Current Status</label>
                                    <select class="form-control" id="current_status" name="current_status">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                        <option value="maintenance">Maintenance</option>
                                        <option value="retired">Retired</option>
                                    </select>
                                </div>
                        
                                <div class="form-group">
                                    <label for="image_path">Upload Image</label>
                                    <input type="file" class="form-control" id="image_path" name="image_path" accept="image/*">
                                </div>
                        
                                <h3>Driver Details</h3>
                        
                                <div class="form-group">
                                    <label for="name">Driver Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                        
                                <div class="form-group">
                                    <label for="license_number">License Number</label>
                                    <input type="text" class="form-control" id="license_number" name="license_number" required>
                                </div>
                        
                                <div class="form-group">
                                    <label for="contact_number">Contact Number</label>
                                    <input type="text" class="form-control" id="contact_number" name="contact_number" required>
                                </div>
                        
                                <div class="form-group">
                                    <label for="license_expiry_date">License Expiry Date</label>
                                    <input type="date" class="form-control" id="license_expiry_date" name="license_expiry_date">
                                </div>
                        
                                <div class="form-group">
                                    <label for="status">Driver Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                        
                                <h3>Maintenance Details</h3>
                        
                                <div class="form-group">
                                    <label for="maintenance_schedule">Maintenance Schedule</label>
                                    <input type="text" class="form-control" id="maintenance_schedule" name="maintenance_schedule">
                                </div>
                        
                                <h3>Fuel Records</h3>
                        
                                <div class="form-group">
                                    <label for="fuel_refill_date">Fuel Refill Date</label>
                                    <input type="date" class="form-control" id="fuel_refill_date" name="fuel_refill_date">
                                </div>
                        
                                <button type="submit" class="btn btn-primary">Add Vehicle</button>
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
