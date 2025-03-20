@extends('base')

@section('content')
    <div class="container mt-5">
        <h2>Edit Supply</h2>

        <form action="{{ route('supply.update', $supply->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="supply_name" class="form-label">Supply Name</label>
                <input type="text" name="supply_name" id="supply_name" class="form-control"
                       value="{{ old('supply_name', $supply->supply_name) }}" required>
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
