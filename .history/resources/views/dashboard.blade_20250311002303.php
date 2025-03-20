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
                <div class="card card-primary">
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
                            <div id="loadingIndicator" style="text-align:center; margin-top: 10px;">Loading...</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Include Chart.js -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom"></script>

            <!-- JavaScript for Bar Chart -->
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
                        url: "{{ route('report.dailyData') }}",
                        method: "GET",
                        success: function(response) {
                            console.log("Response Data:", response);
                            $('#loadingIndicator').hide();

                            if (!response || !response.dates || !response.releaseCounts) {
                                console.error("Missing data in response!");
                                return;
                            }

                            var dates = response.dates;
                            var reservationCounts = response.reservationCounts;
                            var releaseCounts = response.releaseCounts;

                            var barChartData = {
                                labels: dates,
                                datasets: [{
                                        label: 'Daily Reservations',
                                        backgroundColor: 'rgba(75, 192, 192, 0.8)',
                                        data: reservationCounts
                                    },
                                    {
                                        label: 'Total Vehicle Releases',
                                        backgroundColor: 'rgba(255, 99, 132, 0.8)',
                                        data: releaseCounts
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
                                                autoSkip: true, // Auto-skip labels to prevent overcrowding
                                                maxTicksLimit: 10 // Show only 10 labels in 14 weeks
                                            }
                                        },
                                        y: {
                                            beginAtZero: true
                                        }
                                    },
                                    plugins: {
                                        zoom: {
                                            pan: {
                                                enabled: true,
                                                mode: "x"
                                            },
                                            zoom: {
                                                wheel: {
                                                    enabled: true
                                                },
                                                pinch: {
                                                    enabled: true
                                                },
                                                mode: "x"
                                            }
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


            <!-- /.col -->
            <!-- Direct Chat -->
            <div class="col-md-4 d-flex flex-column">
                <div class="card direct-chat direct-chat-primary flex-grow-1">
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

            <!-- JavaScript -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <script>
                // Load saved messages from localStorage
                $(document).ready(function() {
                    if (localStorage.getItem("chatHistory")) {
                        $("#chatbox").html(localStorage.getItem("chatHistory"));
                    } else {
                        // Display welcome message when chat is first loaded
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
                    $('#message').val(''); // Clear input field
                    saveChatHistory(); // Save history

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
                            saveChatHistory(); // Save history after response
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


        <!-- TABLE: LATEST ORDERS -->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
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
                    
                    <div class="col-md-12">
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
                                        @foreach ($bids as $bid)
                                        <tr>
                                            <td><a href="{{ route('bid.show', $bid->id) }}">BID{{ $bid->id }}</a></td>
                                            <td>
                                                {{ $bid->user ? $bid->user->name : $bid->guest_name }}
                                            </td>
                                            <td>{{ $bid->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <span class="badge 
                                                    {{ $bid->status == 'winning' ? 'badge-success' : 
                                                       ($bid->status == 'lost' ? 'badge-danger' : 'badge-secondary') }}">
                                                    {{ ucfirst($bid->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="card-footer clearfix">
                            <a href="{{ route('bid.create') }}" class="btn btn-sm btn-info float-left">Place New Bid</a>
                            <a href="{{ route('bid.index') }}" class="btn btn-sm btn-secondary float-right">View All Bids</a>
                        </div>
                    </div>
                </div>
            </div>
            





            <div class="col-md-6">
                <!-- USERS LIST -->
                <div class="card">
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
                    <!-- /.card-header -->
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

                        <!-- /.users-list -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-center">
                        <a href="{{ route('users.index') }}">View All Users</a>
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
