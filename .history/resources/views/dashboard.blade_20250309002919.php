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
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Monthly Recap Report</h5>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <div class="btn-group">
                                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                    <i class="fas fa-wrench"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" role="menu">
                                    <a href="#" class="dropdown-item">Action</a>
                                    <a href="#" class="dropdown-item">Another action</a>
                                    <a href="#" class="dropdown-item">Something else here</a>
                                    <a class="dropdown-divider"></a>
                                    <a href="#" class="dropdown-item">Separated link</a>
                                </div>
                            </div>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <p class="text-center">
                                    <strong>Sales: 1 Jan, 2024 - 30 Jul, 2024</strong>
                                </p>
                                <div class="chart">

                                    <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                                </div>

                            </div>

                            <div class="col-md-4">
                                <p class="text-center">
                                    <strong>Goal Completion</strong>
                                </p>


                                <div class="progress-group">
                                    Upcoming Schedule
                                    <span class="float-right">
                                        <b id="upcoming-count" data-count="{{ $upcomingCount ?? 0 }}">
                                            {{ $upcomingCount ?? 0 }}
                                        </b> / 200
                                    </span>                                   
                                    <div class="progress progress-sm">
                                        <div id="upcoming-progress" class="progress-bar bg-fuchsia" style="width: 0%;"></div>
                                    </div>
                                </div>
                                
                                <script>
                                   document.addEventListener("DOMContentLoaded", function() {
    setTimeout(() => {
        let upcomingCountElement = document.getElementById('upcoming-count');
        if (!upcomingCountElement) {
            console.error("Element #upcoming-count not found");
            return;
        }

        let upcomingCount = parseInt(upcomingCountElement.getAttribute('data-count')) || 0;
        console.log("Upcoming Count:", upcomingCount);

        let maxCount = 200;
        let percentage = (upcomingCount / maxCount) * 100;
        console.log("Progress Percentage:", percentage);

        let progressBar = document.getElementById('upcoming-progress');
        if (progressBar) {
            progressBar.style.width = percentage + "%";
            progressBar.setAttribute("aria-valuenow", percentage);
        } else {
            console.error("Progress bar element not found");
        }
    }, 500);
});

                                </script>
                                






                                <div class="progress-group">
                                    Complete Purchase
                                    <span class="float-right"><b>310</b>/400</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-lime" style="width: 75%"></div>
                                    </div>
                                </div>

                                <div class="progress-group">
                                    <span class="progress-text">Ongoing Schedule</span>
                                    <span class="float-right"><b>480</b>/800</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-info" style="width: 60%"></div>
                                    </div>
                                </div>

                                <div class="progress-group">
                                    Send Inquiries
                                    <span class="float-right"><b>250</b>/500</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-warning" style="width: 50%"></div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-3 col-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-success"><i class="fas fa-caret-up"></i>
                                        17%</span>
                                    <h5 class="description-header">$35,210.43</h5>
                                    <span class="description-text">TOTAL REVENUE</span>
                                </div>

                            </div>

                            <div class="col-sm-3 col-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i>
                                        0%</span>
                                    <h5 class="description-header">$10,390.90</h5>
                                    <span class="description-text">TOTAL COST</span>
                                </div>

                            </div>

                            <div class="col-sm-3 col-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-success"><i class="fas fa-caret-up"></i>
                                        20%</span>
                                    <h5 class="description-header">$24,813.53</h5>
                                    <span class="description-text">TOTAL PROFIT</span>
                                </div>

                            </div>

                            <div class="col-sm-3 col-6">
                                <div class="description-block">
                                    <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i>
                                        18%</span>
                                    <h5 class="description-header">1200</h5>
                                    <span class="description-text">GOAL COMPLETIONS</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


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
                        <!-- Conversations are loaded here -->
                        <div class="direct-chat-messages">
                            <!-- Message. Default to the left -->
                            <div class="direct-chat-msg">
                                <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name float-left">Alexander Pierce</span>
                                    <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                                </div>
                                <!-- /.direct-chat-infos -->
                                <img class="direct-chat-img" src="{{ asset('images/JVD-removebg-preview.png') }}"
                                    alt="message user image">

                                <!-- /.direct-chat-img -->
                                <div class="direct-chat-text">
                                    Is this template really for free? That's unbelievable!
                                </div>
                                <!-- /.direct-chat-text -->
                            </div>
                            <!-- /.direct-chat-msg -->

                            <!-- Message to the right -->
                            <div class="direct-chat-msg right">
                                <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name float-right">Sarah Bullock</span>
                                    <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                                </div>
                                <!-- /.direct-chat-infos -->
                                <img class="direct-chat-img" src="{{ asset('images/JVD-removebg-preview.png') }}"
                                    alt="message user image">
                                <!-- /.direct-chat-img -->
                                <div class="direct-chat-text">
                                    You better believe it!
                                </div>
                                <!-- /.direct-chat-text -->
                            </div>
                            <!-- /.direct-chat-msg -->

                            <!-- Message. Default to the left -->
                            <div class="direct-chat-msg">
                                <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name float-left">Alexander Pierce</span>
                                    <span class="direct-chat-timestamp float-right">23 Jan 5:37 pm</span>
                                </div>
                                <!-- /.direct-chat-infos -->
                                <img class="direct-chat-img" src="{{ asset('images/JVD-removebg-preview.png') }}"
                                    alt="message user image">
                                <!-- /.direct-chat-img -->
                                <div class="direct-chat-text">
                                    Working with AdminLTE on a great new app! Wanna join?
                                </div>
                                <!-- /.direct-chat-text -->
                            </div>
                            <!-- /.direct-chat-msg -->

                            <!-- Message to the right -->
                            <div class="direct-chat-msg right">
                                <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name float-right">Sarah Bullock</span>
                                    <span class="direct-chat-timestamp float-left">23 Jan 6:10 pm</span>
                                </div>
                                <!-- /.direct-chat-infos -->
                                <img class="direct-chat-img" src="{{ asset('images/JVD-removebg-preview.png') }}"
                                    alt="message user image">
                                <!-- /.direct-chat-img -->
                                <div class="direct-chat-text">
                                    I would love to.
                                </div>
                                <!-- /.direct-chat-text -->
                            </div>
                            <!-- /.direct-chat-msg -->

                        </div>

                        <div class="direct-chat-contacts">
                            <ul class="contacts-list">
                                <li>
                                    <a href="#">
                                        <img class="direct-chat-img" src="{{ asset('images/JVD-removebg-preview.png') }}"
                                            alt="message user image">
                                        alt="User Avatar">

                                        <div class="contacts-list-info">
                                            <span class="contacts-list-name">
                                                Count Dracula
                                                <small class="contacts-list-date float-right">2/28/2015</small>
                                            </span>
                                            <span class="contacts-list-msg">How have you been? I
                                                was...</span>
                                        </div>
                                        <!-- /.contacts-list-info -->
                                    </a>
                                </li>
                                <!-- End Contact Item -->
                                <li>
                                    <a href="#">
                                        <img class="contacts-list-img" src="#" alt="User Avatar">

                                        <div class="contacts-list-info">
                                            <span class="contacts-list-name">
                                                Sarah Doe
                                                <small class="contacts-list-date float-right">2/23/2015</small>
                                            </span>
                                            <span class="contacts-list-msg">I will be waiting for...</span>
                                        </div>
                                        <!-- /.contacts-list-info -->
                                    </a>
                                </li>
                                <!-- End Contact Item -->
                                <li>
                                    <a href="#">
                                        <img class="contacts-list-img" src="#" alt="User Avatar">

                                        <div class="contacts-list-info">
                                            <span class="contacts-list-name">
                                                Nadia Jolie
                                                <small class="contacts-list-date float-right">2/20/2015</small>
                                            </span>
                                            <span class="contacts-list-msg">I'll call you back at...</span>
                                        </div>
                                        <!-- /.contacts-list-info -->
                                    </a>
                                </li>
                                <!-- End Contact Item -->
                                <li>
                                    <a href="#">
                                        <img class="contacts-list-img" src="dist/img/user5-128x128.jpg"
                                            alt="User Avatar">

                                        <div class="contacts-list-info">
                                            <span class="contacts-list-name">
                                                Nora S. Vans
                                                <small class="contacts-list-date float-right">2/10/2015</small>
                                            </span>
                                            <span class="contacts-list-msg">Where is your new...</span>
                                        </div>
                                        <!-- /.contacts-list-info -->
                                    </a>
                                </li>
                                <!-- End Contact Item -->
                                <li>
                                    <a href="#">
                                        <img class="contacts-list-img" src="dist/img/user6-128x128.jpg"
                                            alt="User Avatar">

                                        <div class="contacts-list-info">
                                            <span class="contacts-list-name">
                                                John K.
                                                <small class="contacts-list-date float-right">1/27/2015</small>
                                            </span>
                                            <span class="contacts-list-msg">Can I take a look at...</span>
                                        </div>
                                        <!-- /.contacts-list-info -->
                                    </a>
                                </li>
                                <!-- End Contact Item -->
                                <li>
                                    <a href="#">
                                        <img class="contacts-list-img" src="dist/img/user8-128x128.jpg"
                                            alt="User Avatar">

                                        <div class="contacts-list-info">
                                            <span class="contacts-list-name">
                                                Kenneth M.
                                                <small class="contacts-list-date float-right">1/4/2015</small>
                                            </span>
                                            <span class="contacts-list-msg">Never mind I found...</span>
                                        </div>
                                        <!-- /.contacts-list-info -->
                                    </a>
                                </li>
                                <!-- End Contact Item -->
                            </ul>
                            <!-- /.contacts-list -->
                        </div>
                        <!-- /.direct-chat-pane -->
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
                    <!-- /.card-footer-->
                </div>
                <!--/.direct-chat -->
            </div>
        </div>

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
