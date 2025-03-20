@extends('base')

@section('content')
<div class="container">
    <h1>Vendor Details</h1>
    
    <h2>Business Information</h2>
    <p><strong>Business Name:</strong> {{ $vendor->business_name }}</p>
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

    <h2>Contact Information</h2>
    <p><strong>First Name:</strong> {{ $contacts->first_name }}</p>
    <p><strong>Last Name:</strong> {{ $contacts->last_name }}</p>
    <p><strong>Job Title:</strong> {{ $contacts->job_title }}</p>
    <p><strong>Phone:</strong> {{ $contacts->phone }}</p>
    <p><strong>Email:</strong> {{ $contacts->email }}</p>
    <a href="{{ route('vendorcontact.edit', $contacts->id) }}" class="btn btn-primary">Edit</a>
    
    <h2>Service Details</h2>
    <p><strong>Service Category:</strong> {{ $service->service_category }}</p>
    <p><strong>Service Description:</strong> {{ $service->service_description }}</p>
    <p><strong>Areas of Operation:</strong> {{ $service->areas_of_operation }}</p>
    <p><strong>Price Range:</strong> {{ $service->price_range ?? 'Not specified' }}</p>

    <h2>Consent Details</h2>
    <p><strong>Authorized Person Name:</strong> {{ $consent->authorized_person_name }}</p>
    <p><strong>Contact Email:</strong> {{ $consent->contract_email }}</p>
    <p><strong>Agreement to Terms:</strong> {{ $consent->agreement_to_terms }}</p>
    <p><strong>Agreement to Credit Check:</strong> {{ $consent->agreement_to_credit_check }}</p>
    <p><strong>Signature:</strong> {{ $consent->signature }}</p>
    <a href="{{ route('vendorconsent.edit', $consent->id) }}" class="btn btn-primary">Edit</a>
    
    <h2>Certification Details</h2>
    <p><strong>Certification Name:</strong> {{ $certification->certification_name }}</p>
    <p><strong>Certification Type:</strong> {{ $certification->certification_type }}</p>
    <p><strong>Valid Until:</strong> {{ $certification->valid_until ? $certification->valid_until->format('F d, Y') : 'N/A' }}</p>
    <p><strong>Certification File:</strong> 
        @if($certification->file_path)
            <a href="{{ asset('storage/' . $certification->file_path) }}" target="_blank">View Certification</a>
        @else
            No file uploaded
        @endif
    </p>
    <a href="{{ route('vendorcertification.edit', $certification->id) }}" class="btn btn-primary">Edit</a>

    <h2>Vendor Invoicing Details</h2>
    <p><strong>Accounts Payable Name:</strong> {{ $vendorInvoicing->accounts_payable_name }}</p>
    <p><strong>Accounts Payable Email:</strong> {{ $vendorInvoicing->accounts_payable_email }}</p>
    <p><strong>Postal Address:</strong> {{ $vendorInvoicing->postal_address }}</p>
    <p><strong>Requires Purchase Order (PO):</strong> {{ $vendorInvoicing->requires_po }}</p>
    <p><strong>Additional Instructions:</strong> {{ $vendorInvoicing->additional_instructions ?? 'None' }}</p>
    <a href="{{ route('vendorinvoicing.edit', $vendorInvoicing->id) }}" class="btn btn-primary">Edit</a>

    <h2>Vendor Review Details</h2>
    <p><strong>Reviewer Name:</strong> {{ $review->reviewer_name }}</p>
    <p><strong>Review:</strong> {{ $review->review_text }}</p>
    <p><strong>Rating:</strong> {{ $review->rating }} / 5</p>
    <p><strong>Submitted On:</strong> {{ $review->created_at->format('F d, Y') }}</p>
    <a href="{{ route('vendorreview.index') }}" class="btn btn-primary">Back to Reviews</a>
</div>
@endsection
