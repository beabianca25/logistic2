<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supply List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Supply List</h2>

    @if(session('success'))
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
            @foreach($supplies as $supply)
            <tr>
                <td>{{ $supply->id }}</td>
                <td>{{ $supply->stock_on_hand }}</td>
                <td>{{ $supply->remaining_stock }}</td>
                <td>{{ $supply->reorder_level }}</td>
                <td>
                    <a href="{{ route('supply.show', $supply->id) }}" class="btn btn-info btn-sm">Show</a>
                    <a href="{{ route('supply.edit', $supply->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <!-- Delete Form -->
                    <form action="{{ route('supply.destroy', $supply->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this supply?')">Delete</button>
                    </form>

                    <!-- Update Remaining Stock Form -->
                    <form action="{{ route('supply.update', $supply->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <input type="number" name="remaining_stock" value="{{ $supply->remaining_stock }}" min="0" class="form-control d-inline w-25">
                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
