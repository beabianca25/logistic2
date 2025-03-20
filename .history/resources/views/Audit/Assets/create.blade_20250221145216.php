@extends('base')

@section('content')

    <body>
        <div class="container mt-5">
            <h2 class="mb-4">Create New Asset</h2>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('assets.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <!-- Basic Information -->
                        <div class="mb-3">
                            <label for="asset_name" class="form-label">Asset Name:</label>
                            <input type="text" id="asset_name" name="asset_name" class="form-control"
                                value="{{ old('asset_name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="asset_category" class="form-label">Asset Category:</label>
                            <input type="text" id="asset_category" name="asset_category" class="form-control"
                                value="{{ old('asset_category') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="asset_tag" class="form-label">Asset Tag:</label>
                            <input type="text" id="asset_tag" name="asset_tag" class="form-control"
                                value="{{ old('asset_tag') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description:</label>
                            <textarea id="description" name="description" class="form-control">{{ old('description') }}</textarea>
                        </div>

                        <!-- Acquisition Details -->
                        <div class="mb-3">
                            <label for="purchase_date" class="form-label">Purchase Date:</label>
                            <input type="date" id="purchase_date" name="purchase_date" class="form-control"
                                value="{{ old('purchase_date') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="supplier_vendor" class="form-label">Supplier/Vendor:</label>
                            <input type="text" id="supplier_vendor" name="supplier_vendor" class="form-control"
                                value="{{ old('supplier_vendor') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="invoice_number" class="form-label">Invoice Number:</label>
                            <input type="text" id="invoice_number" name="invoice_number" class="form-control"
                                value="{{ old('invoice_number') }}">
                        </div>

                        <div class="mb-3">
                            <label for="cost_of_asset" class="form-label">Cost of Asset:</label>
                            <input type="number" step="0.01" id="cost_of_asset" name="cost_of_asset" class="form-control"
                                value="{{ old('cost_of_asset') }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- Ownership & Assignment -->
                        <div class="mb-3">
                            <label for="assigned_to" class="form-label">Assigned To:</label>
                            <input type="text" id="assigned_to" name="assigned_to" class="form-control"
                                value="{{ old('assigned_to') }}">
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">Location:</label>
                            <input type="text" id="location" name="location" class="form-control"
                                value="{{ old('location') }}">
                        </div>

                        <div class="mb-3">
                            <label for="usage_status" class="form-label">Usage Status:</label>
                            <select id="usage_status" name="usage_status" class="form-control">
                                <option value="Active" {{ old('usage_status') == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Under Maintenance" {{ old('usage_status') == 'Under Maintenance' ? 'selected' : '' }}>Under Maintenance</option>
                                <option value="Retired" {{ old('usage_status') == 'Retired' ? 'selected' : '' }}>Retired</option>
                            </select>
                        </div>

                        <!-- Maintenance & Warranty -->
                        <div class="mb-3">
                            <label for="warranty_expiry_date" class="form-label">Warranty Expiry Date:</label>
                            <input type="date" id="warranty_expiry_date" name="warranty_expiry_date" class="form-control"
                                value="{{ old('warranty_expiry_date') }}">
                        </div>

                        <div class="mb-3">
                            <label for="maintenance_schedule" class="form-label">Maintenance Schedule:</label>
                            <input type="text" id="maintenance_schedule" name="maintenance_schedule" class="form-control"
                                value="{{ old('maintenance_schedule') }}">
                        </div>

                        <div class="mb-3">
                            <label for="last_maintenance_date" class="form-label">Last Maintenance Date:</label>
                            <input type="date" id="last_maintenance_date" name="last_maintenance_date" class="form-control"
                                value="{{ old('last_maintenance_date') }}">
                        </div>

                        <!-- Disposal Details -->
                        <div class="mb-3">
                            <label for="disposal_date" class="form-label">Disposal Date:</label>
                            <input type="date" id="disposal_date" name="disposal_date" class="form-control"
                                value="{{ old('disposal_date') }}">
                        </div>

                        <div class="mb-3">
                            <label for="disposal_method" class="form-label">Disposal Method:</label>
                            <input type="text" id="disposal_method" name="disposal_method" class="form-control"
                                value="{{ old('disposal_method') }}">
                        </div>

                        <div class="mb-3">
                            <label for="resale_value" class="form-label">Resale Value:</label>
                            <input type="number" step="0.01" id="resale_value" name="resale_value" class="form-control"
                                value="{{ old('resale_value') }}">
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('assets.index') }}" class="btn btn-secondary">Back to List</a>
                    <button type="submit" class="btn btn-primary">Create Asset</button>
                </div>
            </form>
        </div>
    </body>

@endsection
