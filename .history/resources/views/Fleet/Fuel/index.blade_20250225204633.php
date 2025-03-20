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
                            <a href="{{ route('fuel.create') }}" class="btn btn-sm btn-primary float-end" style="font-size: 0.9rem; font-family: sans-serif;">
                                <i class="fas fa-plus"></i> Create New Fuel
                            </a>
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
                                                    <a href="{{ route('fuel.show', $fuel->id) }}" class="btn btn-info btn-sm mx-0">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    <a href="{{ route('fuel.edit', $fuel->id) }}" class="btn btn-warning btn-sm mx-0">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <form action="{{ route('fuel.destroy', $fuel->id) }}" method="POST" id="deleteForm{{ $fuel->id }}" class="mx-0">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $fuel->id }})">
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
        function confirmDelete(fuelId) {
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
                    document.getElementById('deleteForm' + fuelId).submit();
                }
            });
        }
    </script>
@endsection
