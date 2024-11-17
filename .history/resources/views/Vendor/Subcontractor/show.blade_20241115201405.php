@extends('base')

@section('content')
<nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: sans-serif;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Vendor Portal</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/supplier') }}">Supplier Request</a></li>
        <li class="breadcrumb-item active" aria-current="page">View Details</li>
    </ol>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card" style="font-size: 0.9rem; font-family: sans-serif;">
                <div class="card-header">
                    <h4>Supplier Request Details
                        <a href="{{ route('subcontractor.index') }}" class="btn-sm btn btn-danger float-end" style="font-size: 0.9rem; font-family: sans-serif;">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <h3>{{ $subcontractor->subcontractor_name }}</h3>
                    <p><strong>Project Scope:</strong> {{ $subcontractor->project_scope }}</p>
                    <p><strong>Cost Estimate:</strong> ${{ number_format($subcontractor->cost_estimate, 2) }}</p>
                    <p><strong>Timeline:</strong> {{ $subcontractor->timeline }}</p>
                    <p><strong>Resources Required:</strong> {{ $subcontractor->resources_required }}</p>
                    <p><strong>Contact Information:</strong> {{ $subcontractor->contact_information }}</p>
                    <p><strong>Status:</strong> {{ $subcontractor->status }}</p>
                    <p><strong>Submitted Date:</strong> {{ $subcontractor->submitted_date }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
