@extends('base')
@section('content')
    <div class="container" style="font-family: serif; font-size: small;">

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
                            <div class="container">
                                <!-- Trigger button for the modal -->
                                <button type="button" data-bs-toggle="modal" data-bs-target="#createAssetModal"
                                    class="btn btn-sm btn-primary float-right">
                                    Add New Asset
                                </button>
                            </div>


                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0 small-font">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
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
                                                    <td>{{ $asset->id }}</td>
                                                    <td>{{ $asset->asset_name }}</td>
                                                    <td>{{ $asset->asset_type }}</td>
                                                    <td>{{ $asset->location }}</td>
                                                    <td>{{ $asset->condition }}</td>
                                                    <td>{{ $asset->status }}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-around align-items-center">
                                                            <a href="{{ route('asset.show', $asset->id) }}" class="btn btn-info btn-sm mx-0">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            
                                                            <a href="{{ route('asset.edit', $asset->id) }}" class="btn btn-warning btn-sm mx-0">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            
                                                            <form action="{{ route('asset.destroy', $asset->id) }}" method="POST" id="deleteForm{{ $asset->id }}" class="mx-0">
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

                    <!-- Small and Cute Modal Structure -->
                    <div class="modal fade" id="createAssetModal" tabindex="-1" aria-labelledby="createAssetModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header bg-light text-dark">
                                    <h6 class="modal-title" id="createAssetModalLabel">Add New Asset</h6>
                                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body p-3">
                                    @if (session('success'))
                                        <div class="alert alert-success alert-sm p-2">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @if ($errors->any())
                                        <div class="alert alert-danger alert-sm p-2">
                                            <ul class="m-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form action="{{ route('assets.store') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="asset_name" class="form-label">Asset Name</label>
                                            <input type="text" class="form-control" id="asset_name" name="asset_name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="asset_type" class="form-label">Asset Type</label>
                                            <input type="text" class="form-control" id="asset_type" name="asset_type" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="location" class="form-label">Location</label>
                                            <input type="text" class="form-control" id="location" name="location" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="condition" class="form-label">Condition</label>
                                            <input type="text" class="form-control" id="condition" name="condition" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="acquisition_date" class="form-label">Acquisition Date</label>
                                            <input type="date" class="form-control" id="acquisition_date" name="acquisition_date" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <input type="text" class="form-control" id="status" name="status" required>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Save Asset</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Browser Usage Section -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header small">
                            <h6 class="card-title">Product Usage</h6>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body small">
                            <div class="row">
                                <!-- Pie Chart Column -->
                                <div class="col-md-12">
                                    <div class="chart-responsive">
                                        <canvas id="pieChart" height="350"></canvas>
                                    </div>
                                </div>
                                <div class="card-footer p-0">
                                    <ul class="nav nav-pills flex-column small">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                Bestlink College of the Philippines
                                                <span class="float-right text-succes">
                                                    <i class="fas fa-arrow-up text-sm"></i> 20%
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                Quezon City University
                                                <span class="float-right text-success">
                                                    <i class="fas fa-arrow-down text-sm"></i> 4%
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                Manila University
                                                <span class="float-right text-warning">
                                                    <i class="fas fa-arrow-left text-sm"></i> 0%
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
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
            </div>
        </div>
    </div>



    @if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                showConfirmButton: true,
            });
        });
    </script>
@endif


<script>
    function confirmDelete(vendorId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#d33', // Red color for delete confirmation
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form if confirmed
                document.getElementById('deleteForm' + vendorId).submit();
            }
        });
    }
</script>
@endsection
