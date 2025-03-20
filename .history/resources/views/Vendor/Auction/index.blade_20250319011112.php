@extends('base')

@section('content')
@can('views auctions')
    

    <div class="container">
        <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: sans-serif;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Vendor Portal</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/auction') }}">Auction</a></li>
                <li class="breadcrumb-item active" aria-current="page">Auction List</li>
            </ol>
        </nav>
        <h3>Auctions
            @if ($type)
                - {{ ucfirst($type) }}
            @else
                - All
            @endif

            @can('create auction')
                <a href="{{ route('auction.create', ['type' => $type]) }}" class="btn btn-sm btn-primary float-end"
                    style="font-size: 0.9rem; font-family: serif;">
                    <i class="fas fa-plus"></i> Create New Auction
                </a>
            @endcan
        </h3>

        <!-- Instruction Note -->
        <div class="alert alert-info" role="alert">
            <i class="fas fa-info-circle"></i> To place a bid, click <strong>"Actions"</strong> and select <strong>"View"</strong>.
        </div>

        <!-- Filter Buttons -->
        <div class="mb-3 d-flex align-items-center">
            <a href="{{ route('auction.index') }}"
                style="margin-right: 50px; border-radius: 25px; padding: 3px 30px; background-color: #007bff; color: white;"
                class="btn {{ !$type ? 'active' : '' }}">All</a>
            <a href="{{ route('auction.index', ['type' => 'rental']) }}"
                style="margin-right: 50px; border-radius: 25px; padding: 3px 30px; background-color: #28a745; color: white;"
                class="btn {{ $type === 'rental' ? 'active' : '' }}">Rental</a>
            <a href="{{ route('auction.index', ['type' => 'service']) }}"
                style="margin-right: 50px; border-radius: 25px; padding: 3px 30px; background-color: #17a2b8; color: white;"
                class="btn {{ $type === 'service' ? 'active' : '' }}">Service</a>
            <a href="{{ route('auction.index', ['type' => 'product']) }}"
                style="border-radius: 25px; padding: 3px 30px; background-color: #ffc107; color: black;"
                class="btn {{ $type === 'product' ? 'active' : '' }}">Product</a>
        </div>

        <!-- Table -->
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header border-transparent">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Auction List</h3>
                            <form action="{{ route('auction.index') }}" method="GET" class="d-flex w-50">
                                <input type="text" name="search" class="form-control" placeholder="Search auctions..."
                                    value="{{ request()->query('search') }}">
                                <button type="submit" class="btn btn-primary ms-2">Search</button>
                            </form>
                        </div>
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>Title</th>
                                <th>MEP</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($auctions as $auction)
                                <tr>
                                    <td>
                                        <a href="{{ route('auction.show', $auction->id) }}" class="text-primary">
                                            {{ str_pad(strtoupper(dechex($auction->id)), 4, '0', STR_PAD_LEFT) }}
                                        </a>
                                    </td>
                                    <td>{{ ucfirst($auction->type) }}</td>
                                    <td>{{ $auction->category }}</td>
                                    <td>{{ $auction->auction_title }}</td>
                                    <td>{{ $auction->min_estimate_price }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu">
                                                @can('view auction')
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('auction.show', $auction->id) }}">
                                                            <i class="fas fa-eye"></i> View (Bid)
                                                        </a>
                                                    </li>
                                                @endcan
                                                @can('edit auction')
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('auction.edit', $auction->id) }}">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                    </li>
                                                @endcan
                                                @can('delete auction')
                                                    <li>
                                                        <a class="dropdown-item text-danger" href="javascript:void(0);" onclick="confirmDelete({{ $auction->id }})">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </a>
                                                    </li>
                                                @endcan
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No auctions found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="pagination">
                        {{ $auctions->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert for Success -->
    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Success!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    confirmButtonText: "OK"
                });
            });
        </script>
    @endif

    <!-- Delete Confirmation -->
    <script>
        function confirmDelete(auctionId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm' + auctionId).submit();
                }
            });
        }
    </script>
    @endcan
@endsection
