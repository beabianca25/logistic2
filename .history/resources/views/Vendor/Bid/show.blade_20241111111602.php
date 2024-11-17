@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: serif;">
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
                    <a href="{{ route('auction.index') }}" class="btn btn-danger float-end">Back</a>
                </h4>
            </div>
            <div class="container">
                <h1>Bid Details</h1>

                <p><strong>Auction:</strong> {{ $bid->auction->name }}</p>
                <p><strong>Buyer:</strong> {{ $bid->buyer->name }}</p>
                <p><strong>Bid Amount:</strong> ${{ number_format($bid->bid_amount, 2) }}</p>
                <p><strong>Status:</strong> {{ ucfirst($bid->status) }}</p>
                <p><strong>Bid Time:</strong> {{ $bid->bid_time }}</p>

                <a href="{{ route('bids.index') }}" class="btn btn-secondary">Back to All Bids</a>
            </div>
        </div>
    </div>
@endsection
