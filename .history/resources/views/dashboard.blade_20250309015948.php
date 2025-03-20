@extends('base')

@section('content')
    <div class="container" style="font-family: sans-serif; font-size: small;">
        <h2>Dashboard</h2>
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-teal">
                    <div class="inner">
                        <h3 id="reservationCount">{{ $reservationCount ?? 0 }}</h3>
                        <p>Reservation Schedule</p>

                    </div>
                    <div class="icon">
                        <i class="fas fa-calendar-alt"></i> <!-- Change this to any icon you prefer -->
                    </div>
                    <a href="{{ route('reservation.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                function updateReservationCount() {
                    $.ajax({
                        url: "{{ route('reservation.count') }}", // Route to fetch count
                        type: "GET",
                        success: function(response) {
                            $("#reservationCount").text(response.count); // Update count
                        }
                    });
                }

                // Refresh count every 5 seconds
                setInterval(updateReservationCount, 1000);
            </script>


            <div class="col-lg-3 col-6">
                <div class="small-box bg-cyan">
                    <div class="inner">
                        <h3 id="bidRate">0<sup style="font-size: 20px">%</sup></h3>
                        <p>Bid Rate</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('bid.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                function fetchBidRate() {
                    $.ajax({
                        url: "{{ route('bid.rate') }}",
                        method: "GET",
                        success: function(response) {
                            $("#bidRate").html(response.bidRate + "<sup style='font-size: 20px'>%</sup>");
                        },
                        error: function(error) {
                            console.log("Error fetching bid rate", error);
                        }
                    });
                }

                // Fetch bid rate every 5 seconds
                setInterval(fetchBidRate, 1000);
                fetchBidRate(); // Initial fetch
            </script>



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

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                function fetchActiveVehicleCount() {
                    $.ajax({
                        url: "{{ route('vehicle.active.count') }}", // Create this route in web.php
                        method: "GET",
                        success: function(response) {
                            $("#activeVehicleCount").html(response.activeVehicleCount);
                        },
                        error: function(error) {
                            console.log("Error fetching active vehicle count", error);
                        }
                    });
                }

                // Fetch active vehicle count every 5 seconds
                setInterval(fetchActiveVehicleCount, 1000);
                fetchActiveVehicleCount(); // Initial fetch
            </script>



            <div class="col-lg-3 col-6">
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

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                function fetchPendingDocumentCount() {
                    $.ajax({
                        url: "{{ route('document.pending.count') }}", // Define this route in web.php
                        method: "GET",
                        success: function(response) {
                            $("#pendingDocumentCount").html(response.pendingDocumentCount);
                        },
                        error: function(error) {
                            console.log("Error fetching pending document count", error);
                        }
                    });
                }

                // Fetch pending document count every second
                setInterval(fetchPendingDocumentCount, 1000);
                fetchPendingDocumentCount(); // Initial fetch
            </script>



        </div>


        <div class="row">
            <!-- Browser Usage -->
            <div class="col-md-8">
                <!-- BAR CHART -->
                <!-- Bar Chart Card -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Bar Chart</h3>
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
                            <canvas id="barChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>

                <!-- JavaScript for Bar Chart -->
                <script>
                    $(document).ready(function() {
                        $.ajax({
                            url: "{{ route('reservation.dailyData') }}", // Adjust route if needed
                            method: "GET",
                            success: function(response) {
                                var dates = response.dates;
                                var reservationCounts = response.reservationCounts;
                                var releaseCounts = response.releaseCounts;
                
                                var barChartCanvas = $('#barChart').get(0).getContext('2d');
                
                                var barChartData = {
                                    labels: dates, 
                                    datasets: [
                                        {
                                            label: 'Daily Reservations',
                                            backgroundColor: 'rgba(75, 192, 192, 0.8)',
                                            borderColor: 'rgba(75, 192, 192, 1)',
                                            data: reservationCounts
                                        },
                                        {
                                            label: 'Ongoing Vehicle Releases',
                                            backgroundColor: 'rgba(255, 99, 132, 0.8)',
                                            borderColor: 'rgba(255, 99, 132, 1)',
                                            data: releaseCounts
                                        }
                                    ]
                                };
                
                                var barChartOptions = {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                };
                
                                new Chart(barChartCanvas, {
                                    type: 'bar',
                                    data: barChartData,
                                    options: barChartOptions
                                });
                            }
                        });
                    });
                </script>
                


                <!-- /.card -->
            </div>
            <!-- /.col -->

            <!-- Direct Chat -->
            <div class="col-md-4">
                <div class="card direct-chat direct-chat-primary">
                    <div class="card-header">
                        <h3 class="card-title">Direct Chat</h3>
                        <div class="card-tools">
                            <span title="3 New Messages" class="badge badge-primary">3</span>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
                                <i class="fas fa-comments"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="direct-chat-messages">
                            <div class="direct-chat-msg">
                                <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name float-left">Alexander Pierce</span>
                                    <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                                </div>
                                <img class="direct-chat-img" src="{{ asset('images/JVD-removebg-preview.png') }}"
                                    alt="User Image">
                                <div class="direct-chat-text">Is this template really for free? That's unbelievable!</div>
                            </div>

                            <div class="direct-chat-msg right">
                                <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name float-right">Sarah Bullock</span>
                                    <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                                </div>
                                <img class="direct-chat-img" src="{{ asset('images/JVD-removebg-preview.png') }}"
                                    alt="User Image">
                                <div class="direct-chat-text">You better believe it!</div>
                            </div>

                            <div class="direct-chat-msg">
                                <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name float-left">Alexander Pierce</span>
                                    <span class="direct-chat-timestamp float-right">23 Jan 5:37 pm</span>
                                </div>
                                <img class="direct-chat-img" src="{{ asset('images/JVD-removebg-preview.png') }}"
                                    alt="User Image">
                                <div class="direct-chat-text">Working with AdminLTE on a great new app! Wanna join?</div>
                            </div>

                            <div class="direct-chat-msg right">
                                <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name float-right">Sarah Bullock</span>
                                    <span class="direct-chat-timestamp float-left">23 Jan 6:10 pm</span>
                                </div>
                                <img class="direct-chat-img" src="{{ asset('images/JVD-removebg-preview.png') }}"
                                    alt="User Image">
                                <div class="direct-chat-text">I would love to.</div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <form action="#" method="post">
                            <div class="input-group">
                                <input type="text" name="message" placeholder="Type Message ..."
                                    class="form-control">
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-primary">Send</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var pieChartCanvas = document.getElementById("pieChart").getContext("2d");

                var pieChart = new Chart(pieChartCanvas, {
                    type: "doughnut",
                    data: {
                        labels: ["Chrome", "IE", "FireFox", "Safari", "Opera", "Navigator"],
                        datasets: [{
                            data: [700, 500, 400, 600, 300, 100],
                            backgroundColor: ["#f56954", "#00a65a", "#f39c12", "#00c0ef", "#3c8dbc",
                                "#d2d6de"
                            ],
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            display: false
                        },
                    },
                });

                function fetchPieChartData() {
                    fetch('/api/browser-usage')
                        .then(response => response.json())
                        .then(data => {
                            pieChart.data.datasets[0].data = data.browser_data;
                            pieChart.update();
                            document.getElementById("usa-percentage").innerText = data.usa + "%";
                            document.getElementById("india-percentage").innerText = data.india + "%";
                            document.getElementById("china-percentage").innerText = data.china + "%";
                        })
                        .catch(error => console.error("Error fetching pie chart data:", error));
                }

                setInterval(fetchPieChartData, 5000);
                fetchPieChartData();
            });
        </script>


        <!-- TABLE: LATEST ORDERS -->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header border-transparent">
                        <h3 class="card-title">Latest Bookings</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Name</th>
                                                <th>Book Date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                                <td>Customer Name</td>
                                                <td>
                                                    <div class="sparkbar" data-color="#00a65a" data-height="20">
                                                        October
                                                        30,
                                                        2024
                                                    </div>
                                                </td>
                                                <td><span class="badge badge-success">On Board</span></td>
                                            </tr>

                                            <tr>
                                                <td><a href="pages/examples/invoice.html">OR1848</a></td>
                                                <td>Customer Name</td>
                                                <td>
                                                    <div class="sparkbar" data-color="#00a65a" data-height="20">
                                                        December
                                                        23,
                                                        2024
                                                    </div>
                                                </td>
                                                <td><span class="badge badge-success">Scheduled</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New
                                    Order</a>
                                <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All
                                    Orders</a>
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>


            <!-- DIRECT CHAT -->



            <div class="col-md-6">
                <!-- USERS LIST -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Latest Members</h3>

                        <div class="card-tools">
                            <span class="badge badge-danger">8 New Members</span>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <ul class="users-list clearfix">
                            <li>
                                <img class="direct-chat-img" src="{{ asset('images/JVD-removebg-preview.png') }}"
                                    alt="message user image">
                                <a class="users-list-name" href="#">Alexander Pierce</a>
                                <span class="users-list-date">Today</span>
                            </li>
                            <li>
                                <img class="direct-chat-img" src="{{ asset('images/JVD-removebg-preview.png') }}"
                                    alt="message user image">
                                <a class="users-list-name" href="#">Norman</a>
                                <span class="users-list-date">Yesterday</span>
                            </li>
                            <li>
                                <img class="direct-chat-img" src="{{ asset('images/JVD-removebg-preview.png') }}"
                                    alt="message user image">
                                <a class="users-list-name" href="#">Jane</a>
                                <span class="users-list-date">12 Jan</span>
                            </li>
                            <li>
                                <img class="direct-chat-img" src="{{ asset('images/JVD-removebg-preview.png') }}"
                                    alt="message user image">
                                <a class="users-list-name" href="#">John</a>
                                <span class="users-list-date">12 Jan</span>
                            </li>
                            <li>
                                <img class="direct-chat-img" src="{{ asset('images/JVD-removebg-preview.png') }}"
                                    alt="message user image">
                                <a class="users-list-name" href="#">Alexander</a>
                                <span class="users-list-date">13 Jan</span>
                            </li>
                            <li>
                                <img class="direct-chat-img" src="{{ asset('images/JVD-removebg-preview.png') }}"
                                    alt="message user image">
                                <a class="users-list-name" href="#">Sarah</a>
                                <span class="users-list-date">14 Jan</span>
                            </li>
                            <li>
                                <img class="direct-chat-img" src="{{ asset('images/JVD-removebg-preview.png') }}"
                                    alt="message user image">
                                <a class="users-list-name" href="#">Nora</a>
                                <span class="users-list-date">15 Jan</span>
                            </li>
                            <li>
                                <img class="direct-chat-img" src="{{ asset('images/JVD-removebg-preview.png') }}"
                                    alt="message user image">
                                <a class="users-list-name" href="#">Nadia</a>
                                <span class="users-list-date">15 Jan</span>
                            </li>
                        </ul>
                        <!-- /.users-list -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-center">
                        <a href="javascript:">View All Users</a>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!--/.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
@endsection
