@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: sans-serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/fleet') }}">Fleet Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vehicle List</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="row" style="font-size: 0.9rem; font-family: sans-serif;">
                    <div class="col-md-12">
                        <div class="card-header border-transparent d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Vehicle List</h3>
                            <a href="{{ route('vehicle.create') }}" class="btn btn-success btn-sm">
                                <i class="fas fa-plus"></i> Create Vehicle
                            </a>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0" style="font-size: 0.9rem; font-family: sans-serif;">
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
                                                    <strong>Status:</strong>
                                                    <span
                                                        style="background-color: 
                                                        @if ($vehicle->current_status == 'Active') green
                                                        @elseif ($vehicle->current_status == 'Inactive') gray
                                                        @elseif ($vehicle->current_status == 'Maintenance') orange
                                                        @else red @endif;
                                                        color: white; padding: 3px 5px; border-radius: 3px;">
                                                        {{ ucfirst($vehicle->current_status) }}
                                                    </span>
                                                </td>

                                                <td style="width: 20%;">
                                                    <div class="d-flex flex-column align-items-center">
                                                        <a href="{{ route('vehicle.show', $vehicle->id) }}"
                                                            class="btn btn-info btn-sm mb-1" title="View">
                                                            <i class="fas fa-eye"></i>
                                                        </a>

                                                        <a href="{{ route('vehicle.edit', $vehicle->id) }}"
                                                            class="btn btn-warning btn-sm mb-1" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <form action="{{ route('vehicle.destroy', $vehicle->id) }}"
                                                            method="POST" id="deleteForm{{ $vehicle->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                onclick="confirmDelete({{ $vehicle->id }})"
                                                                title="Delete">
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
        function confirmDelete(vehicleId) {
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
                    document.getElementById('deleteForm' + vehicleId).submit();
                }
            });
        }
    </script>
@endsection
