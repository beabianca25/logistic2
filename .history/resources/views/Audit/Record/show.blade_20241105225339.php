@extends('base')

@section('content')
    <div class="container" style="font-family: serif; font-size: small;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/record') }}">Audit Management</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/record') }}">Supply List</a></li>
                <li class="breadcrumb-item active" aria-current="page">Show Details</li>
            </ol>
        </nav>
        <div class="container">
            <div class="row">
                <!-- Audit Details Section -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Record Details
                                <a href="{{ url('record') }}" class="btn btn-primary float-end">Back</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Auditor Name: {{ $record->auditor_name }}</h5>
                            <p class="card-text"><strong>Audit Type:</strong> {{ ucfirst($record->audit_type) }}</p>
                            <p class="card-text"><strong>Item or Asset Name:</strong> {{ $record->item_or_asset_name }}
                            </p>
                            <p class="card-text"><strong>Condition:</strong> {{ $record->condition }}</p>
                            <p class="card-text"><strong>Notes:</strong> {{ $record->notes }}</p>
                            <p class="card-text"><strong>Audit Date:</strong>
                                {{ \Carbon\Carbon::parse($record->audit_date)->format('d M Y') }}</p>
                            <p class="card-text"><strong>Status:</strong> {{ $record->status }}</p>
                            <p class="card-text"><strong>Actions Taken:</strong> {{ $record->actions_taken }}</p>

                        </div>
                    </div>
                </div>


                <!-- Browser Usage Section -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Browser Usage</h3>
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
                            <div class="row">
                                <!-- Pie Chart Column -->
                                <div class="col-md-12">
                                    <div class="chart-responsive">
                                        <canvas id="pieChart" height="250"></canvas>
                                    </div>
                                </div>
                                <div class="card-footer p-0">
                                    <ul class="nav nav-pills flex-column">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                United States of America
                                                <span class="float-right text-danger">
                                                    <i class="fas fa-arrow-down text-sm"></i>
                                                    12%</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                India
                                                <span class="float-right text-success">
                                                    <i class="fas fa-arrow-up text-sm"></i> 4%
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                China
                                                <span class="float-right text-warning">
                                                    <i class="fas fa-arrow-left text-sm"></i> 0%
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.footer -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   

    <script>
        $(document).ready(function() {
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
            var pieData = {
                labels: [
                    'Vehicle',
                    'Storage Merchandise',
                    'Event Materials',
                    'Equipments',
                    'Office Supplies',
                    'Tour Supplies'
                ],
                datasets: [{
                    data: [700, 500, 400, 600, 300, 100],
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de']
                }]
            };
            var pieOptions = {
                legend: {
                    display: true
                }
            };
            var pieChart = new Chart(pieChartCanvas, {
                type: 'doughnut',
                data: pieData,
                options: pieOptions
            });
        });
    </script>
@endsection
