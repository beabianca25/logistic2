@extends('base')

@section('title', 'Financial Health Information')

@section('content')
    <div class="container">
        <h1 class="text-center">Financial Health Information</h1>
        <h4 class="text-center">Supplier: {{ $financialHealth->supplier->contact_name }}</h4>
        <hr>

        <!-- Financial Details Table -->
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
            <tr>
                <td><strong>Created At:</strong></td>
                <td>{{ $financialHealth->created_at->format('F d, Y h:i A') }}</td>
            </tr>
            <tr>
                <td><strong>Last Updated:</strong></td>
                <td>{{ $financialHealth->updated_at->format('F d, Y h:i A') }}</td>
            </tr>
        </table>

        <!-- Buttons -->
        <div class="button-container mt-3">
            <a href="{{ route('financialhealth.index') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('financialhealth.edit', $financialHealth->id) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
@endsection
