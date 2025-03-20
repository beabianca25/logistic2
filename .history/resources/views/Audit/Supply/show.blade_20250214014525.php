    @extends('base')

    @section('content')
        <div class="container" style="font-family: sans-serif; font-size: small;">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/supply') }}">Audit Management</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/supply') }}">Supply List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Show Details</li>
                </ol>
            </nav>

            <div class="container">
                <div class="row">
                    <!-- General Information Section -->
                    <div class="col-md-6">
                        <div class="card mb-6">
                            <div class="card-header">
                                <h4>General Information</h4>
                            </div>
                            <div class="card-body row">
                                <div class="col-md-6">
                                    <p><strong>Supply Name:</strong> {{ $supply->supply_name }}</p>
                                    <p><strong>Category:</strong> {{ $supply->category }}</p>
                                    <p><strong>Description:</strong> {{ $supply->description }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Supplier Vendor:</strong> {{ $supply->supplier_vendor }}</p>
                                    <p><strong>Storage Location:</strong> {{ $supply->storage_location }}</p>
                                    <p><strong>Condition:</strong> {{ $supply->condition }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Inventory & Financial Details -->
                    <div class="col-md-6">
                        <div class="card mb-6">
                            <div class="card-header">
                                <h4>Inventory Details</h4>
                            </div>
                            <div class="col-md-5">
                                <p><strong>Quantity Purchased:</strong> {{ $supply->quantity_purchased }}</p>
                                <p><strong>Unit of Measurement:</strong> {{ $supply->unit_of_measurement }}</p>
                                <p><strong>Stock on Hand:</strong> {{ $supply->stock_on_hand }}</p>
                                <p><strong>Reorder Level:</strong> {{ $supply->reorder_level }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Financial Details</h4>
                            </div>
                            <div class="card-body">
                                <p><strong>Unit Price:</strong> ${{ number_format($supply->unit_price, 2) }}</p>
                                <p><strong>Total Cost:</strong> ${{ number_format($supply->total_cost, 2) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Transaction Details -->
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Transaction Details</h4>
                            </div>
                            <div class="card-body">
                                <p><strong>Purchase Date:</strong> {{ $supply->purchase_date }}</p>
                                <p><strong>Invoice Receipt Number:</strong> {{ $supply->invoice_receipt_number }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Usage & Distribution -->
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Usage & Distribution</h4>
                            </div>
                            <div class="card-body row">
                                <div class="col-md-6">
                                    <p><strong>Issued To:</strong> {{ $supply->issued_to }}</p>
                                    <p><strong>Date Issued:</strong> {{ $supply->date_issued }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Purpose / Usage:</strong> {{ $supply->purpose_usage }}</p>
                                    <p><strong>Remaining Stock:</strong> {{ $supply->remaining_stock }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Expiration & Maintenance -->
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Expiration & Maintenance</h4>
                            </div>
                            <div class="card-body">
                                <p><strong>Expiration Date:</strong> {{ $supply->expiration_date }}</p>
                                <p><strong>Maintenance Schedule:</strong> {{ $supply->maintenance_schedule }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="col-md-12 text-center mt-3">
                        <a href="{{ route('supply.edit', $supply->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('supply.destroy', $supply->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this supply?');">Delete</button>
                        </form>
                    </div>

                    {{-- <!-- Stock Distribution Chart -->
                <div class="col-md-12 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Stock Distribution</h3>
                        </div>
                        <div class="card-body">
                            <div class="chart-responsive">
                                <canvas id="stockChart" height="250"></canvas>
                            </div>
                        </div>
                    </div>
                </div> --}}

                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                var stockChartCanvas = $('#stockChart').get(0).getContext('2d');
                var stockData = {
                    labels: [
                        'Warehouse A',
                        'Warehouse B',
                        'Office Supplies',
                        'Event Materials',
                        'Emergency Stock'
                    ],
                    datasets: [{
                        data: [300, 200, 150, 100, 50],
                        backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc']
                    }]
                };
                var stockOptions = {
                    legend: {
                        display: true
                    }
                };
                new Chart(stockChartCanvas, {
                    type: 'doughnut',
                    data: stockData,
                    options: stockOptions
                });
            });
        </script>
    @endsection
