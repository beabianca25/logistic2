@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: sans-serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/vendors') }}">Vendors</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vendor Details</li>
        </ol>
    </nav>

    <div class="container">
        <h1>Vendor Details</h1>

        <div class="card mb-3">
            <div class="card-body">
                <!-- Tab Navigation -->
                <ul class="nav nav-tabs" id="vendorTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="business-info-tab" data-bs-toggle="tab" href="#business-info"
                            role="tab" aria-controls="business-info" aria-selected="true">Business Info</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="contact-info-tab" data-bs-toggle="tab" href="#contact-info"
                            role="tab" aria-controls="contact-info" aria-selected="false">Contact Info</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="service-details-tab" data-bs-toggle="tab" href="#service-details"
                            role="tab" aria-controls="service-details" aria-selected="false">Service Details</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="consent-details-tab" data-bs-toggle="tab" href="#consent-details"
                            role="tab" aria-controls="consent-details" aria-selected="false">Consent Details</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="certification-details-tab" data-bs-toggle="tab" href="#certification-details"
                            role="tab" aria-controls="certification-details" aria-selected="false">Certifications</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="invoicing-details-tab" data-bs-toggle="tab" href="#invoicing-details"
                            role="tab" aria-controls="invoicing-details" aria-selected="false">Invoicing</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="vendor-reviews-tab" data-bs-toggle="tab" href="#vendor-reviews"
                            role="tab" aria-controls="vendor-reviews" aria-selected="false">Reviews</a>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content mt-3" id="vendorTabContent">
                    <!-- Business Info Tab -->
                    <div class="tab-pane fade show active" id="business-info" role="tabpanel"
                        aria-labelledby="business-info-tab">
                        <h3>Business Information</h3>
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
                    </div>

                    <!-- Contact Info Tab -->
                    <div class="tab-pane fade" id="contact-info" role="tabpanel" aria-labelledby="contact-info-tab">
                        <h3>Contact Information</h3>
                        @foreach ($vendor->contacts as $contact)
                            <p><strong>Name:</strong> {{ $contact->first_name }} {{ $contact->last_name }}</p>
                            <p><strong>Job Title:</strong> {{ $contact->job_title }}</p>
                            <p><strong>Phone:</strong> {{ $contact->phone }}</p>
                            <p><strong>Email:</strong> {{ $contact->email }}</p>
                            <hr>
                        @endforeach
                    </div>

                    <!-- Service Details Tab -->
                    <div class="tab-pane fade" id="service-details" role="tabpanel" aria-labelledby="service-details-tab">
                        <h3>Service Details</h3>
                        @foreach ($vendor->services as $service)
                            <p><strong>Service Category:</strong> {{ $service->service_category }}</p>
                            <p><strong>Service Description:</strong> {{ $service->service_description }}</p>
                            <p><strong>Areas of Operation:</strong> {{ $service->areas_of_operation }}</p>
                            <p><strong>Price Range:</strong> {{ $service->price_range ?? 'Not specified' }}</p>
                            <hr>
                        @endforeach
                    </div>

                    <!-- Consent Details Tab -->
                    <div class="tab-pane fade" id="consent-details" role="tabpanel" aria-labelledby="consent-details-tab">
                        <h3>Consent Details</h3>
                        @foreach ($vendor->consents as $consent)
                            <p><strong>Authorized Person:</strong> {{ $consent->authorized_person_name }}</p>
                            <p><strong>Contact Email:</strong> {{ $consent->contract_email }}</p>
                            <p><strong>Agreement to Terms:</strong> {{ $consent->agreement_to_terms }}</p>
                            <p><strong>Agreement to Credit Check:</strong> {{ $consent->agreement_to_credit_check }}</p>
                            <p><strong>Signature:</strong> {{ $consent->signature }}</p>
                            <hr>
                        @endforeach
                    </div>

                    <!-- Certifications Tab -->
                    <div class="tab-pane fade" id="certification-details" role="tabpanel" aria-labelledby="certification-details-tab">
                        <h3>Certifications</h3>
                        @foreach ($vendor->certifications as $certification)
                    
                        <p><strong>Certification Name:</strong> {{ $certification->certification_name }}</p>
                        <p><strong>Certification Type:</strong> {{ $certification->certification_type }}</p>
                        <p><strong>Valid Until:</strong> {{ $certification->valid_until ? \Carbon\Carbon::parse($certification->valid_until)->format('F d, Y') : 'N/A' }}</p>
                        <p><strong>Certification File:</strong> 
                            @if($certification->file_path)
                                <a href="{{ asset('storage/' . $certification->file_path) }}" target="_blank">View Certification</a>
                            @else
                                No file uploaded
                            @endif
                        </p>
                        <hr>
                        
                        @endforeach
                    </div>
                    

                    <!-- Invoicing Tab -->
                    <div class="tab-pane fade" id="invoicing-details" role="tabpanel" aria-labelledby="invoicing-details-tab">
                        <h3>Invoicing</h3>
                        @foreach ($vendor->invoices as $invoice)
                            <p><strong>Accounts Payable Name:</strong> {{ $invoice->accounts_payable_name }}</p>
                            <p><strong>Requires PO:</strong> {{ $invoice->requires_po }}</p>
                            <p><strong>Additional Instructions:</strong> {{ $invoice->additional_instructions ?? 'None' }}</p>
                            <hr>
                        @endforeach
                    </div>

                    <!-- Reviews Tab -->
                    <div class="tab-pane fade" id="vendor-reviews" role="tabpanel" aria-labelledby="vendor-reviews-tab">
                        <h3>Reviews</h3>
                        @foreach ($vendor->reviews as $review)
                            <p><strong>Reviewer:</strong> {{ $review->reviewer_name }}</p>
                            <p><strong>Rating:</strong> {{ $review->rating }} / 5</p>
                            <p><strong>Review:</strong> {{ $review->review_text }}</p>
                            <p><strong>Submitted On:</strong> {{ \Carbon\Carbon::parse($review->created_at)->format('F d, Y') }}</p>
                            <hr>
                        @endforeach
                    </div>
                </div>

                <a href="{{ route('vendor.index') }}" class="btn btn-secondary mt-3">Back</a>
            </div>
        </div>
    </div>
@endsection
