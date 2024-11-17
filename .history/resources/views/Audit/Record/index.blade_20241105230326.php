@extends('base')
@section('content')
    <div class="container" style="font-family: serif; font-size: small;">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/record') }}">Audit Management</a></li>
                <li class="breadcrumb-item active" aria-current="page">Record List</li>
            </ol>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Record List</h3>
                            <div class="container">
                                <!-- Trigger button for the modal -->
                                <button type="button" data-bs-toggle="modal" data-bs-target="#createRecordModal"
                                    class="btn btn-sm btn-primary float-right">
                                    Add New Record
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
                                                <th>Auditor Name</th>
                                                <th>Audit Type</th>
                                                <th>Item/Asset</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($records as $record)
                                                <tr>
                                                    <td>{{ $record->id }}</td>
                                                    <td>{{ $record->auditor_name }}</td>
                                                    <td>{{ ucfirst($record->audit_type) }}</td>
                                                    <td>{{ $record->item_or_asset_name }}</td>
                                                    <td>{{ $record->audit_date }}</td>
                                                    <td>{{ $record->status }}</td>
                                                    <td>
                                                        <a href="{{ route('record.show', $record->id) }}"
                                                            class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                        <a href="{{ route('record.edit', $record->id) }}"
                                                            class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                            <form action="{{ route('record.destroy', $record->id) }}"
                                                                method="POST" id="deleteForm{{ $record->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-danger btn-sm"
                                                                    onclick="confirmDelete({{ $record->id }})"><i
                                                                        class="fas fa-trash"></i></button>
                                                            </form>
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
                    <div class="modal fade" id="createRecordModal" tabindex="-1" aria-labelledby="createRecordModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header bg-light text-dark">
                                    <h6 class="modal-title" id="createRecordModalLabel">Add New Record</h6>
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

                                    <form action="{{ route('record.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="auditor_name">Auditor Name</label>
                                            <input type="text" name="auditor_name" id="auditor_name" class="form-control" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="audit_type">Audit Type</label>
                                            <select name="audit_type" id="audit_type" class="form-control" required>
                                                <option value="supplies">Supplies</option>
                                                <option value="assets">Assets</option>
                                            </select>
                                        </div>
                                
                                        <div class="form-group">
                                            <label for="item_or_asset_name">Item or Asset Name</label>
                                            <input type="text" name="item_or_asset_name" id="item_or_asset_name" class="form-control" required>
                                        </div>
                                
                                        <div class="form-group">
                                            <label for="condition">Condition</label>
                                            <textarea name="condition" id="condition" class="form-control"></textarea>
                                        </div>
                                
                                        <div class="form-group">
                                            <label for="notes">Notes</label>
                                            <textarea name="notes" id="notes" class="form-control"></textarea>
                                        </div>
                                
                                        <div class="form-group">
                                            <label for="audit_date">Audit Date</label>
                                            <input type="date" name="audit_date" id="audit_date" class="form-control" required>
                                        </div>
                                
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <input type="text" name="status" id="status" class="form-control" value="pending" required>
                                        </div>
                                
                                        <div class="form-group">
                                            <label for="actions_taken">Actions Taken</label>
                                            <textarea name="actions_taken" id="actions_taken" class="form-control"></textarea>
                                        </div>
                                
                                        <button type="submit" class="btn btn-primary">Create Record</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Browser Usage Section -->
                <div class="col-md-2">
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
