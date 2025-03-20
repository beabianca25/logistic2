@extends('base')

@section('content')
<div class="container">
    <h2>Add New Supply</h2>
    <form action="{{ route('supply.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Supply Name</label>
            <input type="text" name="supply_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Category</label>
            <input type="text" name="category" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Supplier Vendor</label>
            <input type="text" name="supplier_vendor" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Quantity Purchased</label>
            <input type="number" name="quantity_purchased" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Unit of Measurement</label>
            <input type="text" name="unit_of_measurement" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Stock on Hand</label>
            <input type="number" name="stock_on_hand" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Reorder Level</label>
            <input type="number" name="reorder_level" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Unit Price</label>
            <input type="number" step="0.01" name="unit_price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Total Cost</label>
            <input type="number" step="0.01" name="total_cost" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Purchase Date</label>
            <input type="date" name="purchase_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Invoice Receipt Number</label>
            <input type="text" name="invoice_receipt_number" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Issued To</label>
            <input type="text" name="issued_to" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Date Issued</label>
            <input type="date" name="date_issued" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Purpose / Usage</label>
            <textarea name="purpose_usage" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Remaining Stock</label>
            <input type="number" name="remaining_stock" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Storage Location</label>
            <input type="text" name="storage_location" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Condition</label>
            <select name="condition" class="form-control">
                <option value="New">New</option>
                <option value="Used">Used</option>
                <option value="Damaged">Damaged</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Expiration Date</label>
            <input type="date" name="expiration_date" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Maintenance Schedule</label>
            <input type="text" name="maintenance_schedule" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection
