@extends('base')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/fleet') }}">Fleet Management</a></li>
        <li class="breadcrumb-item active" aria-current="page">Driver List</li>
    </ol>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Driver List
                        <a href="{{ route('driver.create') }}" class="btn btn-primary float-end">Add New Driver</a>
                    </h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: '{{ session("success") }}',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        </script>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Profile</th>
                                    <th>Driver Name</th>
                                    <th>Vehicle</th>
                                    <th>License No.</th>
                                    <th>Employment Status</th>
                                    <th>Contact</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($drivers as $driver)
                                    <tr>
                                        <td>{{ $driver->id }}</td>
                                        <td>
                                            @if ($driver->profile_picture)
                                                <img src="{{ asset('storage/' . $driver->profile_picture) }}" alt="Profile" width="50" height="50" class="rounded-circle">
                                            @else
                                                <img src="{{ asset('images/default-profile.png') }}" alt="Default" width="50" height="50" class="rounded-circle">
                                            @endif
                                        </td>
                                        <td>{{ $driver->driver_name }}</td>
                                        <td>
                                            @if ($driver->vehicle)
                                                {{ $driver->vehicle->license_plate }} - {{ $driver->vehicle->model }}
                                            @else
                                                Not Assigned
                                            @endif
                                        </td>
                                        <td>{{ $driver->license_number }}</td>
                                        <td>{{ $driver->employment_status }}</td>
                                        <td>{{ $driver->contact_number }}</td>
                                        <td>
                                            <span class="badge bg-{{ $driver->status == 'Active' ? 'success' : 'danger' }}">
                                                {{ $driver->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('driver.show', $driver->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('driver.edit', $driver->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $driver->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        
                                            <form id="delete-form-{{ $driver->id }}" action="{{ route('driver.destroy', $driver->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                        
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No drivers found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function() {
            let driverId = this.getAttribute("data-id");

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${driverId}`).submit();
                }
            });
        });
    });
});
</script>
@endsection
