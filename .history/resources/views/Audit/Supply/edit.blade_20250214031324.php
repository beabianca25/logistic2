@extends('base')

@section('content')
    <div class="container" style="font-family: sans-serif; font-size: small;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/supply') }}">Audit Management</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/supply') }}">Supply List</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Details</li>
            </ol>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Supply
                                <a href="{{ url('supply') }}" class="btn btn-primary float-end">Back</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('supply.update', $supply->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <!-- Basic Information -->
                                <div class="mb-3">
                                    <label class="form-label">Supply Name</label>
                                    <input type="text" name="supply_name" class="form-control" value="{{ $supply->supply_name }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Category</label>
                                    <input type="text" name="category" class="form-control" value="{{ $supply->category }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control">{{ $supply->description }}</textarea>
                                </div>
                                
                                <!-- Acquisition Details -->
                                <div class="mb-3">
                                    <label class="form-label">Supplier Vendor</label>
                                    <input type="text" name="supplier_vendor" class="form-control" value="{{ $supply->supplier_vendor }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Purchase Date</label>
                                    <input type="date" name="purchase_date" class="form-control" value="{{ $supply->purchase_date }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Invoice Receipt Number</label>
                                    <input type="text" name="invoice_receipt_number" class="form-control" value="{{ $supply->invoice_receipt_number }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Unit Price</label>
                                    <input type="number" step="0.01" name="unit_price" class="form-control" value="{{ $supply->unit_price }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Total Cost</label>
                                    <input type="number" step="0.01" name="total_cost" class="form-control" value="{{ $supply->total_cost }}" required>
                                </div>
                                
                                <!-- Inventory Management -->
                                <div class="mb-3">
                                    <label class="form-label">Quantity Purchased</label>
                                    <input type="number" name="quantity_purchased" class="form-control" value="{{ $supply->quantity_purchased }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Unit of Measurement</label>
                                    <input type="text" name="unit_of_measurement" class="form-control" value="{{ $supply->unit_of_measurement }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Stock on Hand</label>
                                    <input type="number" name="stock_on_hand" class="form-control" value="{{ $supply->stock_on_hand }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Reorder Level</label>
                                    <input type="number" name="reorder_level" class="form-control" value="{{ $supply->reorder_level }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Remaining Stock</label>
                                    <input type="number" name="remaining_stock" class="form-control" value="{{ $supply->remaining_stock }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Storage Location</label>
                                    <input type="text" name="storage_location" class="form-control" value="{{ $supply->storage_location }}">
                                </div>
                                
                                <!-- Usage Details -->
                                <div class="mb-3">
                                    <label class="form-label">Issued To</label>
                                    <input type="text" name="issued_to" class="form-control" value="{{ $supply->issued_to }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Date Issued</label>
                                    <input type="date" name="date_issued" class="form-control" value="{{ $supply->date_issued }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Purpose / Usage</label>
                                    <textarea name="purpose_usage" class="form-control">{{ $supply->purpose_usage }}</textarea>
                                </div>
                                
                                <!-- Condition & Maintenance -->
                                <div class="mb-3">
                                    <label class="form-label">Condition</label>
                                    <select name="condition" class="form-control">
                                        <option value="New" {{ $supply->condition == 'New' ? 'selected' : '' }}>New</option>
                                        <option value="Used" {{ $supply->condition == 'Used' ? 'selected' : '' }}>Used</option>
                                        <option value="Damaged" {{ $supply->condition == 'Damaged' ? 'selected' : '' }}>Damaged</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Expiration Date</label>
                                    <input type="date" name="expiration_date" class="form-control" value="{{ $supply->expiration_date }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Maintenance Schedule</label>
                                    <input type="text" name="maintenance_schedule" class="form-control" value="{{ $supply->maintenance_schedule }}">
                                </div>
                                
                                <button type="submit" class="btn btn-success">Update Supply</button>
                                <a href="{{ route('supply.index') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
