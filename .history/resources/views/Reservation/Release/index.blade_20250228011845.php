@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: sans-serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/vehicle_reservation') }}">Fleet Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vehicle Reservation List</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-transparent d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Vehicle Release List</h3>
                    <a href="{{ route('release.create') }}" class="btn btn-sm btn-primary">
                        New Release
                    </a>
                </div>
                
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped" style="font-size: 0.9rem;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer Name</th>
                                    <th>Vehicle Reservation</th>
                                    <th>Release Date</th>
                                    <th>Release By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($releases as $release)
                                    <tr>
                                        <td>{{ str_pad(strtoupper(dechex($release->id)), 4, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $release->reservation->customer_name }}</td>
                                        <td>{{$release->reservation->reference_code}}</td>
                                        <td>{{ $release->release_date }}</td>
                                        <td>{{ $release->release_by }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('release.show', $release->id) }}"
                                                    class="btn btn-info btn-sm mx-1">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                <a href="{{ route('release.edit', $release->id) }}"
                                                    class="btn btn-warning btn-sm mx-1">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('release.destroy', $release->id) }}"
                                                    method="POST" id="deleteForm{{ $release->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete({{ $release->id }})">
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
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(releaseId) {
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
                    document.getElementById('deleteForm' + releaseId).submit();
                }
            });
        }
    </script>
@endsection
