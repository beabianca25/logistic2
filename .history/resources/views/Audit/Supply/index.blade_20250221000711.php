@extends('base')

@section('content')
    <div class="container">
        <h2>Supply List</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Supply Name</th>
                    <th>Stock on Hand</th>
                    <th>Remaining Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($supplies as $supply)
                    <tr data-supply-id="{{ $supply->id }}">
                        <td>{{ $supply->id }}</td>
                        <td>{{ $supply->name }}</td>
                        <td>
                            <input type="number" class="stock-input form-control" value="{{ $supply->stock_on_hand }}">
                        </td>
                        <td class="remaining-stock">{{ $supply->remaining_stock }}</td>
                        <td>
                            <button class="btn btn-primary update-stock">Update</button>
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
