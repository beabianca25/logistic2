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
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Supply Details
                                <a href="{{ route('supply.index') }}" class="btn btn-primary float-end">Back</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><strong>Supply Name:</strong> {{ $supply->supply_name }}</h5>
                            
                            <!-- General Information -->
                            <h6 class="mt-3">General Information</h6>
                            <p><strong>Category:</strong> {{ $supply->category }}</p>
                            <p><strong>Description:</strong> {{ $supply->description }}</p>
                            <p><strong>Supplier Vendor:</strong> {{ $supply->supplier_vendor }}</p>
                            
                            <!-- Inventory Details -->
                            <h6 class="mt-3">Inventory Details</h6>
                            <p><strong>Quantity Purchased:</strong> {{ $supply->quantity_purchased }}</p>
                            <p><strong>Unit of Measurement:</strong> {{ $supply->unit_of_measurement }}</p>
                            <p><strong>Stock on Hand:</strong> {{ $supply->stock_on_hand }}</p>
                            <p><strong>Reorder Level:</strong> {{ $supply->reorder_level }}</p>
                            
                            <!-- Financial Details -->
                            <h6 class="mt-3">Financial Details</h6>
                            <p><strong>Unit Price:</strong> ${{ number_format($supply->unit_price, 2) }}</p>
                            <p><strong>Total Cost:</strong> ${{ number_format($supply->total_cost, 2) }}</p>
                            
                            <!-- Transaction Details -->
                            <h6 class="mt-3">Transaction Details</h6>
                            <p><strong>Purchase Date:</strong> {{ $supply->purchase_date }}</p>
                            <p><strong>Invoice Receipt Number:</strong> {{ $supply->invoice_receipt_number }}</p>
                            
                            <!-- Usage & Distribution -->
                            <h6 class="mt-3">Usage & Distribution</h6>
                            <p><strong>Issued To:</strong> {{ $supply->issued_to }}</p>
                            <p><strong>Date Issued:</strong> {{ $supply->date_issued }}</p>
                            <p><strong>Purpose / Usage:</strong> {{ $supply->purpose_usage }}</p>
                            <p><strong>Remaining Stock:</strong> {{ $supply->remaining_stock }}</p>
                            
                            <!-- Storage & Condition -->
                            <h6 class="mt-3">Storage & Condition</h6>
                            <p><strong>Storage Location:</strong> {{ $supply->storage_location }}</p>
                            <p><strong>Condition:</strong> {{ $supply->condition }}</p>
                            <p><strong>Expiration Date:</strong> {{ $supply->expiration_date }}</p>
                            
                            <!-- Maintenance -->
                            <h6 class="mt-3">Maintenance</h6>
                            <p><strong>Maintenance Schedule:</strong> {{ $supply->maintenance_schedule }}</p>
                            
                            <!-- Actions -->
                            <div class="mt-4">
                                <a href="{{ route('supply.edit', $supply->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('supply.destroy', $supply->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this supply?');">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Stock Distribution</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-responsive">
                                <canvas id="stockChart" height="250"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
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
                legend: { display: true }
            };
            var stockChart = new Chart(stockChartCanvas, {
                type: 'doughnut',
                data: stockData,
                options: stockOptions
            });
        });
    </script>
@endsection
