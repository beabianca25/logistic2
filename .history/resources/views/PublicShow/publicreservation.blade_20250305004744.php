<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Reservations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: auto;
        }
        .card {
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            text-align: center;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Approved Vehicle Reservations</h2>

        @if($reservations->isEmpty())
            <div class="alert alert-info text-center">No approved reservations available.</div>
        @else
            @foreach($reservations as $reservation)
                <div class="card">
                    <div class="card-header">
                        Reservation ID: {{ $reservation->id }}
                    </div>
                    <div class="card-body">
                        <p><strong>Vehicle:</strong> {{ $reservation->vehicle ? $reservation->vehicle->model : 'N/A' }}</p>
                        <p><strong>Pickup Date:</strong> {{ $reservation->reservation_start_date ? date('d/m/Y', strtotime($reservation->start_date)) : 'N/A' }}</p>
                        <p><strong>Return Date:</strong> {{ $reservation->reservation_end_date ? date('d/m/Y', strtotime($reservation->end_date)) : 'N/A' }}</p>
                        <p><strong>Status:</strong> {{ $reservation->status ?? 'N/A' }}</p>
                        <p><strong>Reservation Notes:</strong> {{ $reservation->reservation_notes ?? 'N/A' }}</p>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</body>
</html>
