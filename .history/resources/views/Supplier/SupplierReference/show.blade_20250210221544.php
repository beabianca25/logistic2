@extends('base')

@section('title', 'Supplier Details')

@section('content')
    <div class="container">
        <h1 class="text-center">Supplier Details</h1>
        <hr>

        <!-- Supplier Details -->
        <table class="table table-bordered">
            <tr>
                <td><strong>Company Name:</strong></td>
                <td>{{ $supplier->company_name }}</td>
            </tr>
            <tr>
                <td><strong>Business Type:</strong></td>
                <td>{{ $supplier->business_type }}</td>
            </tr>
            <tr>
                <td><strong>Contact Name:</strong></td>
                <td>{{ $supplier->contact_name }}</td>
            </tr>
            <tr>
                <td><strong>Contact Email:</strong></td>
                <td>{{ $supplier->contact_email }}</td>
            </tr>
            <tr>
                <td><strong>Contact Phone:</strong></td>
                <td>{{ $supplier->contact_phone }}</td>
            </tr>
            <tr>
                <td><strong>Business Address:</strong></td>
                <td>{{ $supplier->business_address }}</td>
            </tr>
            <tr>
                <td><strong>Website:</strong></td>
                <td>
                    @if($supplier->website)
                        <a href="{{ $supplier->website }}" target="_blank">{{ $supplier->website }}</a>
                    @else
                        N/A
                    @endif
                </td>
            </tr>
        </table>

        <h2 class="text-center mt-4">Legal Compliance</h2>
        <table class="table table-bordered">
            <tr>
                <td><strong>Registration Number:</strong></td>
                <td>{{ $legalCompliance->registration_number }}</td>
            </tr>
            <tr>
                <td><strong>Tax Identification Number:</strong></td>
                <td>{{ $legalCompliance->tax_identification_number }}</td>
            </tr>
            <tr>
                <td><strong>Licenses and Certifications:</strong></td>
                <td>{{ $legalCompliance->licenses_certifications }}</td>
            </tr>
        </table>

        <h2 class="text-center mt-4">Product/Service Details</h2>
        <table class="table table-bordered">
            <tr>
                <td><strong>Category:</strong></td>
                <td>{{ $productService->category }}</td>
            </tr>
            <tr>
                <td><strong>Description:</strong></td>
                <td>{{ $productService->description }}</td>
            </tr>
            <tr>
                <td><strong>Price:</strong></td>
                <td>
                    @if($productService->price)
                        ${{ number_format($productService->price, 2) }}
                    @else
                        N/A
                    @endif
                </td>
            </tr>
        </table>

        <h2 class="text-center mt-4">Financial Health</h2>
        <table class="table table-bordered">
            <tr>
                <td><strong>Bank Account Number:</strong></td>
                <td>{{ $financialHealth->bank_account_number }}</td>
            </tr>
            <tr>
                <td><strong>Tax Compliance:</strong></td>
                <td>{{ $financialHealth->tax_compliance }}</td>
            </tr>
            <tr>
                <td><strong>Insurance Coverage:</strong></td>
                <td>{{ $financialHealth->insurance_coverage }}</td>
            </tr>
        </table>

        <h2 class="text-center mt-4">Supplier References</h2>
        <table class="table table-bordered">
            <tr>
                <td><strong>Client Name:</strong></td>
                <td>{{ $supplierReference->client_name }}</td>
            </tr>
            <tr>
                <td><strong>Client Contact:</strong></td>
                <td>{{ $supplierReference->client_contact }}</td>
            </tr>
            <tr>
                <td><strong>Project Description:</strong></td>
                <td>{{ $supplierReference->project_description }}</td>
            </tr>
        </table>

        <!-- Buttons -->
        <div class="button-container mt-3 text-center">
            <a href="{{ route('supplier.index') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
@endsection
