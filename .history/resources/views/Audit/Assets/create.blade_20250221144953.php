@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Asset</h2>
    
    <form action="{{ route('assets.store') }}" method="POST">
        @csrf

        <!-- Basic Information -->
        <div class="mb-3">
            <label for="asset_name" class="form-label">Asset Name</label>
            <input type="text" class="form-control" id="asset_name" name="asset_name" required>
        </div>

        <div class="mb-3">
            <label for="asset_category" class="form-label">Asset Category</label>
            <input type="text" class="form-control" id="asset_category" name="asset_category" required>
        </div>

        <div class="mb-3">
            <label for="asset_tag" class="form-label">Asset Tag</label>
            <input type="text" class="form-control" id="asset_tag" name="asset_tag" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>

        <!-- Acquisition Details -->
        <div class="mb-3">
            <label for="purchase_date" class="form-label">Purchase Date</label>
            <input type="date" class="form-control" id="purchase_date" name="purchase_date" required>
        </div>

        <div class="mb-3">
            <label for="supplier_vendor" class="form-label">Supplier/Vendor</label>
            <input type="text" class="form-control" id="supplier_vendor" name="supplier_vendor" required>
        </div>

        <div class="mb-3">
            <label for="invoice_number" class="form-label">Invoice Number</label>
            <input type="text" class="form-control" id="invoice_number" name="invoice_number">
        </div>

        <div class="mb-3">
            <label for="cost_of_asset" class="form-label">Cost of Asset</label>
            <input type="number" step="0.01" class="form-control" id="cost_of_asset" name="cost_of_asset" required>
        </div>

        <!-- Ownership & Assignment -->
        <div class="mb-3">
            <label for="assigned_to" class="form-label">Assigned To</label>
            <input type="text" class="form-control" id="assigned_to" name="assigned_to">
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" id="location" name="location">
        </div>

        <div class="mb-3">
            <label for="usage_status" class="form-label">Usage Status</label>
            <select class="form-control" id="usage_status" name="usage_status">
                <option value="Active">Active</option>
                <option value="Under Maintenance">Under Maintenance</option>
                <option value="Retired">Retired</option>
            </select>
        </div>

        <!-- Maintenance & Warranty -->
        <div class="mb-3">
            <label for="warranty_expiry_date" class="form-label">Warranty Expiry Date</label>
            <input type="date" class="form-control" id="warranty_expiry_date" name="warranty_expiry_date">
        </div>

        <div class="mb-3">
            <label for="maintenance_schedule" class="form-label">Maintenance Schedule</label>
            <input type="text" class="form-control" id="maintenance_schedule" name="maintenance_schedule">
        </div>

        <div class="mb-3">
            <label for="last_maintenance_date" class="form-label">Last Maintenance Date</label>
            <input type="date" class="form-control" id="last_maintenance_date" name="last_maintenance_date">
        </div>

        <!-- Disposal Details -->
        <div class="mb-3">
            <label for="disposal_date" class="form-label">Disposal Date</label>
            <input type="date" class="form-control" id="disposal_date" name="disposal_date">
        </div>

        <div class="mb-3">
            <label for="disposal_method" class="form-label">Disposal Method</label>
            <input type="text" class="form-control" id="disposal_method" name="disposal_method">
        </div>

        <div class="mb-3">
            <label for="resale_value" class="form-label">Resale Value</label>
            <input type="number" step="0.01" class="form-control" id="resale_value" name="resale_value">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
