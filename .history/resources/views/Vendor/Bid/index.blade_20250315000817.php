@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: sans-serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Vendor Portal</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/bid') }}">Bids</a></li>
            <li class="breadcrumb-item active" aria-current="page">Bids List</li>
        </ol>
    </nav>



    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="row" style="font-size: 0.9rem; font-family: sans-serif;">
                    <div class="col-md-12">
                        <div class="card-header border-transparent">
                            <h1 class="card-title">Bid List</h1>
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
                                                <td>{{ str_pad(strtoupper(dechex($bid->id)), 4, '0', STR_PAD_LEFT) }}</td>
                                                <td>
                                                    <a href="{{ route('auction.show', $bid->auction->id) }}">
                                                        {{ str_pad(strtoupper(dechex($bid->auction->id)), 4, '0', STR_PAD_LEFT) }}
                                                    </a>
                                                </td>
                                                <td>{{ $bid->user->id ?? 'Guest' }}</td>
                                                <td>₱{{ number_format($bid->bid_amount, 2) }}</td>
                                                <td>
                                                    <span
                                                        class="badge 
                                                        @if ($bid->status == 'pending') bg-warning
                                                        @elseif ($bid->status == 'active') bg-primary
                                                        @elseif ($bid->status == 'outbid') bg-secondary
                                                        @elseif ($bid->status == 'winning bid') bg-success
                                                        @elseif ($bid->status == 'cancelled') bg-danger
                                                        @elseif ($bid->status == 'closed') bg-secondary
                                                        @elseif ($bid->status == 'awarded') bg-info
                                                        @elseif ($bid->status == 'completed') bg-success
                                                        @else bg-secondary @endif">
                                                        {{ ucfirst($bid->status) }}
                                                    </span>
                                                </td>



                                                <td id="real-time-date-{{ $bid->id }}">
                                                    {{ $bid->created_at->format('l, F j, Y, g:i:s A') }}
                                                </td>

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
                                                        <form action="{{ route('bid.destroy', $bid->id) }}" method="POST"
                                                            id="deleteForm{{ $bid->id }}" class="mx-0">
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

                <!-- Removed Create Auction Modal -->

            </div>
        </div>

        <div class="col-md-2">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Bids</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <p class="d-flex flex-column">
                            <span id="total-bids" class="text-bold text-lg"
                                style="font-size: 0.9rem; font-family: sans-serif;">₱0.00</span>
                            <span style="font-size: 0.9rem; font-family: sans-serif;">Highest Bids</span>
                        </p>
                    </div>
                    <div class="position-relative mb-4">
                        <canvas id="bids-chart" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                var ticksStyle = {
                    fontColor: '#495057',
                    fontStyle: 'bold'
                };
                var mode = 'index';
                var intersect = true;

                var $bidsChart = $('#bids-chart');
                var bidsChart = new Chart($bidsChart, {
                    type: 'bar',
                    data: {
                        labels: [],
                        datasets: [{
                                label: 'Highest Bids',
                                backgroundColor: '#007bff',
                                borderColor: '#007bff',
                                data: [] // Empty initially
                            },
                            {
                                label: 'Starting Bids',
                                backgroundColor: '#ced4da',
                                borderColor: '#ced4da',
                                data: [] // Empty initially
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
                            display: true
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
                                        return '₱' + value;
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

                function fetchBidData() {
                    $.ajax({
                        url: '/get-bid-data', // Laravel route
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            var labels = [];
                            var highestBids = [];
                            var startingBids = [];
                            var maxBid = 0; // Track only the highest bid

                            response.forEach(function(bid) {
                                labels.push(bid.item_name);
                                highestBids.push(bid.highest_bid);
                                startingBids.push(bid.starting_bid);

                                // Find the maximum highest bid
                                if (bid.highest_bid > maxBid) {
                                    maxBid = bid.highest_bid;
                                }
                            });

                            bidsChart.data.labels = labels;
                            bidsChart.data.datasets[0].data = highestBids;
                            bidsChart.data.datasets[1].data = startingBids;
                            bidsChart.update();

                            // Display only the highest bid
                            $('#total-bids').text('₱' + maxBid.toLocaleString());
                        }
                    });
                }


                fetchBidData();
                setInterval(fetchBidData, 5000); // Update every 5 seconds
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

        <script>
            function updateTime(bidId, createdAt) {
                const date = new Date(createdAt);
                const formattedDate = date.toLocaleString('en-US', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                    hour12: true
                });

                document.getElementById('real-time-date-' + bidId).innerText = formattedDate;
            }

            @foreach ($bids as $bid)
                setInterval(() => updateTime({{ $bid->id }}, "{{ $bid->created_at->toIso8601String() }}"), 1000);
            @endforeach
        </script>

        <style>
            /* Badge Styling */
            .badge {
                color: white !important;
                padding: 5px 10px;
                font-size: 0.8rem;
                border-radius: 5px;
                display: inline-block;
                text-align: center;
                font-weight: bold;
            }

            /* Background Colors */
            .bg-warning {
                background-color: #ffc107 !important;
            }

            /* Yellow */
            .bg-primary {
                background-color: #007bff !important;
            }

            /* Blue */
            .bg-secondary {
                background-color: #6c757d !important;
            }

            /* Gray */
            .bg-danger {
                background-color: #dc3545 !important;
            }

            /* Red */
            .bg-dark {
                background-color: #343a40 !important;
            }

            /* Dark Gray */
            .bg-success {
                background-color: #28a745 !important;
            }

            /* Green */
            .bg-info {
                background-color: #17a2b8 !important;
            }

            /* Cyan */

            /* Ensure the text is visible */
            .bg-warning,
            .bg-primary,
            .bg-secondary,
            .bg-danger,
            .bg-dark,
            .bg-success,
            .bg-info {
                color: white !important;
            }
        </style>
    @endsection
