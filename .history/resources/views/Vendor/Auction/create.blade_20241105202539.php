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
                            <a href="{{ route('auction.index') }}" class="btn btn-danger float-end">Back</a>
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

                        <form action="{{ route('auction.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="category"></label>
                                <select name="category" class="form-control" required>
                                    <option value="">Category</option>
                                    <option value="travel_gear">Travel Gear</option>
                                    <option value="Electronic_Devices">Electronic Devices</option>
                                    <option value="Trvel_Apparel">Travel Apparel</option>
                                    <option value="Health_and_Safety">Health and Safety</option>
                                    <option value="Ecofriendly_products">Eco-friendly Products</option>
                                    <option value="Vehicles">Vehicles </option>
                                    <option value="Travel_Photography_Equipment">Travel Photography Equipment</option>
                                    <option value="Bicyles_and_Scooters">Bicycles and Scooters</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="auction_title">Auction Title</label>
                                <input type="text" name="auction_title" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="year">Year</label>
                                <input type="number" name="year" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" rows="5" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="condition">Condition</label>
                                <input type="text" name="condition" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="product_version">Product Version</label>
                                <input type="text" name="product_version" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="company">Company</label>
                                <input type="text" name="company" class="form-control" required>
                            </div>

                            <div class="col-md-2">
                        <h5>Pricing:</h5>
                            </div>
                            <div class="form-group">
                                <label for="min_estimate_price">Minimum Estimate Price</label>
                                <input type="number" name="min_estimate_price" class="form-control"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="max_estimate_price">Maximum Estimate Price</label>
                                <input type="number" name="max_estimate_price" class="form-control"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date" name="end_date" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="photo">Photo</label>
                                <input type="file" name="photo" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary">Create Auction</button>
                            <a href="{{ route('auction.index') }}" class="btn btn-secondary">Back to Auctions</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
