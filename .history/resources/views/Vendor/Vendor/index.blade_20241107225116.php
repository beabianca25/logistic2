@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Vendor Portal</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vendor List</li>
        </ol>
    </nav>
    
    <div class="row">
        <div class="col-md-9"> <!-- Adjusted for better responsiveness -->
            <div class="card">
                <div class="card-header border-transparent" style="font-size: 0.9rem; font-family: serif;">
                    <h3 class="card-title">Vendor List</h3>
                    <button type="button" class="btn btn-sm btn-primary float-right" data-bs-toggle="modal"
                        data-bs-target="#addVendorModal">
                        Add New Vendor
                    </button>
                </div>
                @if (session('status'))
                    <div class="alert alert-success" style="font-size: 0.9rem; font-family: serif;">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Card Body -->
                <div class="card-body p-0" style="font-size: 0.9rem; font-family: serif;">
                    <div class="table-responsive">
                        <table class="table m-0" style="font-size: 0.9rem; font-family: serif;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Vendor Name</th>
                                    <th>Business License</th>
                                    <th>Tax Info</th>
                                    <th>Service Categories</th>
                                    <th>Contract Start</th>
                                    <th>Contract End</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($vendors as $vendor)
                                    <tr>
                                        <td>{{ $vendor->id }}</td>
                                        <td>{{ $vendor->vendor_name }}</td>
                                        <td>{{ $vendor->business_license }}</td>
                                        <td>{{ $vendor->tax_information }}</td>
                                        <td>{{ $vendor->service_category }}</td>
                                        <td>{{ $vendor->contract_start_date }}</td>
                                        <td>{{ $vendor->contract_end_date }}</td>
                                        <td>
                                            <div class="d-flex justify-content-around align-items-center">
                                                <a href="{{ route('vendor.show', $vendor->id) }}" class="btn btn-info btn-sm mx-0">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('vendor.edit', $vendor->id) }}" class="btn btn-warning btn-sm mx-0">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('vendor.destroy', $vendor->id) }}" method="POST" id="deleteForm{{ $vendor->id }}" class="mx-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $vendor->id }})">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No vendors found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal to Add New Vendor -->
                <div class="container" style="font-size: 0.9rem; font-family: serif;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="modal fade" id="addVendorModal" tabindex="-1" aria-labelledby="addVendorModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addVendorModalLabel">Add New Vendor</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if ($errors->any())
                                                <div class="alert alert-danger" style="font-size: 0.9rem; font-family: serif;">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <form action="{{ route('vendor.store') }}" method="POST">
                                                @csrf
                                                <!-- Form Fields -->
                                                <div class="form-group mb-3">
                                                    <label for="vendor_name">Vendor Name</label>
                                                    <input type="text" name="vendor_name" id="vendor_name" class="form-control" required style="font-size: 0.9rem; font-family: serif;">
                                                </div>
                                                <!-- Additional fields for email, phone, etc. -->
                                                <button type="submit" class="btn btn-primary">Create Vendor</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column for Sales Chart -->
        <div class="col-md-3">
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
                            <span class="text-bold text-lg" style="font-size: 0.9rem; font-family: serif;">$18,230.00</span>
                            <span style="font-size: 0.9rem; font-family: serif;">Sales Over Time</span>
                        </p>
                        <p class="ml-auto d-flex flex-column text-right">
                            <span class="text-success" style="font-size: 0.9rem; font-family: serif;">
                                <i class="fas fa-arrow-up"></i> 33.1%
                            </span>
                            <span class="text-muted" style="font-size: 0.9rem; font-family: serif;">Since last month</span>
                        </p>
                    </div>
                    <div class="position-relative mb-4">
                        <canvas id="sales-chart" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // JavaScript for Chart
        $(function() {
            var ticksStyle = { fontColor: '#495057', fontStyle: 'bold' };
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
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: { mode: mode, intersect: intersect },
                    hover: { mode: mode, intersect: intersect },
                    legend: { display: false },
                    scales: {
                        yAxes: [{
                            gridLines: { display: true, lineWidth: '4px', color: 'rgba(0, 0, 0, .2)', zeroLineColor: 'transparent' },
                            ticks: { beginAtZero: true, callback: function(value) { return value >= 1000 ? '$' + value / 1000 + 'k' : '$' + value; }, ...ticksStyle }
                        }],
                        xAxes: [{
                            gridLines: { display: false },
                            ticks: ticksStyle
                        }]
                    }
                }
            });
        });

        // Confirm Delete Function
        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this vendor?')) {
                document.getElementById('deleteForm' + id).submit();
            }
        }
    </script>
@endsection
