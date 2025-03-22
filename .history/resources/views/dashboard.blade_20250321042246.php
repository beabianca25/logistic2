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
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Floating shadow effect */
                border-radius: 10px;
                padding: 15px;
                transition: all 0.3s ease-in-out;
                font-size: 14px; /* Adjusted font size */
            }
        
            .small-box:hover {
                box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
                transform: translateY(-3px);
            }
        
            .small-box h3 {
                font-size: 20px; /* Adjusted heading size */
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
                    <a href="{{ route('reservation.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                    <a href="{{ route('bid.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                    <a href="{{ route('vehicle.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                    <a href="{{ route('document.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
            <!-- Vehicle Usage Chart -->
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Daily Vehicle Usage Overview</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool text-white" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool text-white" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="barChart" style="height: 250px; max-width: 100%;"></canvas>
                            <div id="loadingIndicator" class="text-center mt-2 text-muted">Loading...</div>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- Customer Assistance Chat -->
            <div class="col-md-4 d-flex flex-column">
                <div class="card direct-chat shadow-lg border-0 flex-grow-1">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Customer Assistance</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool text-white" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool text-white" title="Contacts" data-widget="chat-pane-toggle">
                                <i class="fas fa-comments"></i>
                            </button>
                            <button type="button" class="btn btn-tool text-white" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body" style="height: 250px; overflow-y: auto;">
                        <div id="chatbox" class="direct-chat-messages"></div>
                    </div>
                    <div class="card-footer">
                        <div class="input-group">
                            <input type="text" id="message" placeholder="Type a message..." class="form-control border-0">
                            <span class="input-group-append">
                                <button type="button" class="btn btn-primary" onclick="sendMessage()">Send</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Include Chart.js & jQuery -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        
        <!-- JavaScript for Bar Chart -->
        <script>
        $(document).ready(function() {
            let ctx = document.getElementById('barChart').getContext('2d');
            $('#loadingIndicator').show();
        
            $.ajax({
                url: "{{ route('report.bookingStatusData') }}",
                method: "GET",
                success: function(response) {
                    $('#loadingIndicator').hide();
                    if (!response || !response.months || !response.statusCounts) return;
        
                    let barChartData = {
                        labels: response.months,
                        datasets: [
                            { label: 'Pending', backgroundColor: '#FFCE56', data: response.statusCounts['Pending'] },
                            { label: 'Approved', backgroundColor: '#4BC0C0', data: response.statusCounts['Approved'] },
                            { label: 'Scheduled', backgroundColor: '#36A2EB', data: response.statusCounts['Scheduled'] },
                            { label: 'Ongoing', backgroundColor: '#9966FF', data: response.statusCounts['Ongoing'] },
                            { label: 'Completed', backgroundColor: '#00FF00', data: response.statusCounts['Completed'] },
                            { label: 'Cancelled', backgroundColor: '#FF6384', data: response.statusCounts['Cancelled'] }
                        ]
                    };
        
                    new Chart(ctx, {
                        type: 'bar',
                        data: barChartData,
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: { y: { beginAtZero: true } }
                        }
                    });
                },
                error: function() { console.error("Failed to load data"); }
            });
        });
        </script>
        
        <!-- JavaScript for Chatbot -->
        <script>
        $(document).ready(function() {
            let chatbox = $("#chatbox");
            let savedChat = localStorage.getItem("chatHistory");
            chatbox.html(savedChat || '<div class="direct-chat-msg"><div class="direct-chat-text">Welcome to JVD Event and Travel Management! 🚗✈️ How can I assist you today?</div></div>');
        });
        
        function sendMessage() {
            let message = $('#message').val().trim();
            if (!message) return;
            
            $('#chatbox').append('<div class="direct-chat-msg right"><div class="direct-chat-text">' + message + '</div></div>');
            $('#message').val('');
            saveChatHistory();
            
            $.post("{{ route('chatbot.chat') }}", { message: message, _token: $('meta[name="csrf-token"]').attr('content') }, function(response) {
                $('#chatbox').append('<div class="direct-chat-msg"><div class="direct-chat-text">' + response.reply + '</div></div>');
                saveChatHistory();
            });
        }
        
        function saveChatHistory() {
            localStorage.setItem("chatHistory", $("#chatbox").html());
        }
        </script>
        


        <!-- TABLE: LATEST AUCTION BIDS -->
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
