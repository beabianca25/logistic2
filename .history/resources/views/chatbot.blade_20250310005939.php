<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #chatbox { width: 400px; height: 500px; overflow-y: scroll; border: 1px solid #ccc; padding: 10px; }
        .message { margin-bottom: 10px; }
        .user { color: blue; }
        .bot { color: green; }
    </style>
</head>
<body>

    <div id="chatbox"></div>
    <input type="text" id="message" placeholder="Type a message...">
    <button onclick="sendMessage()">Send</button>

    <script>
        function sendMessage() {
            let message = $('#message').val();
            if (message === '') return;

            $('#chatbox').append('<div class="message user"><strong>You:</strong> ' + message + '</div>');

            $.ajax({
                url: "{{ route('chatbot.chat') }}",
                method: "POST",
                data: { message: message, _token: "{{ csrf_token() }}" },
                success: function(response) {
                    $('#chatbox').append('<div class="message bot"><strong>Bot:</strong> ' + response.reply + '</div>');
                    $('#message').val('');
                }
            });
        }
    </script>

</body>
</html>
