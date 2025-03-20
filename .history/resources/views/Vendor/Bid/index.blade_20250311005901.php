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
                            <h3 class="card-title">Bid List</h3>
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
                                                <span class="badge 
                                                    @if($bid->status == 'approved') bg-success 
                                                    @elseif($bid->status == 'pending') bg-warning 
                                                    @elseif($bid->status == 'rejected') bg-danger 
                                                    @else bg-secondary 
                                                    @endif">
                                                    {{ ucfirst($bid->status) }}
                                                </span>
                                            </td>
                                            
                                            <td id="real-time-date-{{ $bid->id }}">
                                                {{ \Carbon\Carbon::parse($bid->created_at)->format('F j, Y, g:i a') }}
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-around align-items-center">
                                                    <a href="{{ route('bid.show', $bid->id) }}" class="btn btn-info btn-sm mx-0">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('bid.edit', $bid->id) }}" class="btn btn-warning btn-sm mx-0">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('bid.destroy', $bid->id) }}" method="POST" id="deleteForm{{ $bid->id }}" class="mx-0">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $bid->id }})">
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
                        <h3 class="card-title">Sales</h3>
                        <a href="javascript:void(0);">View Report</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg"
                                style="font-size: 0.9rem; font-family: sans-serif;">₱18,230.00</span>
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
            var $salesChart = ₱('#sales-chart');
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
    function updateTime(bidId) {
        const createdAt = new Date("{{ \Carbon\Carbon::parse($bid->created_at)->toIso8601String() }}");
        const formattedDate = createdAt.toLocaleString('en-US', {
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
    setInterval(() => updateTime({{ $bid->id }}), 1000);
    @endforeach
</script>
@endsection
