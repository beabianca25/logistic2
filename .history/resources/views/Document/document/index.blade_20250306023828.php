@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: sans-serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/document') }}">Fleet Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">Document List</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="row" style="font-size: 0.9rem; font-family: sans-serif;">
                    <div class="col-md-12">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Document List</h3>
                            <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#createDocumentModal" style="font-size: 0.9rem; font-family: sans-serif;">
                                <i class="fas fa-plus"></i> Create New Document
                            </button>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0" style="font-size: 0.9rem; font-family: sans-serif;">
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
                                                <td>{{ str_pad(strtoupper(dechex($document->id)), 4, '0', STR_PAD_LEFT) }}</td>
                                                <td>{{ $document->document_title }}</td>
                                                <td>{{ $document->department }}</td>
                                                <td>{{ $document->current_holder }}</td>
                                                <td>
                                                    <span class="badge 
                                                        @if($document->status == 'Approved') bg-success 
                                                        @elseif($document->status == 'Pending') bg-warning 
                                                        @elseif($document->status == 'Rejected') bg-danger 
                                                        @elseif($document->status == 'Active') bg-primary 
                                                        @elseif($document->status == 'Inactive') bg-secondary 
                                                        @elseif($document->status == 'Archived') bg-dark 
                                                        @endif">
                                                        {{ ucfirst($document->status) }}
                                                    </span>
                                                </td>
                                                
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

                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="confirmDelete({{ $document->id }})">
                                                            <i class="fas fa-trash"></i>
                                                        </button>

                                                        <form action="{{ route('document.destroy', $document->id) }}" method="POST" id="deleteForm{{ $document->id }}">
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

    <div class="modal fade" id="createDocumentModal" tabindex="-1" aria-labelledby="createDocumentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="font-size: 0.9rem; font-family: sans-serif;">
                <div class="modal-header">
                    <h5 class="modal-title" id="createDocumentModalLabel">Create New Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                                <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Approved" {{ old('status') == 'Approved' ? 'selected' : '' }}>Approved</option>
                                <option value="Rejected" {{ old('status') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="Archived" {{ old('status') == 'Archived' ? 'selected' : '' }}>Archived</option>
                            </select>
                            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <button type="submit" class="btn btn-success">Upload Document</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
