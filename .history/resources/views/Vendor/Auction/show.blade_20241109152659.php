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
        <div class="col-md-6">
            <h1 style="font-family: serif; font-size: 1.5rem;">{{ $auction->title }}</h1>
            <p class="text-muted">{{ $auction->short_description }}</p>

            <div class="available-colors mt-4">
                <h6>Available Colors</h6>
                <!-- Replace with dynamic color options if available -->
                <button class="btn btn-sm" style="background-color: green; color: white;">Green</button>
                <button class="btn btn-sm" style="background-color: blue; color: white;">Blue</button>
                <button class="btn btn-sm" style="background-color: purple; color: white;">Purple</button>
                <button class="btn btn-sm" style="background-color: red; color: white;">Red</button>
                <button class="btn btn-sm" style="background-color: orange; color: white;">Orange</button>
            </div>

            <div class="size-options mt-3">
                <h6>Size</h6>
                <!-- Replace with dynamic size options if available -->
                <button class="btn btn-outline-secondary btn-sm">S</button>
                <button class="btn btn-outline-secondary btn-sm">M</button>
                <button class="btn btn-outline-secondary btn-sm">L</button>
                <button class="btn btn-outline-secondary btn-sm">XL</button>
            </div>

            <h3 class="mt-4" style="font-weight: bold;">${{ $auction->pricing }}</h3>
            <p>Ex Tax: ${{ number_format($auction->pricing * 0.8, 2) }}</p>

            <!-- Action Buttons -->
            <div class="mt-4">
                <button class="btn btn-primary" style="font-size: 1rem;">Add to Cart</button>
                <button class="btn btn-secondary" style="font-size: 1rem;">Add to Wishlist</button>
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
