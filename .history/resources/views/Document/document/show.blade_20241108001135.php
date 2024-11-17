@extends('base')

@section('content')
<nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: serif;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Vendor Portal</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/auction') }}">Auction</a></li>
        <li class="breadcrumb-item active" aria-current="page">Auction Details</li>
    </ol>
</nav>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header" style="font-size: 0.9rem; font-family: serif;">
                        <h5>Auction Details
                            <a href="{{ route('docoment.index') }}" class="btn btn-danger float-end" style="font-size: 0.8rem; font-family: serif;">Back</a>
                        </h5>
                    </div>
                    <div class="card-body" style="font-size: 0.9rem; font-family: serif;">
                        <div class="mb-3">
                            <strong>Title:</strong> {{ $document->document_title }}
                        </div>
                    
                        <div class="mb-3">
                            <strong>Vendor:</strong> {{ $document->vendor->name ?? 'N/A' }}
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
                            <strong>Status:</strong> {{ ucfirst($document->status) }}
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
    </div>
@endsection
