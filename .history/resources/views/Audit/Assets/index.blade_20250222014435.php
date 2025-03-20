@extends('base')

@section('content')
    <div class="container" style="font-family: sans-serif; font-size: small;">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/assets') }}">Audit Management</a></li>
                <li class="breadcrumb-item active" aria-current="page">Asset List</li>
            </ol>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Asset List</h3>
                            <a href="{{ route('assets.create') }}" class="btn btn-sm btn-primary float-right">
                                <i class="fas fa-plus"></i> Add New Asset
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
                                <table class="table table-bordered small-font">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Assigned To</th>
                                            <th>Status</th>
                                            <th>Warranty</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($assets as $asset)
                                            <tr>
                                                <td>{{ str_pad(strtoupper(dechex($asset->id)), 4, '0', STR_PAD_LEFT) }}</td>
                                                <td>{{ $asset->asset_name }}</td>
                                                <td>{{ $asset->asset_category }}</td>
                                                <td>{{ $asset->assigned_to ?? 'Unassigned' }}</td>
                                                <td>{{ $asset->usage_status }}</td>

                                                <!-- Warranty Status -->
                                                <td>
                                                    @if ($asset->warranty_expiry_date)
                                                        @if (now()->greaterThan($asset->warranty_expiry_date))
                                                            <span class="badge bg-danger">Expired</span>
                                                        @else
                                                            <span class="badge bg-success">Valid</span>
                                                        @endif
                                                    @else
                                                        <span class="badge bg-secondary">No Warranty</span>
                                                    @endif
                                                </td>

                                                <!-- Actions -->
                                                <td>
                                                    <div class="d-flex justify-content-around align-items-center">
                                                        <a href="{{ route('assets.show', $asset->id) }}" class="btn btn-info btn-sm mx-1">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('assets.edit', $asset->id) }}" class="btn btn-warning btn-sm mx-1">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-danger btn-sm mx-1" onclick="confirmDelete({{ $asset->id }})">
                                                            <i class="fas fa-trash"></i>
                                                        </button>

                                                        <!-- Usage Status Dropdown -->
                                                        <form action="{{ route('assets.update', $asset->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PUT')
                                                            <select name="usage_status" class="form-control d-inline w-50">
                                                                <option value="Active" {{ $asset->usage_status == 'Active' ? 'selected' : '' }}>Active</option>
                                                                <option value="Under Maintenance" {{ $asset->usage_status == 'Under Maintenance' ? 'selected' : '' }}>Under Maintenance</option>
                                                                <option value="Retired" {{ $asset->usage_status == 'Retired' ? 'selected' : '' }}>Retired</option>
                                                            </select>
                                                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                                        </form>

                                                        <!-- Delete Form -->
                                                        <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" id="deleteForm{{ $asset->id }}" class="d-none">
                                                            @csrf
                                                            @method('DELETE')
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

                <!-- Right Panel (Stock Distribution Chart) -->
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

    <!-- Delete Confirmation -->
    <script>
        function confirmDelete(assetId) {
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
                    document.getElementById('deleteForm' + assetId).submit();
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
