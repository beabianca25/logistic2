@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: sans-serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/fleet') }}">Fleet Management</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/fleet') }}">Manage Details</a></li>
            <li class="breadcrumb-item active" aria-current="page">Fuel List</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="row" style="font-size: 0.9rem; font-family: sans-serif;">
                    <div class="col-md-12">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Fuel List</h3>
                            <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#createAuctionModal" style="font-size: 0.9rem; font-family: sans-serif;">
                                Create New Fuel
                            </button>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0" style="font-size: 0.9rem; font-family: sans-serif;">
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
                                            <td>{{ str_pad(strtoupper(dechex($fuel->id)), 4, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($fuel->refill_date)->format('Y-m-d') }}</td>
                                            <td>{{ $fuel->fuel_amount }} L</td>
                                            <td>${{ $fuel->cost }}</td>
                                            <td>{{ $fuel->fuel_station }}</td>
                                            <td>{{ ucfirst($fuel->status) }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-around align-items-center">
                                                        <a href="{{ route('fuel.show', $fuel->id) }}"
                                                            class="btn btn-info btn-sm mx-0">
                                                            <i class="fas fa-eye"></i>
                                                        </a>

                                                        <a href="{{ route('fuel.edit', $fuel->id) }}"
                                                            class="btn btn-warning btn-sm mx-0">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <form action="{{ route('fuel.destroy', $fuel->id) }}"
                                                            method="POST" id="deleteForm{{ $fuel->id }}"
                                                            class="mx-0">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                onclick="confirmDelete({{ $fuel->id }})">
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

                    <form action="{{ route('fuel.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="vehicle_id">Vehicle</label>
                            <select name="vehicle_id" id="vehicle_id" class="form-control">
                                <option value="">Select Vehicle</option>
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_type }}-{{ $vehicle->license_plate }}</option>
                                @endforeach
                            </select>
                        </div>
                
                        <div class="form-group">
                            <label for="refill_date">Refill Date</label>
                            <input type="date" name="refill_date" id="refill_date" class="form-control" required>
                        </div>
                
                        <div class="form-group">
                            <label for="fuel_amount">Fuel Amount (liters/gallons)</label>
                            <input type="number" step="0.01" name="fuel_amount" id="fuel_amount" class="form-control" required>
                        </div>
                
                        <div class="form-group">
                            <label for="cost">Cost ($)</label>
                            <input type="number" step="0.01" name="cost" id="cost" class="form-control" required>
                        </div>
                
                        <div class="form-group">
                            <label for="fuel_station">Fuel Station</label>
                            <input type="text" name="fuel_station" id="fuel_station" class="form-control" required>
                        </div>
                
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="Pending">Pending</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                
                        <button type="submit" class="btn btn-primary mt-3">Add Fuel Refill</button>
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
