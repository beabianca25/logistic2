@extends('base')

@section('title', 'Supplier Details')

@section('content')
    <div class="container">
        <h1 class="text-center">Supplier Details</h1>
        <hr>

        <!-- Supplier Details Table -->
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
            <tr>
                <td><strong>Created At:</strong></td>
                <td>{{ $supplier->created_at->format('F d, Y h:i A') }}</td>
            </tr>
            <tr>
                <td><strong>Last Updated:</strong></td>
                <td>{{ $supplier->updated_at->format('F d, Y h:i A') }}</td>
            </tr>
        </table>

        <!-- Buttons -->
        <div class="button-container mt-3">
            <a href="{{ route('supplier.index') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
@endsection
