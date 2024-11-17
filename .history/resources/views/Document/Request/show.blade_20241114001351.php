@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/document') }}">Document Tracking</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/document') }}">Document Submission</a></li>
            <li class="breadcrumb-item active" aria-current="page">Document Details</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header" style="font-size: 0.9rem; font-family: serif;">
                        <h1>Document Request Details</h1>

                        <p><strong>Requester Name:</strong> {{ $documentRequest->requester_name }}</p>
                        <p><strong>Request Date:</strong> {{ $documentRequest->request_date }}</p>
                        <p><strong>Data Type:</strong> {{ $documentRequest->data_type }}</p>
                        <p><strong>Description:</strong> {{ $documentRequest->description }}</p>
                        <p><strong>Priority Level:</strong> {{ $documentRequest->priority_level }}</p>
                        <p><strong>Status:</strong> {{ $documentRequest->status }}</p>
                        <p><strong>Assigned To:</strong> {{ $documentRequest->assigned_to }}</p>
                        <p><strong>Deadline:</strong> {{ $documentRequest->deadline }}</p>
                        <p><strong>Completion Date:</strong> {{ $documentRequest->completion_date }}</p>
                        <p><strong>Comments:</strong> {{ $documentRequest->comments }}</p>

                        <a href="{{ route('document-requests.index') }}" class="btn btn-secondary mt-3">Back to List</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
