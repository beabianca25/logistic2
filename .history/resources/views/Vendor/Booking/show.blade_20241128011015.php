@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: sans-serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Vendor Portal</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/auction') }}">Auction</a></li>
            <li class="breadcrumb-item active" aria-current="page">Auction Details</li>
        </ol>
    </nav>

    <div class="container">

        <div class="row">
            <div class="card-header">
                <h4>Auction Details
                    <a href="{{ route('bid.index') }}" class="btn btn-danger float-end">Back</a>
                </h4>
            </div>
            <div class="container">
                <h1>Bid Details</h1>

                <p><strong>Auction:</strong> {{ str_pad(strtoupper(dechex($bid->auction->id)), 4, '0', STR_PAD_LEFT) }}</p>
                <p><strong>Buyer:</strong> {{ $bid->user_id }}</p>
                <p><strong>Bid Amount:</strong> ₱{{ number_format($bid->bid_amount, 2) }}</p>
                <p><strong>Status:</strong> {{ ucfirst($bid->status) }}</p>
                <p><strong>Bid Time:</strong>{{ \Carbon\Carbon::parse($bid->created_at)->format('F j, Y, g:i a') }}</p>

                <a href="{{ route('bid.index') }}" class="btn btn-secondary">Back to All Bids</a>
            </div>
        </div>
    </div>

    <script>
        function updateTime(bidId) {
            const createdAt = new Date("{{ \Carbon\Carbon::parse($bid->created_at)->toIso8601String() }}");
            const formattedDate = createdAt.toLocaleString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true
            });
            document.getElementById('real-time-date-' + bidId).innerText = formattedDate;
        }

    </script>
@endsection
