@extends('base')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Vendor Portal</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/auction') }}">Auction</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol>
</nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Auction Request
                            <a href="{{ route('auction.index') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('bids.update', $bid->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                
                            <div class="mb-3">
                                <label for="auction_id" class="form-label">Auction</label>
                                <select class="form-select" id="auction_id" name="auction_id" required>
                                    @foreach($auctions as $auction)
                                        <option value="{{ $auction->id }}" {{ $auction->id == $bid->auction_id ? 'selected' : '' }}>
                                            {{ $auction->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                
                            <div class="mb-3">
                                <label for="buyer_id" class="form-label">Buyer</label>
                                <select class="form-select" id="buyer_id" name="buyer_id" required>
                                    @foreach($buyers as $buyer)
                                        <option value="{{ $buyer->id }}" {{ $buyer->id == $bid->buyer_id ? 'selected' : '' }}>
                                            {{ $buyer->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                
                            <div class="mb-3">
                                <label for="bid_amount" class="form-label">Bid Amount</label>
                                <input type="number" class="form-control" id="bid_amount" name="bid_amount" value="{{ $bid->bid_amount }}" required step="0.01" min="0">
                            </div>
                
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="pending" {{ $bid->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="accepted" {{ $bid->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                                    <option value="rejected" {{ $bid->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </div>
                
                            <button type="submit" class="btn btn-warning">Update Bid</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
