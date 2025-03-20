@extends('base')

@section('content')
    <div class="container mt-5">
        <h2>Edit Supply</h2>

        <form action="{{ route('supply.update', $supply->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Make sure this is present for PUT requests -->
            
            <div class="mb-3">
                <label for="supply_name" class="form-label">Supply Name</label>
                <input type="text" name="supply_name" id="supply_name" class="form-control"
                       value="{{ old('supply_name', $supply->supply_name) }}" required>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" name="category" id="category" class="form-control"
                       value="{{ old('category', $supply->category) }}" required>
            </div>

            <div class="mb-3">
                <label for="supplier_vendor" class="form-label">Supplier Vendor</label>
                <input type="text" name="supplier_vendor" id="supplier_vendor" class="form-control"
                       value="{{ old('supplier_vendor', $supply->supplier_vendor) }}" required>
            </div>

            <div class="mb-3">
                <label for="quantity_purchased" class="form-label">Quantity Purchased</label>
                <input type="number" name="quantity_purchased" id="quantity_purchased" class="form-control"
                       value="{{ old('quantity_purchased', $supply->quantity_purchased) }}" required>
            </div>

            <div class="mb-3">
                <label for="unit_of_measurement" class="form-label">Unit of Measurement</label>
                <input type="text" name="unit_of_measurement" id="unit_of_measurement" class="form-control"
                       value="{{ old('unit_of_measurement', $supply->unit_of_measurement) }}" required>
            </div>

            <div class="mb-3">
                <label for="unit_price" class="form-label">Unit Price</label>
                <input type="number" name="unit_price" id="unit_price" class="form-control"
                       value="{{ old('unit_price', $supply->unit_price) }}" required>
            </div>

            <div class="mb-3">
                <label for="total_cost" class="form-label">Total Cost</label>
                <input type="number" name="total_cost" id="total_cost" class="form-control"
                       value="{{ old('total_cost', $supply->total_cost) }}" required>
            </div>

            <div class="mb-3">
                <label for="purchase_date" class="form-label">Purchase Date</label>
                <input type="date" name="purchase_date" id="purchase_date" class="form-control"
                       value="{{ old('purchase_date', $supply->purchase_date) }}" required>
            </div>

            <div class="mb-3">
                <label for="reorder_level" class="form-label">Reorder Level</label>
                <input type="number" name="reorder_level" id="reorder_level" class="form-control"
                       value="{{ old('reorder_level', $supply->reorder_level) }}" required>
            </div>

            <div class="mb-3">
                <label for="stock_on_hand" class="form-label">Stock on Hand</label>
                <input type="number" name="stock_on_hand" id="stock_on_hand" class="form-control"
                       value="{{ old('stock_on_hand', $supply->stock_on_hand) }}" required>
            </div>

            <div class="mb-3">
                <label for="remaining_stock" class="form-label">Remaining Stock</label>
                <input type="number" name="remaining_stock" id="remaining_stock" class="form-control"
                       value="{{ old('remaining_stock', $supply->remaining_stock) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Supply</button>
            <a href="{{ route('supply.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
