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
                    <th>Supply Name</th>
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
                        <td>{{ $supply->supply_name }}</td>
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
                            <form action="{{ route('supply.update', $supply->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="number" name="remaining_stock" value="{{ $supply->remaining_stock }}"
                                    min="0" class="form-control d-inline w-25">
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".update-stock").forEach(button => {
        button.addEventListener("click", function () {
            let row = this.closest("tr");
            let stockInput = row.querySelector(".stock-input");
            let remainingStockCell = row.querySelector(".remaining-stock");

            let stockOnHand = stockInput.value;
            let supplyId = row.dataset.supplyId;

            fetch(`/supply/${supplyId}`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: JSON.stringify({ stock_on_hand: stockOnHand })
            })
            .then(response => response.json())
            .then(data => {
                remainingStockCell.textContent = data.remaining_stock;
                alert(data.message);
            })
            .catch(error => console.error("Error:", error));
        });
    });
});

</script>

@endsection
