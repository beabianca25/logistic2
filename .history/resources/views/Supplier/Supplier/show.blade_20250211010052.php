@extends('base')

@section('title', 'Supplier Details')

@section('content')
    <div class="container mt-4">
        <div class="card p-4 shadow-lg">
            <h2 class="text-center mb-4">Supplier Details</h2>
            <hr>

            <!-- Supplier Information -->
            <div class="mb-4">
                <h4 class="mb-3 text-primary">Business Information</h4>
                <table class="table table-bordered">
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
                            <th>{{ $label }}</th>
                            <td>{!! $value !!}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Legal Compliance -->
            <div class="mb-4">
                <h4 class="mb-3 text-primary">Legal Compliance</h4>
                <table class="table table-bordered">
                    <tbody>
                        @foreach ($legalcompliance as $compliance)
                        @foreach ([
                            'Registration Number' => $legalcompliance->registration_number,
                            'Tax Identification Number' => $legalcompliance->tax_identification_number,
                            'Licenses and Certifications' => $legalcompliance->licenses_certifications,
                            'Years of Operation' => $legalcompliance->years_of_operation.' years'
                        ] as $label => $value)
                        <tr>
                            <th>{{ $label }}</th>
                            <td>{{ $value }}</td>
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Product/Service Details -->
            <div class="mb-4">
                <h4 class="mb-3 text-primary">Product/Service Details</h4>
                <table class="table table-bordered">
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
                            <th>{{ $label }}</th>
                            <td>{{ $value }}</td>
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Financial Health -->
            <div class="mb-4">
                <h4 class="mb-3 text-primary">Financial Health</h4>
                <table class="table table-bordered">
                    <tbody>
                        @foreach ($financialhealth as $financial)
                        @foreach ([
                            'Bank Account Number' => $financial->bank_account_number,
                            'Tax Compliance' => $financial->tax_compliance,
                            'Insurance Coverage' => $financial->insurance_coverage
                        ] as $label => $value)
                        <tr>
                            <th>{{ $label }}</th>
                            <td>{{ $value }}</td>
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Supplier References -->
            <div class="mb-4">
                <h4 class="mb-3 text-primary">Supplier References</h4>
                <table class="table table-bordered">
                    <tbody>
                        @foreach ($supplierreferences as $reference)
                        @foreach ([
                            'Client Name' => $reference->client_name,
                            'Client Contact' => $reference->client_contact,
                            'Project Description' => $reference->project_description
                        ] as $label => $value)
                        <tr>
                            <th>{{ $label }}</th>
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
