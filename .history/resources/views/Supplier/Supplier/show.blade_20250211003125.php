@extends('base')

@section('title', 'Supplier Details')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: sans-serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('supplier.index') }}">Suppliers</a></li>
            <li class="breadcrumb-item active" aria-current="page">Supplier Details</li>
        </ol>
    </nav>

    <div class="container">
        <h1 class="text-center">Supplier Details</h1>
        <hr>

        <div class="card mb-3">
            <div class="card-body">
                <!-- Tab Navigation -->
                <ul class="nav nav-tabs" id="supplierTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="business-info-tab" data-bs-toggle="tab" href="#business-info"
                            role="tab" aria-controls="business-info" aria-selected="true">Business Info</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="legal-compliance-tab" data-bs-toggle="tab" href="#legal-compliance"
                            role="tab" aria-controls="legal-compliance" aria-selected="false">Legal Compliance</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="product-services-tab" data-bs-toggle="tab" href="#product-services"
                            role="tab" aria-controls="product-services" aria-selected="false">Product/Service Details</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="financial-health-tab" data-bs-toggle="tab" href="#financial-health"
                            role="tab" aria-controls="financial-health" aria-selected="false">Financial Health</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="references-tab" data-bs-toggle="tab" href="#references"
                            role="tab" aria-controls="references" aria-selected="false">Supplier References</a>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content mt-3" id="supplierTabContent">
                    <!-- Business Info Tab -->
                    <div class="tab-pane fade show active" id="business-info" role="tabpanel" aria-labelledby="business-info-tab">
                        <h3>Business Information</h3>
                        <p><strong>Company Name:</strong> {{ $supplier->company_name }}</p>
                        <p><strong>Business Type:</strong> {{ $supplier->business_type }}</p>
                        <p><strong>Contact Name:</strong> {{ $supplier->contact_name }}</p>
                        <p><strong>Contact Email:</strong> {{ $supplier->contact_email }}</p>
                        <p><strong>Contact Phone:</strong> {{ $supplier->contact_phone }}</p>
                        <p><strong>Business Address:</strong> {{ $supplier->business_address }}</p>
                        <p><strong>Website:</strong> 
                            @if ($supplier->website)
                                <a href="{{ $supplier->website }}" target="_blank">{{ $supplier->website }}</a>
                            @else
                                N/A
                            @endif
                        </p>
                    </div>

                    <!-- Legal Compliance Tab -->
                    <div class="tab-pane fade" id="legal-compliance" role="tabpanel" aria-labelledby="legal-compliance-tab">
                        <h3>Legal Compliance</h3>
                        @foreach ($legalcompliance as $compliance)
                            <p><strong>Registration Number:</strong> {{ $legalcompliance->registration_number }}</p>
                            <p><strong>Tax Identification Number:</strong> {{ $legalcompliance->tax_identification_number }}</p>
                            <p><strong>Licenses and Certifications:</strong> {{ $legalcompliance->licenses_certifications }}</p>
                            <p><strong>Years of Operation:</strong> {{ $legalcompliance->years_of_operation }} years</p>
                            <hr>
                        @endforeach
                    </div>

                    <!-- Product/Service Details Tab -->
                    <div class="tab-pane fade" id="product-services" role="tabpanel" aria-labelledby="product-services-tab">
                        <h3>Product/Service Details</h3>
                        @foreach ($productservices as $productservice)
                            <p><strong>Category:</strong> {{ $productservice->category }}</p>
                            <p><strong>Description:</strong> {{ $productservice->description }}</p>
                            <p><strong>Price:</strong> 
                                @if($productservice->price)
                                    ${{ number_format($productservice->price, 2) }}
                                @else
                                    N/A
                                @endif
                            </p>
                            <p><strong>Lead Time:</strong> {{ $productservice->lead_time }}</p>
                            <p><strong>Minimum Order:</strong> 
                                @if($productservice->minimum_order)
                                    {{ $productservice->minimum_order }}
                                @else
                                    N/A
                                @endif
                            </p>
                            <hr>
                        @endforeach
                    </div>

                    <!-- Financial Health Tab -->
                    <div class="tab-pane fade" id="financial-health" role="tabpanel" aria-labelledby="financial-health-tab">
                        <h3>Financial Health</h3>
                        @foreach ($financialhealth as $financial)
                            <p><strong>Bank Account Number:</strong> {{ $financial->bank_account_number }}</p>
                            <p><strong>Tax Compliance:</strong> {{ $financial->tax_compliance }}</p>
                            <p><strong>Insurance Coverage:</strong> {{ $financial->insurance_coverage }}</p>
                            <hr>
                        @endforeach
                    </div>

                    <!-- Supplier References Tab -->
                    <div class="tab-pane fade" id="references" role="tabpanel" aria-labelledby="references-tab">
                        <h3>Supplier References</h3>
                        @foreach ($supplierreferences as $supplierreference)
                            <p><strong>Client Name:</strong> {{ $supplierreference->client_name }}</p>
                            <p><strong>Client Contact:</strong> {{ $supplierreference->client_contact }}</p>
                            <p><strong>Project Description:</strong> {{ $supplierreference->project_description }}</p>
                            <hr>
                        @endforeach
                    </div>
                </div>

                <!-- Buttons -->
                <div class="button-container mt-3 text-center">
                    <a href="{{ route('supplier.index') }}" class="btn btn-secondary">Back</a>
                    <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-primary">Edit</a>
                </div>
            </div>
        </div>
    </div>
@endsection
