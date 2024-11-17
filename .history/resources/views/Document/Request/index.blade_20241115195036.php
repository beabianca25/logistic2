@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/document') }}">Document Tracking</a></li>
            <li class="breadcrumb-item active" aria-current="page">Document Request List</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="row" style="font-size: 0.9rem; font-family: serif;">
                    <div class="col-md-12">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Document List</h3>
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
                                            <th>Requester Name</th>
                                            <th>Request Date</th>
                                            <th>Data Type</th>
                                            <th>Priority Level</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($documentrequests as $documentrequest)
                                        <tr>
                                            <td>{{ $documentrequest->id }}</td>
                                            <td>{{ $documentrequest->requester_name }}</td>
                                            <td>{{ $documentrequest->request_date }}</td>
                                            <td>{{ $documentrequest->data_type }}</td>
                                            <td>{{ $documentrequest->priority_level }}</td>
                                            <td>{{ $documentrequest->status }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-around align-items-center">
                                                        <a href="{{ route('request.show', $documentrequest->id) }}"
                                                            class="btn btn-info btn-sm mx-0">
                                                            <i class="fas fa-eye"></i>
                                                        </a>

                                                        <a href="{{ route('request.edit', $documentrequest->id) }}"
                                                            class="btn btn-warning btn-sm mx-0">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <form action="{{ route('request.destroy', $documentrequest->id) }}"
                                                            method="POST" id="deleteForm{{ $documentrequest->id }}"
                                                            class="mx-0">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                onclick="confirmDelete({{ $documentrequest->id }})">
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
                    <h5 class="modal-title" id="createAuctionModalLabel">Create New Document</h5>
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

                    <form action="{{ route('request.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="requester_name">Requester Name</label>
                            <input type="text" name="requester_name" class="form-control" value="{{ old('requester_name') }}" required>
                        </div>
                
                        <div class="form-group">
                            <label for="request_date">Request Date</label>
                            <input type="date" name="request_date" class="form-control" value="{{ old('request_date') }}" required>
                        </div>
                
                        <div class="form-group">
                            <label for="data_type">Data Type</label>
                            <input type="text" name="data_type" class="form-control" value="{{ old('data_type') }}" required>
                        </div>
                
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" required>{{ old('description') }}</textarea>
                        </div>
                
                        <div class="form-group">
                            <label for="priority_level">Priority Level</label>
                            <select name="priority_level" class="form-control" required>
                                <option value="Low" {{ old('priority_level') == 'Low' ? 'selected' : '' }}>Low</option>
                                <option value="Medium" {{ old('priority_level') == 'Medium' ? 'selected' : '' }}>Medium</option>
                                <option value="High" {{ old('priority_level') == 'High' ? 'selected' : '' }}>High</option>
                                <option value="Urgent" {{ old('priority_level') == 'Urgent' ? 'selected' : '' }}>Urgent</option>
                            </select>
                        </div>
                
                        <div class="form-group">
                            <label for="deadline">Deadline</label>
                            <input type="date" name="deadline" class="form-control" value="{{ old('deadline') }}">
                        </div>
                
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="In Progress" {{ old('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                                <option value="Canceled" {{ old('status') == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                            </select>
                        </div>
                
                        <div class="form-group">
                            <label for="assigned_to">Assigned To</label>
                            <input type="text" name="assigned_to" class="form-control" value="{{ old('assigned_to') }}">
                        </div>
                
                        <div class="form-group">
                            <label for="completion_date">Completion Date</label>
                            <input type="date" name="completion_date" class="form-control" value="{{ old('completion_date') }}">
                        </div>
                
                        <div class="form-group">
                            <label for="comments">Comments</label>
                            <textarea name="comments" class="form-control">{{ old('comments') }}</textarea>
                        </div>
                
                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
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
