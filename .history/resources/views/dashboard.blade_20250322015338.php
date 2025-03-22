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
            <style>
                .floating-card {
                    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
                    /* Floating effect */
                    border-radius: 12px;
                    /* Smooth rounded corners */
                    background: #ffffff;
                    transition: 0.3s ease-in-out;
                }

                .floating-card:hover {
                    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3);
                    /* Slightly deeper shadow on hover */
                }

                .card-header h3 {
                    font-size: 16px;
                    /* Smaller font size */
                    font-weight: 600;
                    color: #333;
                }

                .card-tools i {
                    font-size: 14px;
                    /* Reduce icon size for better proportion */
                }

                .chart {
                    padding: 10px;
                }
            </style>

            <div class="col-md-8">
                <div class="card floating-card">
                    <div class="card-header">
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
                            <canvas id="barChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            <div id="loadingIndicator" style="text-align:center; margin-top: 10px; font-size: 14px;">
                                Loading...</div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom"></script>

            <script>
                $(document).ready(function() {
                    let barChartCanvas = document.getElementById('barChart');

                    if (!barChartCanvas) {
                        console.error("Error: #barChart canvas not found!");
                        return;
                    }

                    let ctx = barChartCanvas.getContext('2d');
                    $('#loadingIndicator').show();

                    $.ajax({
                        url: "{{ route('report.bookingStatusData') }}",
                        method: "GET",
                        success: function(response) {
                            console.log("Response Data:", response);
                            $('#loadingIndicator').hide();

                            if (!response || !response.months || !response.statusCounts) {
                                console.error("Missing data in response!");
                                return;
                            }

                            var months = response.months;
                            var statusCounts = response.statusCounts;

                            var barChartData = {
                                labels: months,
                                datasets: [{
                                        label: 'Pending',
                                        backgroundColor: 'rgba(255, 206, 86, 0.8)',
                                        data: statusCounts['Pending']
                                    },
                                    {
                                        label: 'Approved',
                                        backgroundColor: 'rgba(75, 192, 192, 0.8)',
                                        data: statusCounts['Approved']
                                    },
                                    {
                                        label: 'Scheduled',
                                        backgroundColor: 'rgba(54, 162, 235, 0.8)',
                                        data: statusCounts['Scheduled']
                                    },
                                    {
                                        label: 'Ongoing',
                                        backgroundColor: 'rgba(153, 102, 255, 0.8)',
                                        data: statusCounts['Ongoing']
                                    },
                                    {
                                        label: 'Completed',
                                        backgroundColor: 'rgba(0, 255, 0, 0.8)',
                                        data: statusCounts['Completed']
                                    },
                                    {
                                        label: 'Cancelled',
                                        backgroundColor: 'rgba(255, 99, 132, 0.8)',
                                        data: statusCounts['Cancelled']
                                    }
                                ]
                            };

                            new Chart(ctx, {
                                type: 'bar',
                                data: barChartData,
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    scales: {
                                        x: {
                                            ticks: {
                                                autoSkip: true,
                                                maxTicksLimit: 12
                                            }
                                        },
                                        y: {
                                            beginAtZero: true
                                        }
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



            <style>
                .floating-chat {
                    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
                    /* Floating effect */
                    border-radius: 12px;
                    /* Smooth rounded corners */
                    background: #fff;
                    transition: 0.3s ease-in-out;
                }

                .floating-chat:hover {
                    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.25);
                    /* Deeper shadow on hover */
                }

                .card-header h3 {
                    font-size: 14px;
                    /* Smaller font */
                    font-weight: 600;
                    color: #333;
                    margin-bottom: 0;
                }

                .card-tools i {
                    font-size: 14px;
                    /* Reduce icon size */
                }

                .direct-chat-messages {
                    font-size: 13px;
                    /* Smaller chat text */
                    padding: 10px;
                    background: #f9f9f9;
                    border-radius: 8px;
                }

                .direct-chat-text {
                    font-size: 13px;
                    padding: 6px 10px;
                    border-radius: 6px;
                    display: inline-block;
                    max-width: 80%;
                }

                .input-group input {
                    font-size: 13px;
                    padding: 8px;
                }

                .btn-primary {
                    font-size: 13px;
                    padding: 6px 10px;
                    border-radius: 6px;
                }
            </style>

            <div class="col-md-4 d-flex flex-column">
                <div class="card direct-chat direct-chat-primary floating-chat flex-grow-1">
                    <div class="card-header">
                        <h3 class="card-title">Customer Assistance</h3>
                        <div class="card-tools">
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
                    <div class="card-body">
                        <div id="chatbox" class="direct-chat-messages" style="height: 245px; overflow-y: auto;"></div>
                    </div>
                    <div class="card-footer">
                        <div class="input-group">
                            <input type="text" id="message" placeholder="Type a message..." class="form-control">
                            <span class="input-group-append">
                                <button type="button" class="btn btn-primary" onclick="sendMessage()">Send</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <script>
                $(document).ready(function() {
                    if (localStorage.getItem("chatHistory")) {
                        $("#chatbox").html(localStorage.getItem("chatHistory"));
                    } else {
                        let welcomeMessage = '<div class="direct-chat-msg">' +
                            '<div class="direct-chat-infos clearfix">' +
                            '<span class="direct-chat-name float-left">JVD Bot</span>' +
                            '</div>' +
                            '<div class="direct-chat-text">Welcome to JVD Event and Travel Management! 🚗✈️ How can I assist you today?</div>' +
                            '</div>';
                        $("#chatbox").append(welcomeMessage);
                        saveChatHistory();
                    }
                });

                function sendMessage(message = null) {
                    let inputMessage = message || $('#message').val();
                    if (inputMessage === '') return;

                    let userMessage = '<div class="direct-chat-msg right">' +
                        '<div class="direct-chat-infos clearfix">' +
                        '<span class="direct-chat-name float-right">You</span>' +
                        '</div>' +
                        '<div class="direct-chat-text">' + inputMessage + '</div>' +
                        '</div>';

                    $('#chatbox').append(userMessage);
                    $('#message').val('');
                    saveChatHistory();

                    $.ajax({
                        url: "{{ route('chatbot.chat') }}",
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            message: inputMessage
                        },
                        success: function(response) {
                            let botMessage = '<div class="direct-chat-msg">' +
                                '<div class="direct-chat-infos clearfix">' +
                                '<span class="direct-chat-name float-left">JVD Bot</span>' +
                                '</div>' +
                                '<div class="direct-chat-text">' + response.reply + '</div>' +
                                '</div>';

                            $('#chatbox').append(botMessage);
                            saveChatHistory();
                        }
                    });
                }

                function sendSuggestedMessage(question) {
                    sendMessage(question);
                }

                function saveChatHistory() {
                    localStorage.setItem("chatHistory", $("#chatbox").html());
                }
            </script>


        </div>

        <style>
            .floating-card {
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
                /* Floating effect */
                border-radius: 12px;
                /* Smooth rounded corners */
                background: #fff;
                transition: 0.3s ease-in-out;
            }

            .floating-card:hover {
                box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.25);
                /* Deeper shadow on hover */
            }

            .card-header h3 {
                font-size: 14px;
                /* Smaller font */
                font-weight: 600;
                color: #333;
                margin-bottom: 0;
            }

            .card-tools i {
                font-size: 14px;
                /* Reduce icon size */
            }

            .table {
                font-size: 13px;
                /* Smaller table font */
            }

            .table th,
            .table td {
                padding: 8px;
                /* Reduce padding */
            }

            .badge {
                font-size: 11px;
                /* Smaller badge text */
                padding: 5px 8px;
                border-radius: 5px;
            }

            .users-list {
                font-size: 13px;
                /* Smaller font size for user list */
            }

            .users-list li {
                display: inline-block;
                text-align: center;
                width: 25%;
                padding: 10px;
            }

            .users-list img {
                width: 45px;
                height: 45px;
                border-radius: 50%;
                object-fit: cover;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .users-list-name {
                font-size: 13px;
                display: block;
                margin-top: 5px;
                font-weight: 500;
            }

            .users-list-date {
                font-size: 11px;
                color: #777;
            }
        </style>

        <!-- LATEST AUCTION BIDS -->
        <div class="row">
            <div class="col-md-6">
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
                                                <td>
                                                    <a
                                                        href="{{ route('bid.show', $bid->id) }}">BID{{ $bid->id }}</a>
                                                </td>
                                                <td>{{ $bid->user->name ?? 'Guest' }}</td>
                                                <td>{{ $bid->created_at->format('M d, Y') }}</td>
                                                <td>
                                                    <span
                                                        class="badge 
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
                                <h3 class="card-title">Vendor, Supplier, and Subcontractor Applications</h3>
                                <a href="javascript:void(0);">View Report</a>
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
   document.addEventListener("DOMContentLoaded", function () {
    fetch('/get-applications-count') // Fetch real data from Laravel backend
        .then(response => response.json())
        .then(data => {
            var ctx = document.getElementById('applications-chart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.dates, // Use real dates from backend
                    datasets: [
                        {
                            label: 'Vendors',
                            borderColor: 'blue',
                            backgroundColor: 'rgba(0, 123, 255, 0.2)',
                            data: data.vendors, // Real vendor data
                            fill: false,
                            tension: 0.4
                        },
                        {
                            label: 'Suppliers',
                            borderColor: 'green',
                            backgroundColor: 'rgba(0, 200, 100, 0.2)',
                            data: data.suppliers, // Real supplier data
                            fill: false,
                            tension: 0.4
                        },
                        {
                            label: 'Subcontractors',
                            borderColor: 'red',
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            data: data.subcontractors, // Real subcontractor data
                            fill: false,
                            tension: 0.4
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching counts:', error));
});

    </script>
    
    
@endsection
