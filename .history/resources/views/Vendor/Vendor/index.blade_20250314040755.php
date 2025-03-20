@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: sans-serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/vendors') }}">Vendor Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vendors List</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="row" style="font-size: 0.9rem; font-family: sans-serif;">
                    <div class="col-md-12">
                        <div class="card-header border-transparent">
                            <h4 class="card-title">Vendors List</h4>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0" style="font-size: 0.9rem; font-family: sans-serif;">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Business Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vendors as $vendor)
                                            <tr>
                                                <td>{{ str_pad(strtoupper(dechex($vendor->id)), 4, '0', STR_PAD_LEFT) }}</td>
                                                <td>{{ $vendor->business_name }}</td>
                                                <td>{{ $vendor->contact_email }}</td>
                                                <td>
                                                    <span class="badge 
                                                        @if($vendor->status == 'Active') bg-success
                                                        @elseif($vendor->status == 'Inactive') bg-secondary
                                                        @elseif($vendor->status == 'Pending') bg-warning
                                                        @elseif($vendor->status == 'Admin Review') bg-info
                                                        @elseif($vendor->status == 'Manager Approved') bg-primary
                                                        @else bg-dark @endif">
                                                        {{ $vendor->status }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-around align-items-center">
                                                        <a href="{{ route('vendor.show', $vendor->id) }}" class="btn btn-info btn-sm mx-0">
                                                            <i class="fas fa-eye"></i>
                                                        </a>

                                                        <a href="{{ route('vendor.edit', $vendor->id) }}" class="btn btn-warning btn-sm mx-0">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="confirmDelete({{ $vendor->id }})">
                                                            <i class="fas fa-trash"></i>
                                                        </button>

                                                        <form action="{{ route('vendor.destroy', $vendor->id) }}" method="POST" id="deleteForm{{ $vendor->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        @if(session('success'))
                            <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: '{{ session('success') }}',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            </script>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "This action cannot be undone!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm' + id).submit();
                }
            });
        }
    </script>
@endsection
