@extends('base')

@section('content')

    <div class="container mt-5">
        <h2>Supply List</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Button to Add New Supply -->
        <a href="{{ route('supply.create') }}" class="btn btn-success mb-3">Add New Supply</a>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Stock on Hand</th>
                    <th>Remaining Stock</th>
                    <th>Reorder Level</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($supplies as $supply)
                    <tr>
                        <td>{{ $supply->id }}</td>
                        <td>{{ $supply->stock_on_hand }}</td>
                        <td>{{ $supply->remaining_stock }}</td> <!-- Correctly displaying the remaining stock -->
                        <td>{{ $supply->reorder_level }}</td>
                        <td>
                            <a href="{{ route('supply.show', $supply->id) }}" class="btn btn-info btn-sm">Show</a>
                            <a href="{{ route('supply.edit', $supply->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <!-- Delete Form -->
                            <form action="{{ route('supply.destroy', $supply->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this supply?')">Delete</button>
                            </form>

                            <!-- Update Remaining Stock Form -->
                            <form action="{{ route('supply.update', $supply->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="remaining_stock">Remaining Stock</label>
                                    <input type="number" name="remaining_stock" value="{{ old('remaining_stock', $supply->remaining_stock) }}" min="0" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
