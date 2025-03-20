<!DOCTYPE html>
<html>
<head>
    <title>Send Email</title>
</head>
<body>
    <h2>Send Custom Email</h2>
    <form action="{{ route('email.send') }}" method="POST">
        @csrf
        <label for="email">Recipient Email:</label>
        <input type="email" name="email" required><br><br>

        <label for="subject">Subject:</label>
        <input type="text" name="subject" required><br><br>

        <label for="message">Message:</label>
        <textarea name="message" rows="5" required></textarea><br><br>

        <button type="submit">Send Email</button>
    </form>
</body>
</html>
