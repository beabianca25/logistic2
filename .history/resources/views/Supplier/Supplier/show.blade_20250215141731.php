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
            'Website' => $supplier->website ? '<a href="' . $supplier->website . '" target="_blank">' . $supplier->website . '</a>' : 'N/A',
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
                @if ($legalcompliance)
                    <table class="table table-bordered small">
                        <tbody>
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
                        </tbody>
                    </table>
                @else
                    <p class="text-muted">No legal compliance data available.</p>
                @endif
            </div>

            <!-- Product/Service Details -->
            <div class="mb-4">
                <h5 class="mb-3 fw-bold">Product/Service</h5>
                @if ($productservices->isNotEmpty())
                    <table class="table table-bordered small">
                        <tbody>
                            @foreach ($productservices as $productservice)
                                <tr>
                                    <th class="fw-bold">Category</th>
                                    <td>{{ $productservice->category }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold">Description</th>
                                    <td>{{ $productservice->description }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold">Lead Time</th>
                                    <td>{{ $productservice->lead_time }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold">Minimum Order</th>
                                    <td>{{ $productservice->minimum_order ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold">Price</th>
                                    <td>{{ $productservice->price ? '$' . number_format($productservice->price, 2) : 'N/A' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted">No product/service details available.</p>
                @endif
            </div>


            <!-- Financial Health -->
            <div class="mb-4">
                <h5 class="mb-3 fw-bold">Financial Health</h5>
                @if ($financialhealth)
                    <table class="table table-bordered small">
                        <tbody>
                            <tr>
                                <th class="fw-bold">Bank Account Number</th>
                                <td>{{ $financialhealth->bank_account_number }}</td>
                            </tr>
                            <tr>
                                <th class="fw-bold">Tax Compliance</th>
                                <td>{{ $financialhealth->tax_compliance }}</td>
                            </tr>
                            <tr>
                                <th class="fw-bold">Insurance Coverage</th>
                                <td>{{ $financialhealth->insurance_coverage }}</td>
                            </tr>
                        </tbody>
                    </table>
                @else
                    <p class="text-muted">No financial data available.</p>
                @endif
            </div>


            <!-- Supplier References -->
            <div class="mb-4">
                <h5 class="mb-3 fw-bold">Reference</h5>
                @if ($supplierreferences->isNotEmpty())
                    <table class="table table-bordered small">
                        <tbody>
                            @foreach ($supplierreferences as $reference)
                                <tr>
                                    <th class="fw-bold">Client Name</th>
                                    <td>{{ $reference->client_name }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold">Client Contact</th>
                                    <td>{{ $reference->client_contact }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold">Project Description</th>
                                    <td>{{ $reference->project_description }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted">No references available.</p>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="text-center mt-4">
                <a href="{{ route('supplier.index') }}" class="btn btn-secondary">Back</a>
                <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div>
@endsection
