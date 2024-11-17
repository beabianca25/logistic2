@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Vendor Portal</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vendor List</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-10">
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


                @if (session('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: '{{ session('success') }}',
                            showConfirmButton: true,
                        });
                    </script>
                @endif

                <!-- /.card-header -->
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
                                            <a href="{{ route('vendor.show', $vendor) }}" class="btn btn-info btn-sm"><i
                                                    class="fas fa-eye"></i></a>
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editVendorModal">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('vendor.destroy', $vendor->id) }}" method="POST"
                                                id="deleteForm{{ $vendor->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger"
                                                    onclick="confirmDelete({{ $vendor->id }})">Delete</button>
                                            </form>

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
                    <!-- /.table-responsive -->
                </div>

                <div class="container" style="font-size: 0.9rem; font-family: serif;">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Modal -->
                            <div class="modal fade" id="addVendorModal" tabindex="-1" aria-labelledby="addVendorModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addVendorModalLabel">Add New Vendor</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if ($errors->any())
                                                <div class="alert alert-danger"
                                                    style="font-size: 0.9rem; font-family: serif;">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <form action="{{ route('vendor.store') }}" method="POST">
                                                @csrf
                                                <div class="form-group mb-3">
                                                    <label for="vendor_name">Vendor Name</label>
                                                    <input type="text" name="vendor_name" id="vendor_name"
                                                        class="form-control" required
                                                        style="font-size: 0.9rem; font-family: serif;">
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email" id="email" class="form-control"
                                                        placeholder="example@example.com"
                                                        style="font-size: 0.9rem; font-family: serif;">
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="phone">Phone</label>
                                                    <input type="text" name="phone" id="phone" class="form-control"
                                                        maxlength="15" placeholder="Phone Number"
                                                        style="font-size: 0.9rem; font-family: serif;">
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="business_license">Business License</label>
                                                    <input type="text" name="business_license" id="business_license"
                                                        class="form-control" placeholder="Business License Number"
                                                        style="font-size: 0.9rem; font-family: serif;">
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="tax_information">Tax Information</label>
                                                    <input type="text" name="tax_information" id="tax_information"
                                                        class="form-control" placeholder="Tax Information"
                                                        style="font-size: 0.9rem; font-family: serif;">
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="service_category">Service Category</label>
                                                    <select name="service_category" id="service_category"
                                                        class="form-control" required
                                                        style="font-size: 0.9rem; font-family: serif;">
                                                        <option value="">Select a Category</option>
                                                        <option value="Airlines">Airlines</option>
                                                        <option value="Rail Companies">Rail Companies</option>
                                                        <option value="Bus/Coach Operators">Bus/Coach Operators</option>
                                                        <option value="Car Rental Agencies">Car Rental Agencies</option>
                                                        <option value="Cruise Lines">Cruise Lines</option>
                                                    </select>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="contract_start_date">Contract Start Date</label>
                                                    <input type="date" name="contract_start_date"
                                                        id="contract_start_date" class="form-control"
                                                        style="font-size: 0.9rem; font-family: serif;">
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="contract_end_date">Contract End Date</label>
                                                    <input type="date" name="contract_end_date" id="contract_end_date"
                                                        class="form-control"
                                                        style="font-size: 0.9rem; font-family: serif;">
                                                </div>

                                                <button type="submit" class="btn btn-primary">Create Vendor</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Modal -->
                        </div>
                    </div>
                </div>
            </div>



            <div class="container" style="font-size: 0.9rem; font-family: serif;">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Modal -->
                        <div class="modal fade" id="editVendorModal" tabindex="-1"
                            aria-labelledby="editVendorModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content" style="font-family: serif;">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="editVendorModalLabel" style="font-size: 1rem;">Edit
                                            Vendor</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="font-size: 0.9rem;">
                                        <form action="{{ route('vendor.update', $vendor->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="mb-3">
                                                <label for="vendor_name" class="form-label">Vendor Name:</label>
                                                <input type="text" class="form-control" name="vendor_name"
                                                    value="{{ old('vendor_name', $vendor->vendor_name) }}" required>
                                                @error('vendor_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="contact_email" class="form-label">Email:</label>
                                                <input type="email" class="form-control" name="contact_email"
                                                    value="{{ old('contact_email', $vendor->contact_email) }}" required>
                                                @error('contact_email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="contact_phone" class="form-label">Phone:</label>
                                                <input type="text" class="form-control" name="contact_phone"
                                                    value="{{ old('contact_phone', $vendor->contact_phone) }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="business_license" class="form-label">Business License:</label>
                                                <input type="text" class="form-control" name="business_license"
                                                    value="{{ old('business_license', $vendor->business_license) }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="tax_information" class="form-label">Tax Information:</label>
                                                <input type="text" class="form-control" name="tax_information"
                                                    value="{{ old('tax_information', $vendor->tax_information) }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="service_category" class="form-label">Service Category</label>
                                                <select name="service_category" id="service_category"
                                                    class="form-control" required>
                                                    <option value="{{ $vendor->service_category }}">
                                                        {{ $vendor->service_category }}</option>
                                                    <option value="Airlines">Airlines</option>
                                                    <option value="Rail Companies">Rail Companies</option>
                                                    <option value="Bus/Coach Operators">Bus/Coach Operators</option>
                                                    <option value="Car Rental Agencies">Car Rental Agencies</option>
                                                    <option value="Cruise Lines">Cruise Lines</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="contract_start_date" class="form-label">Contract Start
                                                    Date:</label>
                                                <input type="date" class="form-control" name="contract_start_date"
                                                    value="{{ old('contract_start_date', $vendor->contract_start_date) }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="contract_end_date" class="form-label">Contract End
                                                    Date:</label>
                                                <input type="date" class="form-control" name="contract_end_date"
                                                    value="{{ old('contract_end_date', $vendor->contract_end_date) }}">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary"
                                                    style="font-size: 0.9rem;">Update Vendor</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                                    style="font-size: 0.9rem;">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->
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
                                style="font-size: 0.9rem; font-family: serif;">$18,230.00</span>
                            <span style="font-size: 0.9rem; font-family: serif;">Sales Over Time</span>
                        </p>
                        <p class="ml-auto d-flex flex-column text-right">
                            <span class="text-success" style="font-size: 0.9rem; font-family: serif;">
                                <i class="fas fa-arrow-up"></i> 33.1%
                            </span>
                            <span class="text-muted" style="font-size: 0.9rem; font-family: serif;">Since last
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
