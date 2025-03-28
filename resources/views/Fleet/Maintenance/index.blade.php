@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: sans-serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/fleet') }}">Fleet Management</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/fleet') }}">Manage Details</a></li>
            <li class="breadcrumb-item active" aria-current="page">Maintenance List</li>
        </ol>
    </nav>

    <div class="container">
        <h2 class="mt-3">Vehicle Maintenance Records</h2>
        <a href="{{ route('maintenance.create') }}" class="btn btn-primary mb-3">Add Maintenance</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Vehicle</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Service Vendor</th>
                    <th>Total Cost</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($maintenances as $maintenance)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ optional($maintenance->vehicle)->license_plate ?? 'N/A' }}</td>
                        <td>{{ $maintenance->maintenance_type }}</td>
                        <td>{{ \Carbon\Carbon::parse($maintenance->maintenance_date)->format('Y-m-d') }}</td>
                        <td>{{ $maintenance->service_vendor }}</td>
                        <td>${{ number_format($maintenance->total_cost, 2) ?? '0.00' }}</td>
                        <td>{{ $maintenance->maintenance_status }}</td>
                        <td>
                            <a href="{{ route('maintenance.show', $maintenance->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('maintenance.edit', $maintenance->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form id="deleteForm{{ $maintenance->id }}" action="{{ route('maintenance.destroy', $maintenance->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $maintenance->id }})">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- SweetAlert for Success Message --}}
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

    {{-- SweetAlert for Delete Confirmation --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(maintenanceId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm' + maintenanceId).submit();
                }
            });
        }
    </script>

@endsection
