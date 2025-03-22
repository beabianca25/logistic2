@extends('base')

@section('content')
    <div class="container" style="font-family: sans-serif; font-size: small;">
        <h2>Dashboard</h2>
        <style>
            .small-box {
                position: relative;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                /* Floating shadow effect */
                border-radius: 10px;
                padding: 15px;
                transition: all 0.3s ease-in-out;
                font-size: 14px;
                /* Adjusted font size */
            }

            .small-box:hover {
                box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
                transform: translateY(-3px);
            }

            .small-box h3 {
                font-size: 20px;
                /* Adjusted heading size */
                font-weight: 600;
            }

            .small-box p {
                font-size: 12px;
            }

            .small-box-footer {
                font-size: 12px;
                padding: 8px;
                display: block;
                text-align: center;
                background: rgba(0, 0, 0, 0.1);
                border-radius: 5px;
            }

            .icon {
                position: absolute;
                top: 10px;
                right: 15px;
                font-size: 30px;
                color: rgba(255, 255, 255, 0.8);
            }
        </style>

        <div class="row">
            <!-- Reservation Count -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="small-box bg-teal">
                    <div class="inner">
                        <h3 id="reservationCount">{{ $reservationCount ?? 0 }}</h3>
                        <p>Reservation Schedule</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <a href="{{ route('reservation.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Bid Count -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="small-box bg-cyan">
                    <div class="inner">
                        <h3 id="bidCount">{{ $bidCount ?? 0 }}</h3>
                        <p>Bid Count</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('bid.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Active Vehicles -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="small-box bg-pink">
                    <div class="inner">
                        <h3 id="activeVehicleCount">0</h3>
                        <p>Active Vehicles</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-car"></i>
                    </div>
                    <a href="{{ route('vehicle.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Pending Documents -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="small-box bg-indigo">
                    <div class="inner">
                        <h3 id="pendingDocumentCount">0</h3>
                        <p>Pending Documents</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{ route('document.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            function updateReservationCount() {
                $.ajax({
                    url: "{{ route('reservation.count') }}",
                    type: "GET",
                    success: function(response) {
                        $("#reservationCount").text(response.count);
                    }
                });
            }

            function fetchBidCount() {
                $.ajax({
                    url: "{{ route('bid.count') }}",
                    method: "GET",
                    success: function(response) {
                        $("#bidCount").text(response.bidCount);
                    }
                });
            }

            function fetchActiveVehicleCount() {
                $.ajax({
                    url: "{{ route('vehicle.active.count') }}",
                    method: "GET",
                    success: function(response) {
                        $("#activeVehicleCount").text(response.activeVehicleCount);
                    }
                });
            }

            function fetchPendingDocumentCount() {
                $.ajax({
                    url: "{{ route('document.pending.count') }}",
                    method: "GET",
                    success: function(response) {
                        $("#pendingDocumentCount").text(response.pendingDocumentCount);
                    }
                });
            }

            // Fetch counts every 5 seconds
            setInterval(updateReservationCount, 5000);
            setInterval(fetchBidCount, 5000);
            setInterval(fetchActiveVehicleCount, 5000);
            setInterval(fetchPendingDocumentCount, 5000);

            // Initial fetch
            updateReservationCount();
            fetchBidCount();
            fetchActiveVehicleCount();
            fetchPendingDocumentCount();
        </script>


<div class="row">
    <div class="col-md-7">
        <div class="card floating-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Daily Vehicle Usage Overview</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="barChart" style="height: 250px; max-width: 100%;"></canvas>
                    <div id="loadingIndicator" class="text-center mt-2" style="font-size: 12px;">Loading...</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-5">
        <div class="card floating-card">
            <div class="card-header border-transparent">
                <h3 class="card-title">Latest Auction Bids</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>Bid ID</th>
                                <th>Bidder Name</th>
                                <th>Bid Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($bids) && $bids->count() > 0)
                                @foreach ($bids as $bid)
                                    <tr>
                                        <td><a href="{{ route('bid.show', $bid->id) }}">BID{{ $bid->id }}</a></td>
                                        <td>{{ $bid->user->name ?? 'Guest' }}</td>
                                        <td>{{ $bid->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <span class="badge 
                                                {{ $bid->status == 'winning' ? 'badge-success' : ($bid->status == 'lost' ? 'badge-danger' : 'badge-secondary') }}">
                                                {{ ucfirst($bid->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center">No bids available</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .floating-card {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        border-radius: 10px;
        background: #fff;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        padding: 15px;
    }
    .floating-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }
    .card-header h3 {
        font-size: 14px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }
    .card-tools i {
        font-size: 12px;
    }
    .chart {
        padding: 10px;
    }
    .btn-tool {
        border: none;
        background: transparent;
        padding: 5px;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        let ctx = document.getElementById('barChart').getContext('2d');
        $('#loadingIndicator').show();
        
        $.ajax({
            url: "{{ route('report.bookingStatusData') }}",
            method: "GET",
            success: function(response) {
                $('#loadingIndicator').hide();
                if (!response || !response.months || !response.statusCounts) {
                    console.error("Missing data in response!");
                    return;
                }
                var barChartData = {
                    labels: response.months,
                    datasets: [
                        { label: 'Pending', backgroundColor: 'rgba(255, 206, 86, 0.8)', data: response.statusCounts['Pending'] },
                        { label: 'Approved', backgroundColor: 'rgba(75, 192, 192, 0.8)', data: response.statusCounts['Approved'] },
                        { label: 'Scheduled', backgroundColor: 'rgba(54, 162, 235, 0.8)', data: response.statusCounts['Scheduled'] },
                        { label: 'Ongoing', backgroundColor: 'rgba(153, 102, 255, 0.8)', data: response.statusCounts['Ongoing'] },
                        { label: 'Completed', backgroundColor: 'rgba(0, 255, 0, 0.8)', data: response.statusCounts['Completed'] },
                        { label: 'Cancelled', backgroundColor: 'rgba(255, 99, 132, 0.8)', data: response.statusCounts['Cancelled'] }
                    ]
                };
                new Chart(ctx, {
                    type: 'bar',
                    data: barChartData,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: { ticks: { autoSkip: true, maxTicksLimit: 12 } },
                            y: { beginAtZero: true }
                        }
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    });
</script>

            <div class="row">
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                <!-- Main content -->
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header border-0">
                                        <div class="d-flex justify-content-between">
                                            <h3 class="card-title">Applications</h3>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="position-relative mb-4">
                                            <canvas id="applications-chart" height="200"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        fetch('/get-applications-count')
                            .then(response => response.json())
                            .then(data => {
                                // Get all unique dates
                                const dates = [...new Set([
                                    ...data.vendors.map(entry => entry.date),
                                    ...data.suppliers.map(entry => entry.date),
                                    ...data.subcontractors.map(entry => entry.date)
                                ])].sort(); // Sort dates in ascending order

                                // Function to get application counts for a given date
                                function getCount(dataArray, date) {
                                    const entry = dataArray.find(item => item.date === date);
                                    return entry ? entry.count : 0;
                                }

                                // Map counts to corresponding dates (set 0 if missing)
                                const vendorData = dates.map(date => getCount(data.vendors, date));
                                const supplierData = dates.map(date => getCount(data.suppliers, date));
                                const subcontractorData = dates.map(date => getCount(data.subcontractors, date));

                                var ctx = document.getElementById('applications-chart').getContext('2d');

                                // Create Chart with Glow Effect
                                new Chart(ctx, {
                                    type: 'line', // Line chart
                                    data: {
                                        labels: dates, // X-axis: Dates
                                        datasets: [{
                                                label: 'Vendors',
                                                borderColor: '#00FFFF', // Neon Blue
                                                backgroundColor: 'rgba(0, 255, 255, 0.3)',
                                                data: vendorData,
                                                fill: false,
                                                tension: 0.4,
                                                borderWidth: 3,
                                                pointBackgroundColor: '#00FFFF',
                                                pointBorderColor: '#00FFFF',
                                                pointRadius: 6
                                            },
                                            {
                                                label: 'Suppliers',
                                                borderColor: '#F5FF00', // Neon Yellow
                                                backgroundColor: 'rgba(245, 255, 0, 0.3)',
                                                data: supplierData,
                                                fill: false,
                                                tension: 0.4,
                                                borderWidth: 3,
                                                pointBackgroundColor: '#F5FF00',
                                                pointBorderColor: '#F5FF00',
                                                pointRadius: 6
                                            },
                                            {
                                                label: 'Subcontractors',
                                                borderColor: '#FF073A', // Neon Red
                                                backgroundColor: 'rgba(255, 7, 58, 0.3)',
                                                data: subcontractorData,
                                                fill: false,
                                                tension: 0.4,
                                                borderWidth: 3,
                                                pointBackgroundColor: '#FF073A',
                                                pointBorderColor: '#FF073A',
                                                pointRadius: 6
                                            }
                                        ]
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        scales: {
                                            x: {
                                                title: {
                                                    display: true,
                                                    text: 'Application Date'
                                                }
                                            },
                                            y: {
                                                beginAtZero: true,
                                                title: {
                                                    display: true,
                                                    text: 'Number of Applications'
                                                }
                                            }
                                        }
                                    },
                                    plugins: [{
                                        id: 'glowEffect',
                                        beforeDatasetsDraw: function(chart) {
                                            const ctx = chart.ctx;
                                            ctx.save();

                                            chart.data.datasets.forEach(dataset => {
                                                const meta = chart.getDatasetMeta(chart.data
                                                    .datasets.indexOf(dataset));
                                                if (!meta.hidden) {
                                                    meta.data.forEach(point => {
                                                        ctx.beginPath();
                                                        ctx.arc(point.x, point.y, 10, 0,
                                                            2 * Math.PI);
                                                        ctx.fillStyle = dataset
                                                            .borderColor;
                                                        ctx.shadowColor = dataset
                                                            .borderColor;
                                                        ctx.shadowBlur =
                                                            15; // Increased blur for glow
                                                        ctx.globalAlpha = 0.8;
                                                        ctx.fill();
                                                        ctx.closePath();
                                                    });
                                                }
                                            });

                                            ctx.restore();
                                        }
                                    }]
                                });
                            })
                            .catch(error => console.error('Error fetching counts:', error));
                    });
                </script>
                <!-- LATEST MEMBERS -->
                <div class="col-md-6">
                    <div class="card floating-card">
                        <div class="card-header">
                            <h3 class="card-title">Latest Members</h3>

                            <div class="card-tools">
                                <span class="badge badge-danger">{{ $users->count() }} New Members</span>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <ul class="users-list clearfix">
                                @foreach ($users as $user)
                                    <li>
                                        <img class="direct-chat-img" src="{{ asset('images/JVD-removebg-preview.png') }}"
                                            alt="User Image">
                                        <a class="users-list-name" href="#">{{ $user->name }}</a>
                                        <span class="users-list-date">{{ $user->created_at->format('d M Y') }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="card-footer text-center">
                            <a href="{{ route('users.index') }}">View All Users</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">Applications</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="position-relative mb-4">
                                    <canvas id="applications-chart" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                fetch('/get-applications-count')
                    .then(response => response.json())
                    .then(data => {
                        // Get all unique dates
                        const dates = [...new Set([
                            ...data.vendors.map(entry => entry.date),
                            ...data.suppliers.map(entry => entry.date),
                            ...data.subcontractors.map(entry => entry.date)
                        ])].sort(); // Sort dates in ascending order

                        // Function to get application counts for a given date
                        function getCount(dataArray, date) {
                            const entry = dataArray.find(item => item.date === date);
                            return entry ? entry.count : 0;
                        }

                        // Map counts to corresponding dates (set 0 if missing)
                        const vendorData = dates.map(date => getCount(data.vendors, date));
                        const supplierData = dates.map(date => getCount(data.suppliers, date));
                        const subcontractorData = dates.map(date => getCount(data.subcontractors, date));

                        var ctx = document.getElementById('applications-chart').getContext('2d');

                        // Create Chart with Glow Effect
                        new Chart(ctx, {
                            type: 'line', // Line chart
                            data: {
                                labels: dates, // X-axis: Dates
                                datasets: [{
                                        label: 'Vendors',
                                        borderColor: '#00FFFF', // Neon Blue
                                        backgroundColor: 'rgba(0, 255, 255, 0.3)',
                                        data: vendorData,
                                        fill: false,
                                        tension: 0.4,
                                        borderWidth: 3,
                                        pointBackgroundColor: '#00FFFF',
                                        pointBorderColor: '#00FFFF',
                                        pointRadius: 6
                                    },
                                    {
                                        label: 'Suppliers',
                                        borderColor: '#F5FF00', // Neon Yellow
                                        backgroundColor: 'rgba(245, 255, 0, 0.3)',
                                        data: supplierData,
                                        fill: false,
                                        tension: 0.4,
                                        borderWidth: 3,
                                        pointBackgroundColor: '#F5FF00',
                                        pointBorderColor: '#F5FF00',
                                        pointRadius: 6
                                    },
                                    {
                                        label: 'Subcontractors',
                                        borderColor: '#FF073A', // Neon Red
                                        backgroundColor: 'rgba(255, 7, 58, 0.3)',
                                        data: subcontractorData,
                                        fill: false,
                                        tension: 0.4,
                                        borderWidth: 3,
                                        pointBackgroundColor: '#FF073A',
                                        pointBorderColor: '#FF073A',
                                        pointRadius: 6
                                    }
                                ]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Application Date'
                                        }
                                    },
                                    y: {
                                        beginAtZero: true,
                                        title: {
                                            display: true,
                                            text: 'Number of Applications'
                                        }
                                    }
                                }
                            },
                            plugins: [{
                                id: 'glowEffect',
                                beforeDatasetsDraw: function(chart) {
                                    const ctx = chart.ctx;
                                    ctx.save();

                                    chart.data.datasets.forEach(dataset => {
                                        const meta = chart.getDatasetMeta(chart.data
                                            .datasets.indexOf(dataset));
                                        if (!meta.hidden) {
                                            meta.data.forEach(point => {
                                                ctx.beginPath();
                                                ctx.arc(point.x, point.y, 10, 0,
                                                    2 * Math.PI);
                                                ctx.fillStyle = dataset
                                                    .borderColor;
                                                ctx.shadowColor = dataset
                                                    .borderColor;
                                                ctx.shadowBlur =
                                                    15; // Increased blur for glow
                                                ctx.globalAlpha = 0.8;
                                                ctx.fill();
                                                ctx.closePath();
                                            });
                                        }
                                    });

                                    ctx.restore();
                                }
                            }]
                        });
                    })
                    .catch(error => console.error('Error fetching counts:', error));
            });
        </script>

    @endsection
