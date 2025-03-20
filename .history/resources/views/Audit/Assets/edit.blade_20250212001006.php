@extends('base')

@section('content')
    <div class="container" style="font-family: sans-serif; font-size: small;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/assets') }}">Audit Management</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/assets') }}">Asset List</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Details</li>
            </ol>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Asset
                                <a href="{{ url('supply') }}" class="btn btn-primary float-end">Back</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('assets.update', $asset->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <!-- Basic Information -->
                                <div class="mb-3">
                                    <label class="form-label">Asset Name</label>
                                    <input type="text" name="asset_name" class="form-control"
                                        value="{{ $asset->asset_name }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Category</label>
                                    <input type="text" name="asset_category" class="form-control"
                                        value="{{ $asset->asset_category }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Asset Tag</label>
                                    <input type="text" name="asset_tag" class="form-control"
                                        value="{{ $asset->asset_tag }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control">{{ $asset->description }}</textarea>
                                </div>

                                <!-- Acquisition Details -->
                                <div class="mb-3">
                                    <label class="form-label">Purchase Date</label>
                                    <input type="date" name="purchase_date" class="form-control"
                                        value="{{ $asset->purchase_date }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Supplier Vendor</label>
                                    <input type="text" name="supplier_vendor" class="form-control"
                                        value="{{ $asset->supplier_vendor }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Invoice Number</label>
                                    <input type="text" name="invoice_number" class="form-control"
                                        value="{{ $asset->invoice_number }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Cost of Asset</label>
                                    <input type="number" step="0.01" name="cost_of_asset" class="form-control"
                                        value="{{ $asset->cost_of_asset }}" required>
                                </div>

                                <!-- Ownership & Assignment -->
                                <div class="mb-3">
                                    <label class="form-label">Assigned To</label>
                                    <input type="text" name="assigned_to" class="form-control"
                                        value="{{ $asset->assigned_to }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Location</label>
                                    <input type="text" name="location" class="form-control"
                                        value="{{ $asset->location }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Usage Status</label>
                                    <select name="usage_status" class="form-control">
                                        <option value="Active" {{ $asset->usage_status == 'Active' ? 'selected' : '' }}>
                                            Active</option>
                                        <option value="Under Maintenance"
                                            {{ $asset->usage_status == 'Under Maintenance' ? 'selected' : '' }}>Under
                                            Maintenance</option>
                                        <option value="Retired" {{ $asset->usage_status == 'Retired' ? 'selected' : '' }}>
                                            Retired</option>
                                    </select>
                                </div>

                                <!-- Maintenance & Warranty -->
                                <div class="mb-3">
                                    <label class="form-label">Warranty Expiry Date</label>
                                    <input type="date" name="warranty_expiry_date" class="form-control"
                                        value="{{ $asset->warranty_expiry_date }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Maintenance Schedule</label>
                                    <input type="text" name="maintenance_schedule" class="form-control"
                                        value="{{ $asset->maintenance_schedule }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Last Maintenance Date</label>
                                    <input type="date" name="last_maintenance_date" class="form-control"
                                        value="{{ $asset->last_maintenance_date }}">
                                </div>

                                <!-- Disposal Details -->
                                <div class="mb-3">
                                    <label class="form-label">Disposal Date</label>
                                    <input type="date" name="disposal_date" class="form-control"
                                        value="{{ $asset->disposal_date }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Disposal Method</label>
                                    <input type="text" name="disposal_method" class="form-control"
                                        value="{{ $asset->disposal_method }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Resale Value</label>
                                    <input type="number" step="0.01" name="resale_value" class="form-control"
                                        value="{{ $asset->resale_value }}">
                                </div>

                                <button type="submit" class="btn btn-success">Update Asset</button>
                                <a href="{{ route('assets.index') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
