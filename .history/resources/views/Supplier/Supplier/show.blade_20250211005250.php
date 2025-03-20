@extends('base')

@section('title', 'Supplier Details')

@section('content')
    <nav aria-label="breadcrumb" class="breadcrumb-container">
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
                    @foreach ([
                        'business-info' => 'Business Info',
                        'legal-compliance' => 'Legal Compliance',
                        'product-services' => 'Product/Service Details',
                        'financial-health' => 'Financial Health',
                        'references' => 'Supplier References'
                    ] as $id => $title)
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ $id }}-tab" data-bs-toggle="tab" href="#{{ $id }}" role="tab" aria-controls="{{ $id }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ $title }}</a>
                        </li>
                    @endforeach
                </ul>

                <!-- Tab Content -->
                <div class="tab-content mt-3" id="supplierTabContent">
                    <div class="tab-pane fade show active" id="business-info" role="tabpanel">
                        <h3>Business Information</h3>
                        @foreach (['company_name' => 'Company Name', 'business_type' => 'Business Type', 'contact_name' => 'Contact Name', 'contact_email' => 'Contact Email', 'contact_phone' => 'Contact Phone', 'business_address' => 'Business Address'] as $field => $label)
                            <p><strong>{{ $label }}:</strong> {{ $supplier->$field }}</p>
                        @endforeach
                        <p><strong>Website:</strong> {!! $supplier->website ? '<a href="'.$supplier->website.'" target="_blank">'.$supplier->website.'</a>' : 'N/A' !!}</p>
                    </div>

                    <div class="tab-pane fade" id="legal-compliance" role="tabpanel">
                        <h3>Legal Compliance</h3>
                        @foreach ($legalcompliance as $compliance)
                            @foreach (['registration_number' => 'Registration Number', 'tax_identification_number' => 'Tax ID', 'licenses_certifications' => 'Licenses & Certifications', 'years_of_operation' => 'Years of Operation'] as $field => $label)
                                <p><strong>{{ $label }}:</strong> {{ $legalcompliance->$field }}</p>
                            @endforeach
                            <hr>
                        @endforeach
                    </div>

                    <div class="tab-pane fade" id="product-services" role="tabpanel">
                        <h3>Product/Service Details</h3>
                        @foreach ($productservices as $productservice)
                            @foreach (['category' => 'Category', 'description' => 'Description', 'lead_time' => 'Lead Time', 'minimum_order' => 'Minimum Order'] as $field => $label)
                                <p><strong>{{ $label }}:</strong> {{ $productservice->$field ?? 'N/A' }}</p>
                            @endforeach
                            <p><strong>Price:</strong> {{ $productservice->price ? '$'.number_format($productservice->price, 2) : 'N/A' }}</p>
                            <hr>
                        @endforeach
                    </div>

                    <div class="tab-pane fade" id="financial-health" role="tabpanel">
                        <h3>Financial Health</h3>
                        @foreach ($financialhealth as $financial)
                            @foreach (['bank_account_number' => 'Bank Account Number', 'tax_compliance' => 'Tax Compliance', 'insurance_coverage' => 'Insurance Coverage'] as $field => $label)
                                <p><strong>{{ $label }}:</strong> {{ $financialhealth->$field }}</p>
                            @endforeach
                            <hr>
                        @endforeach
                    </div>

                    <div class="tab-pane fade" id="references" role="tabpanel">
                        <h3>Supplier References</h3>
                        @foreach ($supplierreferences as $reference)
                            @foreach (['client_name' => 'Client Name', 'client_contact' => 'Client Contact', 'project_description' => 'Project Description'] as $field => $label)
                                <p><strong>{{ $label }}:</strong> {{ $reference->$field }}</p>
                            @endforeach
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
