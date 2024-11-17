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
        <!-- Image Section -->
        <div class="col-md-6">
            <div class="main-image">
                @if($auction->photo)
                    <img src="{{ asset('storage/' . $auction->photo) }}" alt="Auction Photo" style="width:100%; max-width: 400px;">
                @else
                    <p>No photo available</p>
                @endif
            </div>
            <!-- Thumbnail Images (if multiple images are available) -->
            <div class="thumbnail-images mt-3">
                <img src="{{ asset('storage/' . $auction->photo) }}" alt="Thumbnail" class="img-thumbnail" style="width: 75px; margin-right: 5px;">
                <!-- Add more thumbnails if you have multiple images -->
            </div>
        </div>

        <!-- Details Section -->
        <div class="col-md-8">
            <h1 style="font-family: serif; font-size: 1.5rem;">{{ $auction->title }}</h1>
            <p class="text-muted">{{ $auction->short_description }}</p>

            <!-- Auction Details -->
            <div class="auction-details mt-8" style="font-size: 40; font-family: serif;">
                <div><strong>Category:</strong> {{ $auction->category }}</div>
                <div><strong>Year:</strong> {{ $auction->year }}</div>
                <div><strong>Description:</strong> {{ $auction->description }}</div>
                <div><strong>Condition:</strong> {{ $auction->condition }}</div>
                <div><strong>Product Version:</strong> {{ $auction->product_version }}</div>
                <div><strong>Company:</strong> {{ $auction->company }}</div>
                <div><strong>Pricing:</strong> ${{ $auction->pricing }}</div>
                <div><strong>Minimum Estimate Price:</strong> ${{ $auction->min_estimate_price }}</div>
                <div><strong>Maximum Estimate Price:</strong> ${{ $auction->max_estimate_price }}</div>
                <div><strong>End Date:</strong> {{ $auction->end_date }}</div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-4">
                <button class="btn btn-primary" style="font-size: 1rem;">Add to Cart</button>
                <button class="btn btn-success" style="font-size: 1rem;">Place Order</button>
            </div>

            <!-- Social Media Links (optional) -->
            <div class="mt-3">
                <a href="#"><i class="fab fa-facebook-square"></i></a>
                <a href="#"><i class="fab fa-twitter-square"></i></a>
                <a href="#"><i class="fab fa-instagram-square"></i></a>
                <a href="#"><i class="fab fa-pinterest-square"></i></a>
                <a href="#"><i class="fab fa-envelope-square"></i></a>
            </div>
        </div>
    </div>

    <!-- Tabs for Description, Comments, and Rating -->
    <div class="mt-5">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#description">Description</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#comments">Comments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#rating">Rating</a>
            </li>
        </ul>

        <div class="tab-content mt-3">
            <div id="description" class="tab-pane fade show active">
                <p>{{ $auction->description }}</p>
            </div>
            <div id="comments" class="tab-pane fade">
                <p>No comments available.</p>
            </div>
            <div id="rating" class="tab-pane fade">
                <p>No ratings available.</p>
            </div>
        </div>
    </div>
</div>
@endsection
