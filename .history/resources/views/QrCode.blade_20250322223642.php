<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code</title>
</head>
<body>
    <h2>Scan the QR Code to Register as a Supplier</h2>

    {!! $qrCode !!}
    <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code">

    <br>
    <a href="{{ route('supplier.create') }}" target="_blank">Or Click Here to Register</a>
</body>
</html>
