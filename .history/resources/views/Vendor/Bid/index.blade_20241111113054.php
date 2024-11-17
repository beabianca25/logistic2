@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Vendor Portal</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/bid') }}">Bids</a></li>
            <li class="breadcrumb-item active" aria-current="page">Bids List</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="row" style="font-size: 0.9rem; font-family: serif;">
                    <div class="col-md-12">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Auction List</h3>
                            <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#createAuctionModal" style="font-size: 0.9rem; font-family: serif;">
                                Create New Bid
                            </button>
                        </div>
                        @if (session('status'))
                            <div class="alert alert-success" style="font-size: 0.9rem; font-family: serif;">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0" style="font-size: 0.9rem; font-family: serif;">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Auction</th>
                                            <th>Buyer</th>
                                            <th>Bid Amount</th>
                                            <th>Status</th>
                                            <th>Bid Time</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bids as $bid)
                                            <tr>
                                                <td>{{ $bid->id }}</td>
                                                <td>{{ $bid->auction->name }}</td>
                                                <td>{{ $bid->buyer->name }}</td>
                                                <td>${{ number_format($bid->bid_amount, 2) }}</td>
                                                <td>{{ ucfirst($bid->status) }}</td>
                                                <td>{{ $bid->bid_time }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-around align-items-center">
                                                        <a href="{{ route('bid.show', $bid->id) }}"
                                                            class="btn btn-info btn-sm mx-0">
                                                            <i class="fas fa-eye"></i>
                                                        </a>

                                                        <a href="{{ route('bid.edit', $bid->id) }}"
                                                            class="btn btn-warning btn-sm mx-0">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <form action="{{ route('bid.destroy', $bid->id) }}"
                                                            method="POST" id="deleteForm{{ $bid->id }}"
                                                            class="mx-0">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                onclick="confirmDelete({{ $bid->id }})">
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
                <div class="modal fade" id="createAuctionModal" tabindex="-1" aria-labelledby="createAuctionModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content" style="font-size: 0.9rem; font-family: serif;">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createAuctionModalLabel">Create Bid</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
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

                                <form action="{{ route('bid.store') }}" method="POST">
                                    @csrf
                        
                                    <div class="mb-3">
                                        <label for="auction_id" class="form-label">Auction</label>
                                        <select class="form-select" id="auction_id" name="auction_id" required>
                                            @foreach($auctions as $auction)
                                                <option value="{{ $auction->id }}">{{ $auction->auction_title }}</option>
                                            @endforeach
                                        </select>
                                        
                                    </div>
                                    {{-- <div class="mb-3">
                                        <label for="buyer_id" class="form-label">Buyer</label>
                                        <select class="form-select" id="buyer_id" name="buyer_id" required>
                                            @foreach($buyers as $buyer)
                                                <option value="{{ $buyer->id }}">{{ $buyer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                        
                                    <div class="mb-3">
                                        <label for="bid_amount" class="form-label">Bid Amount</label>
                                        <input type="number" class="form-control" id="bid_amount" name="bid_amount" required step="0.01" min="0">
                                    </div>
                        
                                    <button type="submit" class="btn btn-primary">Place Bid</button>
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
