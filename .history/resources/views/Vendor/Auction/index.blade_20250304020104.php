@extends('base')

@section('content')
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
                - {{ ucfirst($type) }} <!-- Dynamically display the type -->
            @else
                - All
            @endif

            <a href="{{ route('Auction.create', ['type' => $type]) }}" class="btn btn-sm btn-primary float-end"
                style="font-size: 0.9rem; font-family: serif;">
                <i class="fas fa-plus"></i> Create New Auction
            </a>
        </h3>

        <!-- Filter Buttons Moved Here -->
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

            @if (!$type)
                <!-- Only show filter dropdown when "All" is selected -->
                <div class="dropdown ms-2">
                    <button class="btn dropdown-toggle " style="border-radius: 25px; padding: 3px 30px;" type="button"
                        id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-filter"></i> <!-- Font Awesome filter icon -->
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                        <li><a class="dropdown-item" href="{{ route('auction.index', ['type' => 'rental']) }}">Rent</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('auction.index', ['type' => 'service']) }}">Service</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('auction.index', ['type' => 'product']) }}">Product</a>
                        </li>
                    </ul>
                </div>
            @endif
        </div>


        <!-- Table and Content -->
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header border-transparent">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Auction List</h3>
                            <!-- Search Form -->
                            <form action="{{ route('auction.index') }}" method="GET" class="d-flex w-50">
                                <input type="text" name="search" class="form-control" placeholder="Search auctions..."
                                    value="{{ request()->query('search') }}">
                                <button type="submit" class="btn btn-primary ms-2">Search</button>
                            </form>
                        </div>

                    </div>


                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

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
                                    <td>{{ $auction->id }}</td>
                                    <td>{{ ucfirst($auction->type) }}</td>
                                    <td>{{ $auction->category }}</td>
                                    <td>{{ $auction->auction_title }}</td>
                                    <td>{{ $auction->min_estimate_price }}</td>
                                    <td>
                                        <div class="d-flex justify-content-around align-items-center">
                                            <a href="{{ route('auction.show', $auction->id) }}"
                                                class="btn btn-info btn-sm mx-0">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <a href="{{ route('auction.edit', $auction->id) }}"
                                                class="btn btn-warning btn-sm mx-0">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('auction.destroy', $auction->id) }}" method="POST"
                                                id="deleteForm{{ $auction->id }}" class="mx-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="confirmDelete({{ $auction->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
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

            <div class="col-md-2">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Sales</h3>
                            <a href="javascript:void(0);">View Report</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                                <span class="text-bold text-lg"
                                    style="font-size: 0.9rem; font-family: sans-serif;">₱18,230.00</span>
                                <span style="font-size: 0.9rem; font-family: sans-serif;">Sales Over Time</span>
                            </p>
                            <p class="ml-auto d-flex flex-column text-right">
                                <span class="text-success" style="font-size: 0.9rem; font-family: sans-serif;">
                                    <i class="fas fa-arrow-up"></i> 33.1%
                                </span>
                                <span class="text-muted" style="font-size: 0.9rem; font-family: sans-serif;">Since last
                                    month</span>
                            </p>
                        </div>
                        <div class="position-relative mb-4">
                            <canvas id="sales-chart" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Scripts for confirmation and chart (unchanged) -->
    <script>
        function confirmDelete(vendorId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#d33', // Red color for delete confirmation
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm' + vendorId).submit();
                }
            });
        }
    </script>
@endsection
