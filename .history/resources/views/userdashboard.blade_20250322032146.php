@extends('base')

@section('content')
@can('userdashboard')
    
    <div class="container" style="font-family: sans-serif; font-size: small;">
        <h2>Dashboard</h2>

        <!-- Statistics Boxes -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3 id="reservationCount">{{ $reservationCount ?? 0 }}</h3>
                        <p>Reservation Schedule</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <a href="{{ route('reservation.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3 id="bidCount">{{ $bidCount ?? 0 }}</h3>
                        <p>Bid Count</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('bid.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3 id="activeVehicleCount">0</h3>
                        <p>Active Vehicles</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-car"></i>
                    </div>
                    <a href="{{ route('vehicle.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 id="ongoingVehicleReleaseCount">{{ $ongoingReleases ?? 0 }}</h3>
                        <p>Ongoing Vehicles</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-truck"></i>
                    </div>
                    <a href="{{ route('release.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>


        </div>

        <!-- Booking Statistics -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Booking Overview</h4>
                    <canvas id="bookingChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById("bookingChart").getContext("2d");
            var bookingChart = new Chart(ctx, {
                type: "doughnut",
                data: {
                    labels: ["Total", "Pending", "Approved", "Cancelled"],
                    datasets: [{
                        data: [{{ $totalBookings }}, {{ $pendingBookings }},
                            {{ $approvedBookings }}, {{ $cancelledBookings }}
                        ],
                        backgroundColor: ["#007bff", "#ffc107", "#28a745", "#dc3545"]
                    }]
                }
            });
        });

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
                    $("#bidCount").text(response.bidCount || 0);
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

        function fetchOngoingVehicleReleaseCount() {
            $.ajax({
                url: "{{ route('release.ongoing.count') }}",
                method: "GET",
                success: function(response) {
                    $("#ongoingVehicleReleaseCount").text(response.ongoingReleaseCount);
                }
            });
        }

        // Update every second
        setInterval(fetchOngoingVehicleReleaseCount, 1000);

        // Initial fetch
        fetchOngoingVehicleReleaseCount();


        // Refresh every second
        setInterval(updateReservationCount, 1000);
        setInterval(fetchBidCount, 1000);
        setInterval(fetchActiveVehicleCount, 1000);


        // Initial fetch
        updateReservationCount();
        fetchBidCount();
        fetchActiveVehicleCount();
    </script>

     
  <!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- interactive chart -->
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="far fa-chart-bar"></i>
                            Auction Participation Trends
                        </h3>

                        <div class="card-tools">
                            Real time
                            <div class="btn-group" id="realtime" data-toggle="btn-toggle">
                                <button type="button" class="btn btn-default btn-sm active" data-toggle="on">On</button>
                                <button type="button" class="btn btn-default btn-sm" data-toggle="off">Off</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="auctionChart" style="height: 300px;"></canvas>
                    </div>
                    <!-- /.card-body-->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
</section>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById('auctionChart').getContext('2d');

    var auctionChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['2025-03-15', '2025-03-16', '2025-03-17', '2025-03-18', '2025-03-19'],
            datasets: [
                {
                    label: 'Active Auctions',
                    data: [3, 5, 4, 6, 7],
                    borderColor: 'rgba(255, 206, 86, 1)',
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    fill: true
                },
                {
                    label: 'Total Bids per Auction',
                    data: [15, 20, 18, 25, 30],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true
                },
                {
                    label: 'Auctioned Items Sold',
                    data: [8, 12, 10, 15, 18],
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: { title: { display: true, text: 'Auction Dates' } },
                y: { title: { display: true, text: 'Number of Bids' } }
            }
        }
    });
});
</script>







    @endcan


@endsection
