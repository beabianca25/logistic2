@extends('base')

@section('content')
<nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: serif;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Vendor Portal</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/supplier_request') }}">Supplier Request</a></li>
        <li class="breadcrumb-item active" aria-current="page">View Details</li>
    </ol>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card" style="font-size: 0.9rem; font-family: serif;">
                <div class="card-header">
                    <h4>Supplier Request Details
                        <a href="{{ route('supplier_request.index') }}" class="btn-sm btn btn-danger float-end" style="font-size: 0.9rem; font-family: serif;">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <h5 class="card-text">Name: {{ $supplier_request->supplier_name }}</h5>
                    <p class="card-text"><strong>Product/Service Description:</strong> {{ $supplier_request->product_service_description }}</p>
                    <p class="card-text"><strong>Price Quote:</strong> ${{ $supplier_request->price_quote }}</p>
                    <p class="card-text"><strong>Availability/Lead Time:</strong> {{ $supplier_request->availability_lead_time }}</p>
                    <p class="card-text"><strong>Contact Information:</strong> {{ $supplier_request->contact_information }}</p>

                    @if ($supplier_request->attachments)
                        <p class="card-text"><strong>Attachments:</strong> <a href="{{ asset('storage/' . $supplier_request->attachments) }}" target="_blank">View File</a></p>
                    @endif

                    <p class="card-text"><strong>Status:</strong> {{ ucfirst($supplier_request->status) }}</p>

                    <a href="{{ route('supplier_request.edit', $supplier_request->id) }}" class="btn btn-warning" style="font-size: 0.9rem; font-family: serif;">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
