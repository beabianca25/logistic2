<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Public Vehicle Information</title>
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
        .back-btn {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ url('/') }}" class="btn btn-secondary back-btn">Back</a>
        <h2 class="text-center mb-4">Available Vehicles</h2>

        @if($vehicles->isEmpty())
            <div class="alert alert-info text-center">No vehicles available at the moment.</div>
        @else
            @foreach($vehicles as $vehicle)
                <div class="card">
                    <div class="card-header">
                        {{ $vehicle->id }} ({{ $vehicle->type }})
                    </div>
                    <div class="card-body">
                        <p><strong>Model:</strong> {{ $vehicle->model }}</p>
                        <p><strong>Seating Capacity:</strong> {{ $vehicle->capacity }}</p>
                        <p><strong>Status:</strong> {{ $vehicle->current_status }}
                            <span class="badge bg-success"></span>
                        </p>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</body>
</html>
