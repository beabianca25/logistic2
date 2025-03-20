@extends('base')

@section('content')
<div class="container">
    <h2>Supply Details</h2>
    <a href="{{ route('supply.index') }}" class="btn btn-primary mb-3">Back to List</a>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><strong>Supply Name:</strong> {{ $supply->supply_name }}</h5>
            <p class="card-text"><strong>Category:</strong> {{ $supply->category }}</p>
            <p class="card-text"><strong>Description:</strong> {{ $supply->description }}</p>
            <p class="card-text"><strong>Supplier Vendor:</strong> {{ $supply->supplier_vendor }}</p>
            <p class="card-text"><strong>Quantity Purchased:</strong> {{ $supply->quantity_purchased }}</p>
            <p class="card-text"><strong>Unit of Measurement:</strong> {{ $supply->unit_of_measurement }}</p>
            <p class="card-text"><strong>Stock on Hand:</strong> {{ $supply->stock_on_hand }}</p>
            <p class="card-text"><strong>Reorder Level:</strong> {{ $supply->reorder_level }}</p>
            <p class="card-text"><strong>Unit Price:</strong> ${{ number_format($supply->unit_price, 2) }}</p>
            <p class="card-text"><strong>Total Cost:</strong> ${{ number_format($supply->total_cost, 2) }}</p>
            <p class="card-text"><strong>Purchase Date:</strong> {{ $supply->purchase_date }}</p>
            <p class="card-text"><strong>Invoice Receipt Number:</strong> {{ $supply->invoice_receipt_number }}</p>
            <p class="card-text"><strong>Issued To:</strong> {{ $supply->issued_to }}</p>
            <p class="card-text"><strong>Date Issued:</strong> {{ $supply->date_issued }}</p>
            <p class="card-text"><strong>Purpose / Usage:</strong> {{ $supply->purpose_usage }}</p>
            <p class="card-text"><strong>Remaining Stock:</strong> {{ $supply->remaining_stock }}</p>
            <p class="card-text"><strong>Storage Location:</strong> {{ $supply->storage_location }}</p>
            <p class="card-text"><strong>Condition:</strong> {{ $supply->condition }}</p>
            <p class="card-text"><strong>Expiration Date:</strong> {{ $supply->expiration_date }}</p>
            <p class="card-text"><strong>Maintenance Schedule:</strong> {{ $supply->maintenance_schedule }}</p>

            <a href="{{ route('supplies.edit', $supply->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('supplies.destroy', $supply->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this supply?');">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
