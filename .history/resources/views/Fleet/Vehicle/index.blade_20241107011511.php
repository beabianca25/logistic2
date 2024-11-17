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
                            <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#createAuctionModal" style="font-size: 0.9rem; font-family: serif;">
                                Create New Vehicle
                            </button>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0" style="font-size: 0.9rem; font-family: serif;">
                                    <tbody>
                                        @foreach ($vehicles as $vehicle)
                                            <tr>
                                                <td style="width: 25%;">
                                                    <!-- Display Vehicle Image on the Left -->
                                                    <div class="vehicle-image">
                                                        @if ($vehicle->image_path)
                                                            <img src="{{ asset('storage/' . $vehicle->image_path) }}"
                                                                alt="Vehicle Image" class="img-fluid">
                                                        @else
                                                            <p>No image available.</p>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td style="font-size: 1.1rem;">
                                                    <!-- Vehicle Details on the Right -->
                                                    <strong>Type:</strong> {{ $vehicle->vehicle_type }}<br>
                                                    <strong>Model:</strong> {{ $vehicle->model }}<br>
                                                    <strong>License Plate:</strong> {{ $vehicle->license_plate }}<br>
                                                    <strong>Capacity:</strong> {{ $vehicle->capacity }}<br>
                                                    <strong>Status:</strong> {{ $vehicle->current_status }}
                                                </td>
                                                <td style="width: 20%;">
                                                    <div class="d-flex flex-column align-items-center">
                                                        <a href="{{ route('vehicle.show', $vehicle->id) }}"
                                                            class="btn btn-info btn-sm mb-1">
                                                            <i class="fas fa-eye"></i>
                                                        </a>

                                                        <a href="{{ route('vehicle.edit', $vehicle->id) }}"
                                                            class="btn btn-warning btn-sm mb-1">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <form action="{{ route('vehicle.destroy', $vehicle->id) }}"
                                                            method="POST" id="deleteForm{{ $vehicle->id }}">
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
                    <h5 class="modal-title" id="createAuctionModalLabel">Create New Vehicle</h5>
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
                            <label for="vehicle_type">Vehicle Type</label>
                            <select name="vehicle_type" id="vehicle_type" class="form-control" required>
                                <option value="" disabled {{ old('vehicle_type') ? '' : 'selected' }}>Select Vehicle
                                    Type</option>
                                <option value="Car" {{ old('vehicle_type') == 'Car' ? 'selected' : '' }}>Car</option>
                                <option value="Bus" {{ old('vehicle_type') == 'Bus' ? 'selected' : '' }}>Bus</option>
                                <option value="Truck" {{ old('vehicle_type') == 'Truck' ? 'selected' : '' }}>Truck
                                </option>
                                <option value="Van" {{ old('vehicle_type') == 'Van' ? 'selected' : '' }}>Van</option>
                                <option value="Motorcycle" {{ old('vehicle_type') == 'Motorcycle' ? 'selected' : '' }}>
                                    Motorcycle</option>
                                <option value="Other" {{ old('vehicle_type') == 'Other' ? 'selected' : '' }}>Other
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="model">Model</label>
                            <input type="text" name="model" id="model" class="form-control"
                                value="{{ old('model') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="license_plate">License Plate</label>
                            <input type="text" name="license_plate" id="license_plate" class="form-control"
                                value="{{ old('license_plate') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="vin">VIN</label>
                            <input type="text" name="vin" id="vin" class="form-control"
                                value="{{ old('vin') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="capacity">Capacity</label>
                            <input type="number" name="capacity" id="capacity" class="form-control"
                                value="{{ old('capacity') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="current_status">Current Status</label>
                            <select name="current_status" id="current_status" class="form-control" required>
                                <option value="active" {{ old('current_status') == 'active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="inactive" {{ old('current_status') == 'inactive' ? 'selected' : '' }}>
                                    Inactive</option>
                                <option value="maintenance"
                                    {{ old('current_status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                <option value="retired" {{ old('current_status') == 'retired' ? 'selected' : '' }}>Retired
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="insurance_info">Insurance Information</label>
                            <textarea name="insurance_info" id="insurance_info" class="form-control">{{ old('insurance_info') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Vehicle Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Vehicle</button>
                        <a href="{{ route('vehicle.index') }}" class="btn btn-secondary">Cancel</a>
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
