@extends('base')

@section('content')
    <div class="container" style="font-family: sans-serif; font-size: small;">
        
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/supplies') }}">Inventory Management</a></li>
                <li class="breadcrumb-item active" aria-current="page">Supply List</li>
            </ol>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Supply List</h3>
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
                                            <th>Stock on Hand</th>
                                            <th>Remaining Stock</th>
                                            <th>Reorder Level</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($supplies as $supply)
                                            <tr>
                                                <td>{{ str_pad(strtoupper(dechex($supply->id)), 4, '0', STR_PAD_LEFT) }}</td>
                                                <td>{{ $supply->supply_name }}</td>
                                                <td>{{ $supply->stock_on_hand }}</td>
                                                <td>{{ $supply->remaining_stock }}</td>
                                                <td>{{ $supply->reorder_level }}</td>
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

                                                        <form action="{{ route('supply.update', $supply->id) }}" method="POST" class="mx-0 d-flex">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="number" name="remaining_stock" value="{{ $supply->remaining_stock }}" min="0" class="form-control form-control-sm w-50">
                                                            <button type="submit" class="btn btn-primary btn-sm mx-1">
                                                                <i class="fas fa-sync-alt"></i>
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

                <!-- Sidebar for Stock Distribution Chart -->
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

    <!-- JavaScript for Delete Confirmation -->
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

        // Stock Chart Initialization
        $(document).ready(function () {
        var stockChartCanvas = $('#stockChart').get(0).getContext('2d');
        
        // Initial dummy data
        var stockChart = new Chart(stockChartCanvas, {
            type: 'doughnut',
            data: {
                labels: [],
                datasets: [{
                    data: [],
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc']
                }]
            },
            options: { legend: { display: true } }
        });

        function fetchStockData() {
            $.ajax({
                url: "{{ url('/api/stock-distribution') }}",
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    stockChart.data.labels = response.labels;
                    stockChart.data.datasets[0].data = response.data;
                    stockChart.update();
                },
                error: function () {
                    console.error("Failed to fetch stock data.");
                }
            });
        }

        // Fetch data immediately and then every 5 seconds
        fetchStockData();
        setInterval(fetchStockData, 5000);
    });
    </script>
@endsection
