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
            <div class="container" id="notif-{{ $bid->id }}"> <!-- ID for scrolling -->
                <h1>Bid Details</h1>

                <p><strong>Auction ID:</strong> {{ str_pad(strtoupper(dechex($bid->auction->id)), 4, '0', STR_PAD_LEFT) }}</p>
                
                {{-- Display Buyer Details --}}
                <p><strong>Buyer:</strong> 
                    @if($bid->user_id)
                        {{ $bid->user->name }} (Registered User)
                    @else
                        {{ $bid->guest_name }} (Guest)
                    @endif
                </p>

                @if(!$bid->user_id) 
                    <p><strong>Email:</strong> {{ $bid->guest_email }}</p>
                    <p><strong>Phone:</strong> {{ $bid->guest_phone }}</p>
                @endif

                <p><strong>Bid Amount:</strong> ₱{{ number_format($bid->bid_amount, 2) }}</p>
                <p><strong>Status:</strong> {{ ucfirst($bid->status) }}</p>
                <p><strong>Bid Time:</strong> {{ \Carbon\Carbon::parse($bid->created_at)->format('F j, Y, g:i a') }}</p>

                <a href="{{ route('bid.index') }}" class="btn btn-secondary">Back to All Bids</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let hash = window.location.hash; // Get fragment from URL (e.g., #notif-123)
            
            if (hash) {
                let targetElement = document.querySelector(hash);

                if (targetElement) {
                    targetElement.style.backgroundColor = "#ffff99"; // Temporary highlight
                    targetElement.scrollIntoView({ behavior: "smooth", block: "center" });

                    // Remove highlight after 2 seconds
                    setTimeout(() => {
                        targetElement.style.backgroundColor = "";
                    }, 2000);
                }
            }
        });
    </script>
@endsection
