@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Asset</h2>
    <form action="{{ route('assets.store') }}" method="POST">
        @csrf
        <!-- Basic Information -->
        <div class="mb-3">
            <label class="form-label">Asset Name</label>
            <input type="text" name="asset_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Category</label>
            <input type="text" name="asset_category" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Asset Tag</label>
            <input type="text" name="asset_tag" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <!-- Acquisition Details -->
        <div class="mb-3">
            <label class="form-label">Purchase Date</label>
            <input type="date" name="purchase_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Supplier Vendor</label>
            <input type="text" name="supplier_vendor" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Invoice Number</label>
            <input type="text" name="invoice_number" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Cost of Asset</label>
            <input type="number" step="0.01" name="cost_of_asset" class="form-control" required>
        </div>

        <!-- Ownership & Assignment -->
        <div class="mb-3">
            <label class="form-label">Assigned To</label>
            <input type="text" name="assigned_to" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Location</label>
            <input type="text" name="location" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Usage Status</label>
            <select name="usage_status" class="form-control">
                <option value="Active">Active</option>
                <option value="Under Maintenance">Under Maintenance</option>
                <option value="Retired">Retired</option>
            </select>
        </div>

        <!-- Maintenance & Warranty -->
        <div class="mb-3">
            <label class="form-label">Warranty Expiry Date</label>
            <input type="date" name="warranty_expiry_date" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Maintenance Schedule</label>
            <input type="text" name="maintenance_schedule" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Last Maintenance Date</label>
            <input type="date" name="last_maintenance_date" class="form-control">
        </div>

        <!-- Disposal Details -->
        <div class="mb-3">
            <label class="form-label">Disposal Date</label>
            <input type="date" name="disposal_date" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Disposal Method</label>
            <input type="text" name="disposal_method" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Resale Value</label>
            <input type="number" step="0.01" name="resale_value" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Save Asset</button>
    </form>
</div>
@endsection
