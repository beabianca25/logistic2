@extends('base')

@section('content')
<div class="container">
    <h2>Supplies List</h2>
    <a href="{{ route('supply.create') }}" class="btn btn-primary mb-3">Add New Supply</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Supply Name</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total Cost</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($supplies as $supply)
            <tr>
                <td>{{ $supply->id }}</td>
                <td>{{ $supply->supply_name }}</td>
                <td>{{ $supply->category }}</td>
                <td>{{ $supply->quantity_purchased }}</td>
                <td>{{ $supply->unit_price }}</td>
                <td>{{ $supply->total_cost }}</td>
                <td>
                    <a href="{{ route('supplies.show', $supply->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('supplies.edit', $supply->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('supplies.destroy', $supply->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
