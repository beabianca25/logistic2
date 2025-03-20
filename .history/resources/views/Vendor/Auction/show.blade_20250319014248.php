@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: sans-serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Vendor Portal</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/auction') }}">Auction</a></li>
            <li class="breadcrumb-item active" aria-current="page">Auction Details</li>
        </ol>
    </nav>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="container">
        <div class="row">
            <div class="card-header">
                <h4>Auction Details
                    <a href="{{ route('auction.index') }}" class="btn btn-danger float-end">Back</a>
                </h4>
            </div>

            <!-- Image Section -->
            <div class="col-md-6">
                <div class="main-image">
                    @if ($auction->photo)
                        <img src="{{ asset('storage/' . $auction->photo) }}" alt="Auction Photo"
                            style="width:100%; max-width: 500px;">
                    @else
                        <p>No photo available</p>
                    @endif
                </div>
                <div class="thumbnail-images mt-3">
                    <img src="{{ asset('storage/' . $auction->photo) }}" alt="Thumbnail" class="img-thumbnail"
                        style="width: 75px; margin-right: 5px;">
                </div>
            </div>

            <!-- Details Section -->
            <div class="col-md-6">
                <h1 style="font-family: sans-serif; font-size: 1.5rem;">{{ $auction->title }}</h1>
                <p class="text-muted">{{ $auction->short_description }}</p>

                <div class="auction-details mt-3" style="font-size: 14px; font-family: sans-serif;">
                    <div><strong>Category:</strong> {{ $auction->category }}</div>
                    <div><strong>Title:</strong> {{ $auction->auction_title }}</div>
                    <div><strong>Year:</strong> {{ $auction->year }}</div>
                    <div><strong>Description:</strong> {{ $auction->description }}</div>
                    <div><strong>Condition:</strong> {{ $auction->condition }}</div>
                    <div><strong>Product Version:</strong> {{ $auction->product_version }}</div>
                    <div><strong>Company:</strong> {{ $auction->company }}</div>
                    <div><strong>Pricing:</strong>
                        <div><strong>Minimum Estimate Price:</strong> ₱{{ number_format($auction->min_estimate_price, 2) }}</div>
                        <div><strong>End Date:</strong> {{ $auction->end_date }}</div>
                    </div>

                    <!-- Bidding Form -->
                    <div class="mt-4">
                        @if (!isset($bid))
                            <form action="{{ route('bid.store', ['auctionId' => $auction->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="auction_id" value="{{ $auction->auction_id }}"> <!-- ✅ Add this -->

                                <div class="form-group">
                                    <label for="bid_amount">Bid Amount</label>
                                    <input type="number" name="bid_amount" id="bid_amount" class="form-control" required
                                        placeholder="Enter your bid"
                                        min="{{ number_format($auction->min_estimate_price, 2) }}">
                                </div>

                                @guest
                                    <div class="form-group">
                                        <label for="guest_name">Your Name</label>
                                        <input type="text" name="guest_name" id="guest_name" class="form-control" required
                                            placeholder="Enter your name">
                                    </div>
                                    <div class="form-group">
                                        <label for="guest_email">Your Email</label>
                                        <input type="email" name="guest_email" id="guest_email" class="form-control" required
                                            placeholder="Enter your email">
                                    </div>
                                    <div class="form-group">
                                        <label for="guest_phone">Your Phone</label>
                                        <input type="text" name="guest_phone" id="guest_phone" class="form-control" required
                                            placeholder="Enter your phone number">
                                    </div>
                                @endguest

                                <button type="submit" class="btn btn-success mt-3">Place Bid</button>
                            </form>
                        @else
                            <div class="alert alert-danger">
                                You have already placed a bid of ₱{{ number_format($bid->bid_amount, 2) }}. Thank you for participating!
                            </div>
                        @endif
                    </div>

                    <!-- Social Media Links -->
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
    </div>

    <!-- SweetAlert2 Script -->
   <!-- SweetAlert2 Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if (session('bid_success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('bid_success') }}',
                showConfirmButton: false,
                timer: 3000
            });
        @endif

        @if (session('bid_error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: '{{ session('bid_error') }}',
                showConfirmButton: false,
                timer: 3000
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Validation Error!',
                html: '<ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>',
                showConfirmButton: true
            });
        @endif
    });
</script>

@endsection
