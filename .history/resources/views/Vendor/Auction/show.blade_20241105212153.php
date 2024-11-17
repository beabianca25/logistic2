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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header" style="font-size: 0.9rem; font-family: serif;">
                        <h5>Auction Details
                            <a href="{{ route('auction.index') }}" class="btn btn-danger float-end" style="font-size: 0.8rem; font-family: serif;">Back</a>
                        </h5>
                    </div>
                    <div class="card-body" style="font-size: 0.9rem; font-family: serif;">
                        <div>
                            <strong>Category:</strong> {{ $auction->category }}
                        </div>
                        <div>
                            <strong>Year:</strong> {{ $auction->year }}
                        </div>
                        <div>
                            <strong>Description:</strong> {{ $auction->description }}
                        </div>
                        <div>
                            <strong>Condition:</strong> {{ $auction->condition }}
                        </div>
                        <div>
                            <strong>Product Version:</strong> {{ $auction->product_version }}
                        </div>
                        <div>
                            <strong>Company:</strong> {{ $auction->company }}
                        </div>
                        <div>
                            <strong>Pricing:</strong> ${{ $auction->pricing }}
                        </div>
                        <div>
                            <strong>Minimum Estimate Price:</strong> ${{ $auction->min_estimate_price }}
                        </div>
                        <div>
                            <strong>Maximum Estimate Price:</strong> ${{ $auction->max_estimate_price }}
                        </div>
                        <div>
                            <strong>End Date:</strong> {{ $auction->end_date }}
                        </div>
                    
                        <div>
                            @if($auction->photo)
                                <img src="{{ asset('storage/' . $auction->photo) }}" alt="Auction Photo" style="max-width: 300px;">
                            @else
                                <p>No photo available</p>
                            @endif
                        </div>
                    
                        <a href="{{ route('auction.edit', $auction->id) }}" class="btn btn-primary" style="font-size: 0.8rem; font-family: serif;">Edit</a>
                        <a href="{{ route('auction.index') }}" class="btn btn-secondary" style="font-size: 0.8rem; font-family: serif;">Back to Auctions</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
