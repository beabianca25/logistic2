@extends('base')

@section('content')
    <div class="container">

        <body>
            <div class="container mt-5">
                <h2 class="mb-4">Create New Supply</h2>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('supply.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="supply_name" class="form-label">Supply Name:</label>
                                <input type="text" id="supply_name" name="supply_name" class="form-control"
                                    value="{{ old('supply_name') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="category" class="form-label">Category:</label>
                                <input type="text" id="category" name="category" class="form-control"
                                    value="{{ old('category') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description:</label>
                                <textarea id="description" name="description" class="form-control">{{ old('description') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="supplier_vendor" class="form-label">Supplier/Vendor:</label>
                                <input type="text" id="supplier_vendor" name="supplier_vendor" class="form-control"
                                    value="{{ old('supplier_vendor') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="quantity_purchased" class="form-label">Quantity Purchased:</label>
                                <input type="number" id="quantity_purchased" name="quantity_purchased" class="form-control"
                                    value="{{ old('quantity_purchased') }}" min="1" required>
                            </div>

                            <div class="mb-3">
                                <label for="unit_of_measurement" class="form-label">Unit of Measurement:</label>
                                <input type="text" id="unit_of_measurement" name="unit_of_measurement"
                                    class="form-control" value="{{ old('unit_of_measurement') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="stock_on_hand" class="form-label">Stock on Hand:</label>
                                <input type="number" id="stock_on_hand" name="stock_on_hand" class="form-control"
                                    value="{{ old('stock_on_hand') }}" min="0" required>
                            </div>

                            <div class="mb-3">
                                <label for="remaining_stock" class="form-label">Remaining Stock:</label>
                                <input type="number" id="remaining_stock" name="remaining_stock" class="form-control"
                                    value="{{ old('remaining_stock') }}" min="0" required>
                            </div>

                            <div class="mb-3">
                                <label for="reorder_level" class="form-label">Reorder Level:</label>
                                <input type="number" id="reorder_level" name="reorder_level" class="form-control"
                                    value="{{ old('reorder_level', 5) }}" min="0" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="unit_price" class="form-label">Unit Price:</label>
                                <input type="number" step="0.01" id="unit_price" name="unit_price" class="form-control"
                                    value="{{ old('unit_price') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="total_cost" class="form-label">Total Cost:</label>
                                <input type="number" step="0.01" id="total_cost" name="total_cost" class="form-control"
                                    value="{{ old('total_cost') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="purchase_date" class="form-label">Purchase Date:</label>
                                <input type="date" id="purchase_date" name="purchase_date" class="form-control"
                                    value="{{ old('purchase_date') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="invoice_receipt_number" class="form-label">Invoice/Receipt Number:</label>
                                <input type="text" id="invoice_receipt_number" name="invoice_receipt_number"
                                    class="form-control" value="{{ old('invoice_receipt_number') }}">
                            </div>

                            <div class="mb-3">
                                <label for="issued_to" class="form-label">Issued To:</label>
                                <input type="text" id="issued_to" name="issued_to" class="form-control"
                                    value="{{ old('issued_to') }}">
                            </div>

                            <div class="mb-3">
                                <label for="date_issued" class="form-label">Date Issued:</label>
                                <input type="date" id="date_issued" name="date_issued" class="form-control"
                                    value="{{ old('date_issued') }}">
                            </div>

                            <div class="mb-3">
                                <label for="purpose_usage" class="form-label">Purpose/Usage:</label>
                                <textarea id="purpose_usage" name="purpose_usage" class="form-control">{{ old('purpose_usage') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="storage_location" class="form-label">Storage Location:</label>
                                <input type="text" id="storage_location" name="storage_location" class="form-control"
                                    value="{{ old('storage_location') }}">
                            </div>

                            <div class="mb-3">
                                <label for="condition" class="form-label">Condition:</label>
                                <select id="condition" name="condition" class="form-control">
                                    <option value="New" {{ old('condition') == 'New' ? 'selected' : '' }}>New</option>
                                    <option value="Used" {{ old('condition') == 'Used' ? 'selected' : '' }}>Used
                                    </option>
                                    <option value="Damaged" {{ old('condition') == 'Damaged' ? 'selected' : '' }}>Damaged
                                    </option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="expiration_date" class="form-label">Expiration Date:</label>
                                <input type="date" id="expiration_date" name="expiration_date" class="form-control"
                                    value="{{ old('expiration_date') }}">
                            </div>

                            <div class="mb-3">
                                <label for="maintenance_schedule" class="form-label">Maintenance Schedule:</label>
                                <input type="text" id="maintenance_schedule" name="maintenance_schedule"
                                    class="form-control" value="{{ old('maintenance_schedule') }}">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('supply.index') }}" class="btn btn-secondary">Back to List</a>
                        <button type="submit" class="btn btn-primary">Create Supply</button>
                    </div>
                </form>
            </div>
        </body>
    </div>
@endsection
