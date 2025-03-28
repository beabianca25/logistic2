@extends('base')

@section('content')
<div class="container">
    <h1>Edit Auction</h1>

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Form for editing the auction -->
    <form action="{{ route('auction.update', ['auction' => $auction->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Specifies that this form uses the HTTP PUT method -->

        <!-- Hidden type input -->
        <input type="hidden" name="type" value="{{ $auction->type }}">

        <!-- Auction Title -->
        <div class="mb-3">
            <label for="auction_title" class="form-label">Auction Title</label>
            <input type="text" class="form-control" id="auction_title" name="auction_title" value="{{ old('auction_title', $auction->auction_title) }}" required>
        </div>

        <!-- Category -->
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" class="form-control" id="category" name="category" value="{{ old('category', $auction->category) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
@endsection
