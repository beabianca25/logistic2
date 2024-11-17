@extends('base')

@section('content')
<nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: serif;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Vendor Portal</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/supplier') }}">Supplier Request</a></li>
        <li class="breadcrumb-item active" aria-current="page">View Details</li>
    </ol>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card" style="font-size: 0.9rem; font-family: serif;">
                <div class="card-header">
                    <h4>Supplier Request Details
                        <a href="{{ route('supplier.index') }}" class="btn-sm btn btn-danger float-end" style="font-size: 0.9rem; font-family: serif;">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <h5 class="card-text">Name: {{ $supplier->supplier_name }}</h5>
                    <p class="card-text"><strong>Product/Service Description:</strong> {{ $supplier->product_service_description }}</p>
                    <p class="card-text"><strong>Price Quote:</strong> ${{ $supplier->price_quote }}</p>
                    <p class="card-text"><strong>Availability/Lead Time:</strong> {{ $supplier->availability_lead_time }}</p>
                    <p class="card-text"><strong>Contact Information:</strong> {{ $supplier->contact_information }}</p>

                    @if ($supplier->attachments)
                        <p class="card-text"><strong>Attachments:</strong> <a href="{{ asset('storage/' . $supplier->attachments) }}" target="_blank">View File</a></p>
                    @endif

                    <p class="card-text"><strong>Status:</strong> {{ ucfirst($supplier->status) }}</p>

                    <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-warning" style="font-size: 0.9rem; font-family: serif;">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
