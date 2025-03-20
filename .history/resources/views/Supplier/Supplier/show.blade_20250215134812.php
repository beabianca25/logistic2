@extends('base')

@section('title', 'Supplier Details')

@section('content')
    <div class="container mt-4">
        <div class="card p-4 shadow-lg">
            <h3 class="text-center mb-4 fw-bold">Supplier Details</h3>
            <hr>

            <!-- Supplier Information -->
            <div class="mb-4">
                <h5 class="mb-3 fw-bold">Supplier</h5>
                <table class="table table-bordered small">
                    <tbody>
                        @foreach ([
                            'Company Name' => $supplier->company_name,
                            'Business Type' => $supplier->business_type,
                            'Contact Name' => $supplier->contact_name,
                            'Contact Email' => $supplier->contact_email,
                            'Contact Phone' => $supplier->contact_phone,
                            'Business Address' => $supplier->business_address,
                            'Website' => $supplier->website ? '<a href="'.$supplier->website.'" target="_blank">'.$supplier->website.'</a>' : 'N/A'
                        ] as $label => $value)
                        <tr>
                            <th class="fw-bold">{{ $label }}</th>
                            <td>{!! $value !!}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Legal Compliance -->
            <div class="mb-4">
                <h5 class="mb-3 fw-bold">Legal Compliance</h5>
                <table class="table table-bordered small">
                    <tbody>
                        @foreach ($legalcompliance as $compliance)
                        <tr>
                            <th class="fw-bold">Registration Number</th>
                            <td>{{ $legalcompliance->registration_number }}</td>
                        </tr>
                        <tr>
                            <th class="fw-bold">Tax Identification Number</th>
                            <td>{{ $legalcompliance->tax_identification_number }}</td>
                        </tr>
                        <tr>
                            <th class="fw-bold">Licenses and Certifications</th>
                            <td>{{ $legalcompliance->licenses_certifications }}</td>
                        </tr>
                        <tr>
                            <th class="fw-bold">Years of Operation</th>
                            <td>{{ $legalcompliance->years_of_operation }} years</td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
            

            <!-- Product/Service Details -->
            <div class="mb-4">
                <h5 class="mb-3 fw-bold">Product/Service</h5>
                <table class="table table-bordered small">
                    <tbody>
                        @foreach ($productservices as $productservice)
                        @foreach ([
                            'Category' => $productservice->category,
                            'Description' => $productservice->description,
                            'Lead Time' => $productservice->lead_time,
                            'Minimum Order' => $productservice->minimum_order ?? 'N/A',
                            'Price' => $productservice->price ? '$'.number_format($productservice->price, 2) : 'N/A'
                        ] as $label => $value)
                        <tr>
                            <th class="fw-bold">{{ $label }}</th>
                            <td>{{ $value }}</td>
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Financial Health -->
            <div class="mb-4">
                <h5 class="mb-3 fw-bold">Financial Health</h5>
                <table class="table table-bordered small">
                    <tbody>
                        @foreach ($financialhealth as $financial)
                        @foreach ([
                            'Bank Account Number' => $financialhealth->bank_account_number,
                            'Tax Compliance' => $financialhealth->tax_compliance,
                            'Insurance Coverage' => $financialhealth->insurance_coverage
                        ] as $label => $value)
                        <tr>
                            <th class="fw-bold">{{ $label }}</th>
                            <td>{{ $value }}</td>
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Supplier References -->
            <div class="mb-4">
                <h5 class="mb-3 fw-bold">Reference</h5>
                <table class="table table-bordered small">
                    <tbody>
                        @foreach ($supplierreferences as $reference)
                        @foreach ([
                            'Client Name' => $reference->client_name,
                            'Client Contact' => $reference->client_contact,
                            'Project Description' => $reference->project_description
                        ] as $label => $value)
                        <tr>
                            <th class="fw-bold">{{ $label }}</th>
                            <td>{{ $value }}</td>
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Action Buttons -->
            <div class="text-center mt-4">
                <a href="{{ route('supplier.index') }}" class="btn btn-secondary">Back</a>
                <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div>
@endsection
