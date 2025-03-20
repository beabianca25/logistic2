@extends('base')

@section('content')
    <div class="container" style="font-family: sans-serif; font-size: small;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/assets') }}">Audit Management</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/assets') }}">Asset List</a></li>
                <li class="breadcrumb-item active" aria-current="page">Show Details</li>
            </ol>
        </nav>

        <div class="container">
            <div class="row">
                <!-- General Information Section -->
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>General Information</h4>
                        </div>
                        <div class="card-body row">
                            <div class="col-md-6">
                                <p><strong>Asset Name:</strong> {{ $asset->asset_name }}</p>
                                <p><strong>Category:</strong> {{ $asset->asset_category }}</p>
                                <p><strong>Asset Tag:</strong> {{ $asset->asset_tag }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Description:</strong> {{ $asset->description }}</p>
                                <p><strong>Usage Status:</strong> {{ $asset->usage_status }}</p>
                                <p><strong>Location:</strong> {{ $asset->location ?? 'Not Specified' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Acquisition Details -->
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Acquisition Details</h4>
                        </div>
                        <div class="card-body">
                            <p><strong>Purchase Date:</strong> {{ $asset->purchase_date }}</p>
                            <p><strong>Supplier Vendor:</strong> {{ $asset->supplier_vendor }}</p>
                            <p><strong>Invoice Number:</strong> {{ $asset->invoice_number ?? 'N/A' }}</p>
                            <p><strong>Cost of Asset:</strong> ${{ number_format($asset->cost_of_asset, 2) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Maintenance & Warranty -->
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Maintenance & Warranty</h4>
                        </div>
                        <div class="card-body">
                            <p><strong>Warranty Expiry Date:</strong> {{ $asset->warranty_expiry_date ?? 'Not Available' }}</p>
                            <p><strong>Maintenance Schedule:</strong> {{ $asset->maintenance_schedule ?? 'None' }}</p>
                            <p><strong>Last Maintenance Date:</strong> {{ $asset->last_maintenance_date ?? 'Not Available' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Disposal Details -->
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Disposal Details</h4>
                        </div>
                        <div class="card-body">
                            <p><strong>Disposal Date:</strong> {{ $asset->disposal_date ?? 'Not Disposed' }}</p>
                            <p><strong>Disposal Method:</strong> {{ $asset->disposal_method ?? 'N/A' }}</p>
                            <p><strong>Resale Value:</strong> ${{ number_format($asset->resale_value, 2) ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="col-md-12 text-center mt-3">
                    <a href="{{ route('assets.edit', $asset->id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('assets.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
@endsection
