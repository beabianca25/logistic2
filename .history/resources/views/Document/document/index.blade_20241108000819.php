@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/document') }}">Fleet Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">Document List</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="row" style="font-size: 0.9rem; font-family: serif;">
                    <div class="col-md-12">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Driver List</h3>
                            <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#createAuctionModal" style="font-size: 0.9rem; font-family: serif;">
                                Create New Document
                            </button>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0" style="font-size: 0.9rem; font-family: serif;">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Document Title</th>
                                            <th>Department</th>
                                            <th>Current Holder</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($documents as $document)
                                            <tr>
                                                <td>{{ $document->id }}</td>
                                                <td>{{ $document->document_title}}</td>
                                                <td>{{ $document->department }}</td>
                                                <td>{{ $document->current_holder }}</td>
                                                <td>{{ $document->status }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-around align-items-center">
                                                        <a href="{{ route('document.show', $document->id) }}"
                                                            class="btn btn-info btn-sm mx-0">
                                                            <i class="fas fa-eye"></i>
                                                        </a>

                                                        <a href="{{ route('document.edit', $document->id) }}"
                                                            class="btn btn-warning btn-sm mx-0">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <form action="{{ route('document.destroy', $document->id) }}"
                                                            method="POST" id="deleteForm{{ $document->id }}"
                                                            class="mx-0">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                onclick="confirmDelete({{ $document->id }})">
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

                    <form action="{{ route('document.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="vendor_id" class="form-label">Vendor</label>
                            <select name="vendor_id" id="vendor_id" class="form-control @error('vendor_id') is-invalid @enderror">
                                <option value="">Select Vendor</option>
                                @foreach($vendors as $vendor)
                                    <option value="{{ $vendor->id }}" {{ old('vendor_id') == $vendor->id ? 'selected' : '' }}>{{ $vendor->name }}</option>
                                @endforeach
                            </select>
                            @error('vendor_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                
                        <div class="mb-3">
                            <label for="document_title" class="form-label">Document Title</label>
                            <input type="text" name="document_title" class="form-control @error('document_title') is-invalid @enderror" value="{{ old('document_title') }}">
                            @error('document_title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                
                        <div class="mb-3">
                            <label for="file" class="form-label">Document File</label>
                            <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                            @error('file') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                
                        <div class="mb-3">
                            <label for="department" class="form-label">Department</label>
                            <input type="text" name="department" class="form-control @error('department') is-invalid @enderror" value="{{ old('department') }}">
                            @error('department') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                
                        <div class="mb-3">
                            <label for="current_holder" class="form-label">Current Holder (Optional)</label>
                            <input type="text" name="current_holder" class="form-control" value="{{ old('current_holder') }}">
                        </div>
                
                        <div class="mb-3">
                            <label for="purpose" class="form-label">Purpose (Optional)</label>
                            <textarea name="purpose" class="form-control">{{ old('purpose') }}</textarea>
                        </div>
                
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                            </select>
                            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                
                        <button type="submit" class="btn btn-success">Upload Document</button>
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
