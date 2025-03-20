@extends('base')

@section('title', 'Supplier Reference Details')

@section('content')
    <div class="container">
        <h1 class="text-center">Supplier Reference Details</h1>
        <hr>

        <!-- Supplier Reference Details Table -->
        <table class="table table-bordered">
            <tr>
                <td><strong>Supplier:</strong></td>
                <td>{{ $supplierReference->supplier->company_name }}</td>
            </tr>
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
            <tr>
                <td><strong>Created At:</strong></td>
                <td>{{ $supplierReference->created_at->format('F d, Y h:i A') }}</td>
            </tr>
            <tr>
                <td><strong>Last Updated:</strong></td>
                <td>{{ $supplierReference->updated_at->format('F d, Y h:i A') }}</td>
            </tr>
        </table>

        <!-- Buttons -->
        <div class="button-container mt-3">
            <a href="{{ route('supplier.show', $supplierReference->supplier->id) }}" class="btn btn-secondary">Back to Supplier</a>
            <a href="{{ route('supplierreference.edit', $supplierReference->id) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
@endsection
