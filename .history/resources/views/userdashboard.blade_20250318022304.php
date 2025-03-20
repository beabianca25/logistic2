@extends('base')

@section('content')
    <div class="container" style="font-family: sans-serif; font-size: small;">
        <h2>Dashboard</h2>

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


@endsection
