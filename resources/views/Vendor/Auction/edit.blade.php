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

                        <form action="{{ route('auction.update', $auction->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                    
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <input type="text" class="form-control" id="category" name="category" value="{{ old('category', $auction->category) }}" required>
                            </div>
                    
                            <div class="mb-3">
                                <label for="auction_title" class="form-label">Auction Title</label>
                                <input type="text" class="form-control" id="auction_title" name="auction_title" value="{{ old('auction_title', $auction->auction_title) }}" required>
                            </div>
                    
                            <div class="mb-3">
                                <label for="year" class="form-label">Year</label>
                                <input type="number" class="form-control" id="year" name="year" value="{{ old('year', $auction->year) }}" required>
                            </div>
                    
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $auction->description) }}</textarea>
                            </div>
                    
                            <div class="mb-3">
                                <label for="condition" class="form-label">Condition</label>
                                <input type="text" class="form-control" id="condition" name="condition" value="{{ old('condition', $auction->condition) }}" required>
                            </div>
                    
                            <div class="mb-3">
                                <label for="product_version" class="form-label">Product Version</label>
                                <input type="text" class="form-control" id="product_version" name="product_version" value="{{ old('product_version', $auction->product_version) }}" required>
                            </div>
                    
                            <div class="mb-3">
                                <label for="company" class="form-label">Company</label>
                                <input type="text" class="form-control" id="company" name="company" value="{{ old('company', $auction->company) }}" required>
                            </div>
                    
                            <div class="mb-3">
                                <label for="min_estimate_price" class="form-label">Min Estimate Price</label>
                                <input type="number" class="form-control" id="min_estimate_price" name="min_estimate_price" value="{{ old('min_estimate_price', $auction->min_estimate_price) }}" step="0.01" required>
                            </div>
                    
                            <div class="mb-3">
                                <label for="max_estimate_price" class="form-label">Max Estimate Price</label>
                                <input type="number" class="form-control" id="max_estimate_price" name="max_estimate_price" value="{{ old('max_estimate_price', $auction->max_estimate_price) }}" step="0.01" required>
                            </div>
                    
                            <div class="mb-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', $auction->end_date) }}" required>
                            </div>
                    
                            <div class="mb-3">
                                <label for="photo" class="form-label">Auction Image (optional)</label>
                                <input type="file" class="form-control" id="photo" name="photo">
                                @if($auction->photo)
                                    <p>Current Image:</p>
                                    <img src="{{ asset('uploads/' . $auction->photo) }}" alt="Current Auction Image" class="img-fluid mt-2 mb-3" style="max-width: 150px;">
                                @endif
                            </div>
                    
                            <button type="submit" class="btn btn-primary">Update Auction</button>
                            <a href="{{ route('auction.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
