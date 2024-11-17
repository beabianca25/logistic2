@extends('base')

@section('content')
<nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: serif;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Vendor Portal</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Vendor List</a></li>
        <li class="breadcrumb-item active" aria-current="page">View Details</li>
    </ol>
</nav>
<div class="container" style="font-size: 0.9rem; font-family: serif;">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 style="font-size: 1rem; font-family: serif;">Vendor Details
                        <a href="{{ route('vendor.index') }}" class="btn btn-primary float-end" style="font-size: 0.9rem; font-family: serif;">Back to Vendors</a>
                    </h4>
                </div>
                <div class="card-body" style="font-size: 0.9rem; font-family: serif;">
                    <h5 class="card-title">{{ $vendor->vendor_name }}</h5>
                    <p class="card-text"><strong>Email:</strong> {{ $vendor->email }}</p>
                    <p class="card-text"><strong>Phone:</strong> {{ $vendor->phone }}</p>
                    <p class="card-text"><strong>Business License:</strong> {{ $vendor->business_license }}</p>
                    <p class="card-text"><strong>Tax Information:</strong> {{ $vendor->tax_information }}</p>
                    <p class="card-text"><strong>Service Category:</strong> {{ $vendor->service_category }}</p>
                    <p class="card-text"><strong>Contract Start Date:</strong> {{ $vendor->contract_start_date }}</p>
                    <p class="card-text"><strong>Contract End Date:</strong> {{ $vendor->contract_end_date }}</p>
                    <a href="{{ route('vendor.edit', $vendor) }}" class="btn btn-warning" style="font-size: 0.9rem; font-family: serif;">Edit</a>
                    <a href="{{ route('vendor.index') }}" class="btn btn-secondary" style="font-size: 0.9rem; font-family: serif;">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
