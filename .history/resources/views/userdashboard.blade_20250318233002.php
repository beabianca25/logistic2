@extends('base')

@section('content')
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
                <div class="small-box bg-pink">
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
                <div class="small-box bg-indigo">
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
@endsection
