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
                                    <thead>
                                        <tr>
                                            <th>Vehicle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vehicles as $vehicle)
                                        <li>
                                            {{ $vehicle->make }} {{ $vehicle->model }} ({{ $vehicle->year }})
                                            <a href="{{ route('vehicle.show', $vehicle->id) }}">View</a>
                                            <a href="{{ route('vehicle.edit', $vehicle->id) }}">Edit</a>
                                            <form action="{{ route('vehicle.destroy', $vehicle->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">Delete</button>
                                            </form>
                                        </li>
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

                    <form action="{{ route('vehicles.store') }}" method="POST">
                        @csrf
                        <label for="make">Make:</label>
                        <input type="text" name="make" required>
                        <label for="model">Model:</label>
                        <input type="text" name="model" required>
                        <label for="year">Year:</label>
                        <input type="number" name="year" required>
                        <label for="vin">VIN:</label>
                        <input type="text" name="vin" required>
                        <label for="registration_number">Registration Number:</label>
                        <input type="text" name="registration_number" required>
                        <label for="capacity">Capacity:</label>
                        <input type="number" name="capacity" required>
                        <label for="current_status">Current Status:</label>
                        <select name="current_status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="maintenance">Maintenance</option>
                            <option value="retired">Retired</option>
                        </select>
                        <label for="insurance_info">Insurance Info:</label>
                        <input type="text" name="insurance_info">
                        <label for="image_path">Image Path:</label>
                        <input type="text" name="image_path">
                        <button type="submit">Submit</button>
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
