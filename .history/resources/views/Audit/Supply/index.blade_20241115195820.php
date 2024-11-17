@extends('base')
@section('content')
    <div class="container" style="font-family: sans-serif; font-size: small;">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/supply') }}">Audit Management</a></li>
                <li class="breadcrumb-item active" aria-current="page">Supply List</li>
            </ol>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Supply List</h3>
                            <div class="container">
                                <!-- Trigger button for the modal -->
                                <button type="button" data-bs-toggle="modal" data-bs-target="#createSupplyModal"
                                    class="btn btn-sm btn-primary float-right">
                                    Add New Supply
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
                                                <th>Category</th>
                                                <th>Quantity</th>
                                                <th>Audit Date</th>
                                                <th>Location</th>
                                                <th>Condition</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($supplies as $supply)
                                                <tr>
                                                    <td>{{ str_pad(strtoupper(dechex($supply->id)), 4, '0', STR_PAD_LEFT) }}</td>
                                                    <td>{{ $supply->supply_name }}</td>
                                                    <td>{{ $supply->category }}</td>
                                                    <td>{{ $supply->quantity }}</td>
                                                    <td>{{ $supply->audit_date }}</td>
                                                    <td>{{ $supply->location }}</td>
                                                    <td>{{ $supply->condition }}</td>
                                                    <td>{{ $supply->status }}</td>
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

                    <!-- Small and Cute Modal Structure -->
                    <div class="modal fade" id="createSupplyModal" tabindex="-1" aria-labelledby="createSupplyModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header bg-light text-dark">
                                    <h6 class="modal-title" id="createSupplyModalLabel">Add New Supply</h6>
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

                                    <form action="{{ route('supply.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-2">
                                            <label class="form-label-sm">Supply Name:</label>
                                            <input type="text" name="supply_name" class="form-control form-control-sm"
                                                required>
                                        </div>

                                        <div class="mb-2">
                                            <label class="form-label-sm">Category:</label>
                                            <input type="text" name="category" class="form-control form-control-sm"
                                                required>
                                        </div>

                                        <div class="mb-2">
                                            <label class="form-label-sm">Quantity:</label>
                                            <input type="number" name="quantity" class="form-control form-control-sm"
                                                required>
                                        </div>

                                        <div class="mb-2">
                                            <label class="form-label-sm">Audit Date:</label>
                                            <input type="date" name="audit_date" class="form-control form-control-sm"
                                                required>
                                        </div>

                                        <div class="mb-2">
                                            <label class="form-label-sm">Location:</label>
                                            <input type="text" name="location" class="form-control form-control-sm"
                                                required>
                                        </div>

                                        <div class="mb-2">
                                            <label class="form-label-sm">Condition:</label>
                                            <input type="text" name="condition" class="form-control form-control-sm"
                                                required>
                                        </div>

                                        <div class="mb-2">
                                            <label class="form-label-sm">Status:</label>
                                            <input type="text" name="status" class="form-control form-control-sm"
                                                required>
                                        </div>

                                        <div class="mb-2">
                                            <label class="form-label-sm">Remarks:</label>
                                            <textarea name="remarks" class="form-control form-control-sm"></textarea>
                                        </div>

                                        <div class="mb-2">
                                            <label class="form-label-sm">Auditor Name:</label>
                                            <input type="text" name="auditor_name" class="form-control form-control-sm"
                                                required>
                                        </div>

                                        <div class="mb-2">
                                            <label class="form-label-sm">Attachment:</label>
                                            <input type="file" name="attachment" class="form-control form-control-sm">
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-sm w-100 mt-2">Save</button>
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
