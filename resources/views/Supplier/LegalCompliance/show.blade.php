@extends('base')

@section('title', 'Legal Compliance Details')

@section('content')
    <div class="container">
        <h1 class="text-center">Legal Compliance Information</h1>
        <h4 class="text-center">Supplier: {{ $legalCompliance->supplier->company_name }}</h4>
        <hr>

        <!-- Legal Compliance Details -->
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
            <tr>
                <td><strong>Years of Operation:</strong></td>
                <td>{{ $legalCompliance->years_of_operation }} years</td>
            </tr>
            <tr>
                <td><strong>Created At:</strong></td>
                <td>{{ $legalCompliance->created_at->format('F d, Y h:i A') }}</td>
            </tr>
            <tr>
                <td><strong>Last Updated:</strong></td>
                <td>{{ $legalCompliance->updated_at->format('F d, Y h:i A') }}</td>
            </tr>
        </table>

        <!-- Buttons -->
        <div class="button-container mt-3">
            <a href="{{ route('legalcompliance.index') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('legalcompliance.edit', $legalCompliance->id) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
@endsection
