@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: sans-serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Vendor Portal</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/subcontractor') }}">Supplier</a></li>
            <li class="breadcrumb-item active" aria-current="page">Request List</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="row" style="font-size: 0.9rem; font-family: sans-serif;">
                    <div class="col-md-12">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Subcontractor Request List </h3>
                            <button type="button" class="btn btn-sm btn btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#createsupplierModal" style="font-size: 0.9rem; font-family: sans-serif;">
                                <i class="fas fa-plus"></i>Add New Request
                            </button>

                        </div>
                        @if (session('status'))
                            <div class="alert alert-success" style="font-size: 0.9rem; font-family: sans-serif;">
                                {{ session('status') }}
                            </div>
                        @endif
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0" style="font-size: 0.9rem; font-family: sans-serif;">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Subcontractor Name</th>
                                            <th>Project Scope</th>
                                            <th>Cost Estimate</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($subcontractors as $subcontractor)
                                        <tr>
                                            <td>{{ $subcontractor->id }}</td>
                                            <td>{{ $subcontractor->subcontractor_name }}</td>
                                            <td>{{ $subcontractor->project_scope }}</td>
                                            <td>${{ number_format($subcontractor->cost_estimate, 2) }}</td>
                                            <td>{{ $subcontractor->status }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-around align-items-center">
                                                        <a href="{{ route('subcontractor.show', $subcontractor->id) }}" class="btn btn-info btn-sm mx-0">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        
                                                        <a href="{{ route('subcontractor.edit', $subcontractor->id) }}" class="btn btn-warning btn-sm mx-0">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        
                                                        <form action="{{ route('subcontractor.destroy', $subcontractor->id) }}" method="POST" id="deleteForm{{ $subcontractor->id }}" class="mx-0">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $subcontractor->id }})">
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
                            <!-- /.table-responsive -->
                        </div>
                    </div>
                </div>

                <!-- Button to open the modal -->


                <!-- Modal -->
                <div class="modal fade" id="createsupplierModal" tabindex="-1" aria-labelledby="createsupplierModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="createsupplierModalLabel"
                                    style="font-size: 0.9rem; font-family: sans-serif;">Create Supplier Request</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="font-size: 0.9rem; font-family: sans-serif;">
                                @if ($errors->any())
                                    <div class="alert alert-danger" style="font-size: 0.9rem; font-family: sans-serif;">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('subcontractor.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>Subcontractor Name</label>
                                        <input type="text" name="subcontractor_name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Project Scope</label>
                                        <textarea name="project_scope" class="form-control" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Cost Estimate</label>
                                        <input type="number" name="cost_estimate" class="form-control" step="0.01" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Timeline</label>
                                        <input type="text" name="timeline" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Resources Required</label>
                                        <textarea name="resources_required" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Contact Information</label>
                                        <input type="text" name="contact_information" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Submitted Date</label>
                                        <input type="date" name="submitted_date" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-3">Submit Request</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>




        <div class="col-md-2">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Sales</h3>
                        <a href="javascript:void(0);">View Report</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg"
                                style="font-size: 0.9rem; font-family: sans-serif;">$18,230.00</span>
                            <span style="font-size: 0.9rem; font-family: sans-serif;">Sales Over Time</span>
                        </p>
                        <p class="ml-auto d-flex flex-column text-right">
                            <span class="text-success" style="font-size: 0.9rem; font-family: sans-serif;">
                                <i class="fas fa-arrow-up"></i> 33.1%
                            </span>
                            <span class="text-muted" style="font-size: 0.9rem; font-family: sans-serif;">Since last
                                month</span>
                        </p>
                    </div>
                    <!-- /.d-flex -->
                    <div class="position-relative mb-4">
                        <canvas id="sales-chart" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            var ticksStyle = {
                fontColor: '#495057',
                fontStyle: 'bold'
            }
            var mode = 'index';
            var intersect = true;
            var $salesChart = $('#sales-chart');
            var salesChart = new Chart($salesChart, {
                type: 'bar',
                data: {
                    labels: ['JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
                    datasets: [{
                            backgroundColor: '#007bff',
                            borderColor: '#007bff',
                            data: [1000, 2000, 3000, 2500, 2700, 2500, 3000]
                        },
                        {
                            backgroundColor: '#ced4da',
                            borderColor: '#ced4da',
                            data: [700, 1700, 2700, 2000, 1800, 1500, 2000]
                        }
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: true,
                                lineWidth: '4px',
                                color: 'rgba(0, 0, 0, .2)',
                                zeroLineColor: 'transparent'
                            },
                            ticks: $.extend({
                                beginAtZero: true,
                                callback: function(value) {
                                    if (value >= 1000) {
                                        value /= 1000;
                                        value += 'k';
                                    }
                                    return '$' + value;
                                }
                            }, ticksStyle)
                        }],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: false
                            },
                            ticks: ticksStyle
                        }]
                    }
                }
            });
        });
    </script>


@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session("success") }}',
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
