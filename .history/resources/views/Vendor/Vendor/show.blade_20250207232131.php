@extends('base')

@section('content')
<div class="container">
    <h2 class="mb-4">Vendor Details</h2>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $vendor->business_name }}</h4>
            <p><strong>Registration Number:</strong> {{ $vendor->registration_number }}</p>
            <p><strong>Business Type:</strong> {{ $vendor->business_type }}</p>
            <p><strong>Industry Segment:</strong> {{ $vendor->industry_segment ?? 'N/A' }}</p>
            <p><strong>Number of Employees:</strong> {{ $vendor->number_of_employees ?? 'N/A' }}</p>
            <p><strong>Geographical Coverage:</strong> {{ $vendor->geographical_coverage ?? 'N/A' }}</p>
            <p><strong>Business Address:</strong> {{ $vendor->business_address }}</p>
            <p><strong>Contact Phone:</strong> {{ $vendor->contact_phone }}</p>
            <p><strong>Contact Email:</strong> {{ $vendor->contact_email }}</p>
            <p><strong>Website:</strong> 
                @if($vendor->website_url)
                    <a href="{{ $vendor->website_url }}" target="_blank">{{ $vendor->website_url }}</a>
                @else
                    N/A
                @endif
            </p>
        </div>
    </div>
</div>
   