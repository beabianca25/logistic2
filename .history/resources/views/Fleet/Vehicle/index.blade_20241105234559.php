@extends('base')


@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Vendor Portal</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/auction') }}">Auction</a></li>
            <li class="breadcrumb-item active" aria-current="page">Auction List</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="row" style="font-size: 0.9rem; font-family: serif;">
                    <div class="col-md-12">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Auction List</h3>
                            <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#createAuctionModal" style="font-size: 0.9rem; font-family: serif;">
                                Create New Auction
                            </button>
                        </div>
                        @if (session('status'))
                            <div class="alert alert-success" style="font-size: 0.9rem; font-family: serif;">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0" style="font-size: 0.9rem; font-family: serif;">
                                    <thead>
                                        <tr>
                                            <th>Model</th>
                                            <th>Registration Number</th>
                                            <th>Capacity</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vehicles as $vehicle)
                                            <tr>
                                                <td>{{ $vehicle->make }} {{ $vehicle->model }} {{ $vehicle->model }}</td>
                                                <td>{{ $vehicle->registration_number }}</td>
                                                <td>{{ $vehicle->capacity }}</td>
                                                <td>{{ $vehicle->current_status }}</td>
                                                <td>
                                                    <a href="{{ route('vehicles.show', $vehicle->id) }}"
                                                        class="btn btn-info btn-sm">View</a>
                                                    <a href="{{ route('vehicles.edit', $vehicle->id) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('vehicles.destroy', $vehicle->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endsection
