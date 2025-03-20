@extends('base')

@section('content')
<div class="container" style="font-family: sans-serif; font-size: small;">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/supply') }}">Audit Management</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/supply') }}">Supply List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Show Details</li>
        </ol>
    </nav>

    <div class="container">
        <div class="row d-flex flex-wrap">
            <!-- General Information -->
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header"><h4>General Information</h4></div>
                    <div class="card-body">
                        <p><strong>Supply Name:</strong> {{ $supply->supply_name }}</p>
                        <p><strong>Category:</strong> {{ $supply->category }}</p>
                        <p><strong>Description:</strong> {{ $supply->description }}</p>
                        <p><strong>Supplier Vendor:</strong> {{ $supply->supplier_vendor }}</p>
                        <p><strong>Storage Location:</strong> {{ $supply->storage_location }}</p>
                        <p><strong>Condition:</strong> {{ $supply->condition }}</p>
                    </div>
                </div>
            </div>

            <!-- Inventory Details -->
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header"><h4>Inventory Details</h4></div>
                    <div class="card-body">
                        <p><strong>Quantity Purchased:</strong> {{ $supply->quantity_purchased }}</p>
                        <p><strong>Unit of Measurement:</strong> {{ $supply->unit_of_measurement }}</p>
                        <p><strong>Stock on Hand:</strong> {{ $supply->stock_on_hand }}</p>
                        <p><strong>Reorder Level:</strong> {{ $supply->reorder_level }}</p>
                    </div>
                </div>
            </div>

            <!-- Financial Details -->
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header"><h4>Financial Details</h4></div>
                    <div class="card-body">
                        <p><strong>Unit Price:</strong> ${{ number_format($supply->unit_price, 2) }}</p>
                        <p><strong>Total Cost:</strong> ${{ number_format($supply->total_cost, 2) }}</p>
                    </div>
                </div>
            </div>

            <!-- Transaction Details -->
            <div class="col-md-6">
                <div class="card mb-5">
                    <div class="card-header"><h4>Transaction Details</h4></div>
                    <div class="card-body">
                        <p><strong>Purchase Date:</strong> {{ $supply->purchase_date }}</p>
                        <p><strong>Invoice Receipt Number:</strong> {{ $supply->invoice_receipt_number }}</p>
                    </div>
                </div>
            </div>

            <!-- Usage & Distribution -->
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header"><h4>Usage & Distribution</h4></div>
                    <div class="card-body">
                        <p><strong>Issued To:</strong> {{ $supply->issued_to }}</p>
                        <p><strong>Date Issued:</strong> {{ $supply->date_issued }}</p>
                        <p><strong>Purpose / Usage:</strong> {{ $supply->purpose_usage }}</p>
                        <p><strong>Remaining Stock:</strong> {{ $supply->remaining_stock }}</p>
                    </div>
                </div>
            </div>

            <!-- Expiration & Maintenance -->
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header"><h4>Expiration & Maintenance</h4></div>
                    <div class="card-body">
                        <p><strong>Expiration Date:</strong> {{ $supply->expiration_date }}</p>
                        <p><strong>Maintenance Schedule:</strong> {{ $supply->maintenance_schedule }}</p>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="col-md-12 text-center mt-3">
                <a href="{{ route('supply.edit', $supply->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('supply.destroy', $supply->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this supply?');">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
