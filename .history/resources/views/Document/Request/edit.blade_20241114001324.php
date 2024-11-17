@extends('base')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/document') }}">Document</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/document') }}">Document Submission</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Details</li>
    </ol>
</nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Document Request
                            <a href="{{ route('document.index') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('document-requests.update', $documentRequest->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="requester_name">Requester Name</label>
                                <input type="text" name="requester_name" class="form-control" value="{{ $documentRequest->requester_name }}" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="request_date">Request Date</label>
                                <input type="date" name="request_date" class="form-control" value="{{ $documentRequest->request_date }}" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="data_type">Data Type</label>
                                <input type="text" name="data_type" class="form-control" value="{{ $documentRequest->data_type }}" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" required>{{ $documentRequest->description }}</textarea>
                            </div>
                    
                            <div class="form-group">
                                <label for="priority_level">Priority Level</label>
                                <select name="priority_level" class="form-control" required>
                                    <option value="Low" {{ $documentRequest->priority_level == 'Low' ? 'selected' : '' }}>Low</option>
                                    <option value="Medium" {{ $documentRequest->priority_level == 'Medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="High" {{ $documentRequest->priority_level == 'High' ? 'selected' : '' }}>High</option>
                                    <option value="Urgent" {{ $documentRequest->priority_level == 'Urgent' ? 'selected' : '' }}>Urgent</option>
                                </select>
                            </div>
                    
                            <div class="form-group">
                                <label for="deadline">Deadline</label>
                                <input type="date" name="deadline" class="form-control" value="{{ $documentRequest->deadline }}">
                            </div>
                    
                            <button type="submit" class="btn btn-primary mt-2">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
