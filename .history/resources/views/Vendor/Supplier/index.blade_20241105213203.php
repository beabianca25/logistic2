@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Vendor Portal</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/supplier_request') }}">Supplier</a></li>
            <li class="breadcrumb-item active" aria-current="page">Request List</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="row" style="font-size: 0.9rem; font-family: serif;">
                    <div class="col-md-12">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Supplier Request List </h3>
                            <button type="button" class="btn btn-sm btn btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#createRequestModal" style="font-size: 0.9rem; font-family: serif;">
                                Add New Request
                            </button>

                        </div>
                        @if (session('status'))
                            <div class="alert alert-success" style="font-size: 0.9rem; font-family: serif;">
                                {{ session('status') }}
                            </div>
                        @endif
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0" style="font-size: 0.9rem; font-family: serif;">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Supplier Name</th>
                                            <th>Product/Service Description</th>
                                            <th>Price Quote</th>
                                            <th>Availability/Lead Time</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($supplierrequests as $request)
                                            <tr>
                                                <td>{{ $request->id }}</td>
                                                <td>{{ $request->supplier_name }}</td>
                                                <td>{{ $request->product_service_description }}</td>
                                                <td>{{ $request->price_quote }}</td>
                                                <td>{{ $request->availability_lead_time }}</td>
                                                <td>{{ $request->status }}</td>
                                                <td>
                                                    <a href="{{ route('supplier_request.show', $request->id) }}"
                                                        class="btn btn-info" style="font-size: 0.8rem; font-family: serif;">
                                                        <i class="fas fa-eye"></i> </a>
                                                    <a href="{{ route('supplier_request.edit', $request->id) }}"
                                                        class="btn btn-warning"
                                                        style="font-size: 0.8rem; font-family: serif;">
                                                        <i class="fas fa-edit"></i> </a>
                                                    <form action="{{ route('supplier_request.destroy', $request->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            style="font-size: 0.8rem; font-family: serif;"
                                                            onclick="return confirm('Are you sure you want to delete this request?')"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
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
                <div class="modal fade" id="createRequestModal" tabindex="-1" aria-labelledby="createRequestModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="createRequestModalLabel"
                                    style="font-size: 0.9rem; font-family: serif;">Create Supplier Request</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="font-size: 0.9rem; font-family: serif;">
                                @if ($errors->any())
                                    <div class="alert alert-danger" style="font-size: 0.9rem; font-family: serif;">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('supplier_request.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="supplier_name" class="form-label">Supplier Name</label>
                                        <input type="text" name="supplier_name" class="form-control"
                                            value="{{ old('supplier_name') }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="product_service_description" class="form-label">Product/Service
                                            Description</label>
                                        <textarea name="product_service_description" class="form-control" required>{{ old('product_service_description') }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="price_quote" class="form-label">Price/Quote</label>
                                        <input type="number" name="price_quote" step="0.01" class="form-control"
                                            value="{{ old('price_quote') }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="availability_lead_time" class="form-label">Availability/Lead
                                            Time</label>
                                        <input type="text" name="availability_lead_time" class="form-control"
                                            value="{{ old('availability_lead_time') }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="contact_information" class="form-label">Contact Information</label>
                                        <input type="text" name="contact_information" class="form-control"
                                            value="{{ old('contact_information') }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="attachments" class="form-label">Attachments</label>
                                        <input type="file" name="attachments" class="form-control">
                                    </div>

                                    <button type="submit" class="btn btn-success"
                                        style="font-size: 0.9rem; font-family: serif;">Submit</button>
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
@endsection
