@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: sans-serif;">
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
                    <div class="card-header" style="font-size: 0.9rem; font-family: sans-serif;">
                        <h1>Document Request Details</h1>

                        <p><strong>Requester Name:</strong> {{ $documentrequest->requester_name }}</p>
                        <p><strong>Request Date:</strong> {{ $documentrequest->request_date }}</p>
                        <p><strong>Data Type:</strong> {{ $documentrequest->data_type }}</p>
                        <p><strong>Description:</strong> {{ $documentrequest->description }}</p>
                        <p><strong>Priority Level:</strong> {{ $documentrequest->priority_level }}</p>
                        <p><strong>Status:</strong> {{ $documentrequest->status }}</p>
                        <p><strong>Assigned To:</strong> {{ $documentrequest->assigned_to }}</p>
                        <p><strong>Deadline:</strong> {{ $documentrequest->deadline }}</p>
                        <p><strong>Completion Date:</strong> {{ $documentrequest->completion_date }}</p>
                        <p><strong>Comments:</strong> {{ $documentrequest->comments }}</p>

                        <a href="{{ route('request.index') }}" class="btn btn-secondary mt-3">Back to List</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
