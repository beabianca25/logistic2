@extends('user.base1')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: sans-serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Vendor Portal</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/auction') }}">Auction</a></li>
            <li class="breadcrumb-item active" aria-current="page">Auction List</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="row" style="font-size: 0.9rem; font-family: sans-serif;">
                    <div class="col-md-12">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Auction List</h3>
                            <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#createAuctionModal" style="font-size: 0.9rem; font-family: serif;">
                                <i class="fas fa-plus"></i>Create New Auction
                            </button>
                        </div>
                        @if (session('status'))
                            <div class="alert alert-success" style="font-size: 0.9rem; font-family: sans-serif;">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0" style="font-size: 0.9rem; font-family: sans-serif;">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Category</th>
                                            <th>Title</th>
                                            <th>Year</th>
                                            <th>Company</th>
                                            <th>MEP</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($auctions as $auction)
                                            <tr>
                                                <td>{{ $auction->id }}</td>
                                                <td>{{ $auction->category }}</td>
                                                <td>{{ $auction->auction_title }}</td>
                                                <td>{{ $auction->year }}</td>
                                                <td>{{ $auction->company }}</td>
                                                <td>{{ $auction->min_estimate_price }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-around align-items-center">
                                                        <a href="{{ route('auction.show', $auction->id) }}" class="btn btn-info btn-sm mx-0">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        
                                                        <a href="{{ route('auction.edit', $auction->id) }}" class="btn btn-warning btn-sm mx-0">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        
                                                        <form action="{{ route('auction.destroy', $auction->id) }}" method="POST" id="deleteForm{{ $auction->id }}" class="mx-0">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $auction->id }})">
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

                <!-- Button to trigger modal -->
                <div class="text-end mb-3">
                    
                </div>
                
                <!-- Modal for creating a new auction -->
                <div class="modal fade" id="createAuctionModal" tabindex="-1" aria-labelledby="createAuctionModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content" style="font-size: 0.9rem; font-family: sans-serif;">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createAuctionModalLabel">Create New Auction</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                {{-- Uncomment the below code to show errors --}}
                                {{-- @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif --}}
                
                                <form action="{{ route('auction.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select name="category" class="form-control" required>
                                            <option value="">Select Category</option>
                                            <option value="travel_gear">Travel Gear</option>
                                            <option value="Electronic_Devices">Electronic Devices</option>
                                            <option value="Trvel_Apparel">Travel Apparel</option>
                                            <option value="Health_and_Safety">Health and Safety</option>
                                            <option value="Ecofriendly_products">Eco-friendly Products</option>
                                            <option value="Vehicles">Vehicles</option>
                                            <option value="Travel_Photography_Equipment">Travel Photography Equipment</option>
                                            <option value="Bicyles_and_Scooters">Bicycles and Scooters</option>
                                        </select>
                                    </div>
                
                                    <div class="form-group">
                                        <label for="auction_title">Auction Title</label>
                                        <input type="text" name="auction_title" class="form-control" required>
                                    </div>
                
                                    <div class="form-group">
                                        <label for="year">Year</label>
                                        <input type="number" name="year" class="form-control" required>
                                    </div>
                
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" class="form-control" rows="5" required></textarea>
                                    </div>
                
                                    <div class="form-group">
                                        <label for="condition">Condition</label>
                                        <input type="text" name="condition" class="form-control" required>
                                    </div>
                
                                    <div class="form-group">
                                        <label for="product_version">Product Version</label>
                                        <input type="text" name="product_version" class="form-control" required>
                                    </div>
                
                                    <div class="form-group">
                                        <label for="company">Company</label>
                                        <input type="text" name="company" class="form-control" required>
                                    </div>
                
                                    <h5>Pricing:</h5>
                                    <div class="form-group">
                                        <label for="min_estimate_price">Minimum Estimate Price</label>
                                        <input type="number" name="min_estimate_price" class="form-control" required>
                                    </div>
                
                                    <div class="form-group">
                                        <label for="max_estimate_price">Maximum Estimate Price</label>
                                        <input type="number" name="max_estimate_price" class="form-control" required>
                                    </div>
                
                                    <div class="form-group">
                                        <label for="end_date">End Date</label>
                                        <input type="date" name="end_date" class="form-control" required>
                                    </div>
                
                                    <div class="form-group">
                                        <label for="photo">Photo</label>
                                        <input type="file" name="photo" class="form-control">
                                    </div>
                
                                    <button type="submit" class="btn btn-success">Create Auction</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
                            <span class="text-bold text-lg" style="font-size: 0.9rem; font-family: sans-serif;">$18,230.00</span>
                            <span style="font-size: 0.9rem; font-family: sans-serif;">Sales Over Time</span>
                        </p>
                        <p class="ml-auto d-flex flex-column text-right">
                            <span class="text-success" style="font-size: 0.9rem; font-family: sans-serif;">
                                <i class="fas fa-arrow-up"></i> 33.1%
                            </span>
                            <span class="text-muted" style="font-size: 0.9rem; font-family: sans-serif;">Since last month</span>
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
                    datasets: [
                        {
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
