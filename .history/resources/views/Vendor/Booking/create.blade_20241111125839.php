@extends('base')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Vendor Portal</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/auction') }}">Auction</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Auction</li>
    </ol>
</nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create New Auction
                            <a href="{{ route('bid.index') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        {{-- @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif --}}

                        <form action="{{ route('bid.store') }}" method="POST">
                            @csrf
                
                            <!-- Auction Selection -->
                            <div class="form-group">
                                <label for="auction_id">Auction</label>
                                <select name="auction_id" id="auction_id" class="form-control" required>
                                    <option value="" disabled selected>Select an Auction</option>
                                    @foreach($auctions as $auction)
                                        <option value="{{ $auction->id }}">{{ $auction->auction_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                
                            <!-- Buyer Selection -->
                            <div class="form-group">
                                <label for="buyer_id">Buyer</label>
                                <select name="buyer_id" id="buyer_id" class="form-control" required>
                                    <option value="" disabled selected>Select a Buyer</option>
                                    @foreach($buyers as $buyer)
                                        <option value="{{ $buyer->id }}">{{ $buyer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                
                            <!-- Bid Amount -->
                            <div class="form-group">
                                <label for="bid_amount">Bid Amount</label>
                                <input type="number" name="bid_amount" id="bid_amount" class="form-control" required step="0.01" min="0">
                            </div>
                
                            <!-- Status Selection -->
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="pending" selected>Pending</option>
                                    <option value="accepted">Accepted</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </div>
                
                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Submit Bid</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
