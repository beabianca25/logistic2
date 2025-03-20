@extends('base')
@section('content')
    <div class="container" style="font-family: sans-serif; font-size: small;">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/supplies') }}">Audit Management</a></li>
                <li class="breadcrumb-item active" aria-current="page">Supplies List</li>
            </ol>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Supplies List</h3>
                            <a href="{{ route('supply.create') }}" class="btn btn-sm btn-primary float-right">
                                <i class="fas fa-plus"></i> Add New Supply
                            </a>
                            @if (session('success'))
                                <script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: '{{ session('success') }}',
                                        timer: 3000,
                                        showConfirmButton: false
                                    });
                                </script>
                            @endif
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0 small-font">
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
                                        @foreach ($supplies as $supply)
                                            <tr>
                                                <td>{{ str_pad(strtoupper(dechex($supply->id)), 4, '0', STR_PAD_LEFT) }}</td>
                                                <td>{{ $supply->supply_name }}</td>
                                                <td>{{ $supply->category }}</td>
                                                <td>{{ $supply->quantity_purchased }}</td>
                                                <td>{{ $supply->unit_price }}</td>
                                                <td>{{ $supply->total_cost }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-around align-items-center">
                                                        <a href="{{ route('supply.show', $supply->id) }}" class="btn btn-info btn-sm mx-0">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('supply.edit', $supply->id) }}" class="btn btn-warning btn-sm mx-0">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('supply.destroy', $supply->id) }}" method="POST" id="deleteForm{{ $supply->id }}" class="mx-0">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $supply->id }})">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Stock Distribution</h3>
                        </div>
                        <div class="card-body d-flex justify-content-center">
                            <canvas id="stockChart" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function confirmDelete(supplyId) {
            Swal.fire({
                title: "Are you sure?",
                text: "This action cannot be undone!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm' + supplyId).submit();
                }
            });
        }

        $(document).ready(function() {
            var stockChartCanvas = $('#stockChart').get(0).getContext('2d');
            var stockData = {
                labels: ['Warehouse A', 'Warehouse B', 'Office Supplies', 'Event Materials', 'Emergency Stock'],
                datasets: [{
                    data: [300, 200, 150, 100, 50],
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc']
                }]
            };
            var stockOptions = { legend: { display: true } };
            new Chart(stockChartCanvas, { type: 'doughnut', data: stockData, options: stockOptions });
        });
    </script>
@endsection
