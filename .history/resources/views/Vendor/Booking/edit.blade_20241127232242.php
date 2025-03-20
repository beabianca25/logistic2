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
                            <a href="{{ route('bid.index') }}" class="btn btn-danger float-end">Back</a>
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

                        <form action="{{ route('bid.update', $bid->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="auction_id" class="form-label">Auction</label>
                                <select class="form-select" id="auction_id" name="auction_id" required>
                                    @foreach ($auctions as $auction)
                                        <option value="{{ $auction->id }}"
                                            {{ old('auction_id', $bid->auction->id) == $auction->category}}>
                                            {{ $auction->category }} - ({{ $auction->auction_title }})  
                                        </option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="mb-3">
                                <label for="user_id" class="form-label">User</label>
                                <select class="form-select" id="user_id" name="user_id" required>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ $user->id == $bid->user_id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="bid_amount" class="form-label">Bid Amount</label>
                                <input type="number" class="form-control" id="bid_amount" name="bid_amount"
                                    value="{{ $bid->bid_amount }}" required step="0.01" min="0">
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="pending" {{ $bid->status == 'pending' ? 'selected' : '' }}>
                                        Pending: The bid has been placed and is waiting to be processed or reviewed.
                                    </option>
                                    <option value="active" {{ $bid->status == 'active' ? 'selected' : '' }}>
                                        Active: The bid is currently in the running and competing with other bids.
                                    </option>
                                    <option value="outbid" {{ $bid->status == 'outbid' ? 'selected' : '' }}>
                                        Outbid: Another bid has been placed that is higher than yours.
                                    </option>
                                    <option value="winning" {{ $bid->status == 'winning' ? 'selected' : '' }}>
                                        Winning: Your bid is currently the highest and winning.
                                    </option>
                                    <option value="reserve not met" {{ $bid->status == 'reserve not met' ? 'selected' : '' }}>
                                        Reserve Not Met: Your bid is the highest but does not meet the minimum reserve price set by the seller.
                                    </option>
                                    <option value="cancelled" {{ $bid->status == 'cancelled' ? 'selected' : '' }}>
                                        Cancelled: The bid has been withdrawn by you or cancelled by the auctioneer.
                                    </option>
                                    <option value="closed" {{ $bid->status == 'closed' ? 'selected' : '' }}>
                                        Closed: The auction has ended.
                                    </option>
                                    <option value="winning bid" {{ $bid->status == 'winning bid' ? 'selected' : '' }}>
                                        Winning Bid: Your bid has won the auction.
                                    </option>
                                    <option value="losing bid" {{ $bid->status == 'losing bid' ? 'selected' : '' }}>
                                        Losing Bid: Your bid did not win the auction.
                                    </option>
                                    <option value="awarded" {{ $bid->status == 'awarded' ? 'selected' : '' }}>
                                        Awarded: The bid has been officially awarded to you.
                                    </option>
                                    <option value="completed" {{ $bid->status == 'completed' ? 'selected' : '' }}>
                                        Completed: The transaction is finalized, and the item or contract is officially yours.
                                    </option>
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
