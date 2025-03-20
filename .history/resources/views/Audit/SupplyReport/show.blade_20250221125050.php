@extends('base')

@section('content')
    <div class="container">
        <a href="{{ route('supply.index') }}" class="btn btn-outline-secondary mb-3">Back</a>

        <h2 class="mb-4">Supply Details</h2>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $supply->supply_name }}</h5>
                <p class="card-text"><strong>Category:</strong> {{ $supply->category }}</p>
                <p class="card-text"><strong>Description:</strong> {{ $supply->description }}</p>
                <p class="card-text"><strong>Supplier Vendor:</strong> {{ $supply->supplier_vendor }}</p>
                <p class="card-text"><strong>Quantity Purchased:</strong> {{ $supply->quantity_purchased }}</p>
                <p class="card-text"><strong>Unit Price:</strong> {{ $supply->unit_price }}</p>
                <p class="card-text"><strong>Total Cost:</strong> {{ $supply->total_cost }}</p>
                <p class="card-text"><strong>Unit of Measurement:</strong> {{ $supply->unit_of_measurement }}</p>
                <p class="card-text"><strong>Purchase Date:</strong> {{ $supply->purchase_date }}</p>
                <p class="card-text"><strong>Stock on Hand:</strong> {{ $supply->stock_on_hand }}</p>
                <p class="card-text"><strong>Remaining Stock:</strong> {{ $supply->remaining_stock }}</p>
                <p class="card-text"><strong>Reorder Level:</strong> {{ $supply->reorder_level }}</p>
                <p class="card-text"><strong>Storage Location:</strong> {{ $supply->storage_location }}</p>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('supply.edit', $supply->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('supply.destroy', $supply->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>
@endsection
