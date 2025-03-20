@extends('base')
@section('content')
    <div class="container" style="font-family: sans-serif; font-size: small;">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/assets') }}">Audit Management</a></li>
                <li class="breadcrumb-item active" aria-current="page">Asset List</li>
            </ol>
        </nav>

        <div class="container">
            <div class="row">
                <!-- Asset List Table -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Asset List</h3>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#createAssetModal" class="btn btn-sm btn-primary float-right">
                                <i class="fas fa-plus"></i> Add New Asset
                            </button>
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0 small-font">
                                    <thead>
                                        <tr>
                                            <th>Audit ID</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Location</th>
                                            <th>Condition</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($assets as $asset)
                                            <tr>
                                                <td>{{ str_pad(strtoupper(dechex($asset->id)), 4, '0', STR_PAD_LEFT) }}</td>
                                                <td>{{ $asset->asset_name }}</td>
                                                <td>{{ $asset->asset_type }}</td>
                                                <td>{{ $asset->location }}</td>
                                                <td>{{ $asset->condition }}</td>
                                                <td>{{ ucfirst($asset->status) }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-around align-items-center">
                                                        <a href="{{ route('assets.show', $asset->id) }}" class="btn btn-info btn-sm mx-0">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('assets.edit', $asset->id) }}" class="btn btn-warning btn-sm mx-0">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" id="deleteForm{{ $asset->id }}" class="mx-0">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $asset->id }})">
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

                <!-- Stock Distribution Chart -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Stock Distribution</h3>
                        </div>
                        <div class="card-body d-flex justify-content-center">
                            <canvas id="stockChart" height="500"></canvas>
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
        
        function confirmDelete(assetId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm' + assetId).submit();
                }
            });
        }
    </script>
@endsection
