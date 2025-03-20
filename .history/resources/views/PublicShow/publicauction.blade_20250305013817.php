<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Auctions</title>
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
        <a href="{{ url('/') }}" class="btn btn-secondary mb-3">Back</a>
        <h2 class="text-center mb-4">Live Auctions</h2>

        @if($auctions->isEmpty())
            <div class="alert alert-info text-center">No live auctions at the moment.</div>
        @else
            @foreach($auctions as $auction)
                <div class="card">
                    <div class="card-header">
                        {{ $auction->auction_title }}
                    </div>
                    <div class="card-body">
                        <p><strong>Description:</strong> {{ $auction->description }}</p>
                        <p><strong>Minimum Bid:</strong> ${{ number_format($auction->minimum_estimate_price, 2) }}</p>
                        <p><strong>Ends On:</strong> {{ date('F j, Y, g:i a', strtotime($auction->end_date)) }}</p>
                        <a href="{{ route('auction.show', $auction->id) }}" class="btn btn-primary">View & Place Bid</a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</body>
</html>
