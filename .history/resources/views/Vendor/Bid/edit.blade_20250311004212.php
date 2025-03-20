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
                                <select class="form-select" id="status" name="status">
                                    <option value="pending" {{ old('status', $bid->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="active" {{ old('status', $bid->status) == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="outbid" {{ old('status', $bid->status) == 'outbid' ? 'selected' : '' }}>Outbid</option>
                                    <option value="winning" {{ old('status', $bid->status) == 'winning' ? 'selected' : '' }}>Winning</option>
                                    <option value="reserve not met" {{ old('status', $bid->status) == 'reserve not met' ? 'selected' : '' }}>Reserve Not Met</option>
                                    <option value="cancelled" {{ old('status', $bid->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    <option value="closed" {{ old('status', $bid->status) == 'closed' ? 'selected' : '' }}>Closed</option>
                                    <option value="winning bid" {{ old('status', $bid->status) == 'winning bid' ? 'selected' : '' }}>Winning Bid</option>
                                    <option value="losing bid" {{ old('status', $bid->status) == 'losing bid' ? 'selected' : '' }}>Losing Bid</option>
                                    <option value="awarded" {{ old('status', $bid->status) == 'awarded' ? 'selected' : '' }}>Awarded</option>
                                    <option value="completed" {{ old('status', $bid->status) == 'completed' ? 'selected' : '' }}>Completed</option>
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
