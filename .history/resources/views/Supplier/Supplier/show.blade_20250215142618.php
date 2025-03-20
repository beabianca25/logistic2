@extends('base')

@section('title', 'Supplier Details')

@section('content')
    <div class="container" style="font-family: sans-serif; font-size: small;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/supplier') }}">Supplier Management</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/supplier') }}">Supplier List</a></li>
                <li class="breadcrumb-item active" aria-current="page">Show Details</li>
            </ol>
        </nav>

        <div class="container">
            <div class="row">
                <!-- Supplier Information -->
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Supplier Information</h4>
                        </div>
                        <div class="card-body row">
                            <div class="col-md-6">
                                <p><strong>Company Name:</strong> {{ $supplier->company_name }}</p>
                                <p><strong>Business Type:</strong> {{ $supplier->business_type }}</p>
                                <p><strong>Contact Name:</strong> {{ $supplier->contact_name }}</p>
                                <p><strong>Contact Email:</strong> {{ $supplier->contact_email }}</p>
                                <p><strong>Contact Phone:</strong> {{ $supplier->contact_phone }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Business Address:</strong> {{ $supplier->business_address }}</p>
                                <p><strong>Website:</strong> 
                                    {!! $supplier->website ? '<a href="'.$supplier->website.'" target="_blank">'.$supplier->website.'</a>' : 'N/A' !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                

                <!-- Product/Service Details -->
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Product/Service</h4>
                        </div>
                        <div class="card-body">
                            @if ($productservices->isNotEmpty())
                                @foreach ($productservices as $productservice)
                                    <p><strong>Category:</strong> {{ $productservice->category }}</p>
                                    <p><strong>Description:</strong> {{ $productservice->description }}</p>
                                    <p><strong>Lead Time:</strong> {{ $productservice->lead_time }}</p>
                                    <p><strong>Minimum Order:</strong> {{ $productservice->minimum_order ?? 'N/A' }}</p>
                                    <p><strong>Price:</strong> 
                                        {{ $productservice->price ? '$' . number_format($productservice->price, 2) : 'N/A' }}
                                    </p>
                                    <hr>
                                @endforeach
                            @else
                                <p class="text-muted">No product/service details available.</p>
                            @endif
                        </div>
                    </div>
                </div>

              

                <!-- Financial Health -->
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Financial Health</h4>
                        </div>
                        <div class="card-body">
                            @if ($financialhealth)
                                <p><strong>Bank Account Number:</strong> {{ $financialhealth->bank_account_number }}</p>
                                <p><strong>Tax Compliance:</strong> {{ $financialhealth->tax_compliance }}</p>
                                <p><strong>Insurance Coverage:</strong> {{ $financialhealth->insurance_coverage }}</p>
                            @else
                                <p class="text-muted">No financial data available.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Supplier References -->
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>References</h4>
                        </div>
                        <div class="card-body">
                            @if ($supplierreferences->isNotEmpty())
                                @foreach ($supplierreferences as $reference)
                                    <p><strong>Client Name:</strong> {{ $reference->client_name }}</p>
                                    <p><strong>Client Contact:</strong> {{ $reference->client_contact }}</p>
                                    <p><strong>Project Description:</strong> {{ $reference->project_description }}</p>
                                    <hr>
                                @endforeach
                            @else
                                <p class="text-muted">No references available.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="col-md-12 text-center mt-3">
                    <a href="{{ url('supplier') }}" class="btn btn-primary">Back</a>
                    <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" 
                            onclick="return confirm('Are you sure you want to delete this supplier?');">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
