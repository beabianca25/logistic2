@extends('base')

@section('content')
<nav aria-label="breadcrumb" style="font-size: 0.5rem; font-family: sans-serif;">
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
                    <h5>Document Details</h5>
                </div>
                <div class="card-body" style="font-size: 0.9rem; font-family: sans-serif;">
                    <div class="mb-3">
                        <strong>Title:</strong> {{ $document->document_title }}
                    </div>
                
                    <div class="mb-3">
                        <strong>Department:</strong> {{ $document->department }}
                    </div>
                
                    <div class="mb-3">
                        <strong>Current Holder:</strong> {{ $document->current_holder ?? 'N/A' }}
                    </div>
                
                    <div class="mb-3">
                        <strong>Purpose:</strong> {{ $document->purpose ?? 'N/A' }}
                    </div>
                
                    <div class="mb-3">
                        <strong>Status:</strong> <span class="badge bg-{!! $document->status == 'Pending' ? 'warning' : ($document->status == 'Approved' ? 'success' : ($document->status == 'Rejected' ? 'danger' : ($document->status == 'Active' ? 'primary' : ($document->status == 'Inactive' ? 'secondary' : 'dark')))) !!}">{{ ucfirst($document->status) }}</span>
                    </div>
                
                    <div class="mb-3">
                        <strong>File:</strong>
                        <a href="{{ Storage::url($document->file_path) }}" target="_blank">Download File</a>
                    </div>
                
                    <a href="{{ route('document.index') }}" class="btn btn-primary">Back to Documents</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
