@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: sans-serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/release') }}">Vehicle Reservation</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/release') }}">Vehicle Release</a></li>
            <li class="breadcrumb-item active" aria-current="page">Reservation Details</li>
        </ol>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header" style="font-size: 0.9rem; font-family: sans-serif;">
                        <h4>Edit Reservation
                            <a href="{{ route('release.index') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body" style="font-size: 0.9rem; font-family: sans-serif;">
                        <ul class="list-unstyled">
                            <strong>Vehicle ID:</strong> {{ $release->vehicle_id }} {{ $release->vehicle->vehicle_type }} {{ $release->vehicle->license_plate }}<br> <!-- Add this line -->
                            <strong>Customer Name:</strong> {{ $release->customer_name }}<br>
                            <strong>Customer Contact:</strong> {{ $release->customer_contact }}<br>
                            <strong>Reservation Date:</strong> {{ $release->reservation_date }}<br>
                            <strong>Release Date:</strong> {{ $release->release_date }}<br>
                            <strong>Drop-off Date:</strong> {{ $release->drop_off_date }}<br>
                            <strong>Released By:</strong> {{ $release->released_by }}<br>
                            <strong>Condition Report:</strong> {{ $release->condition_report }}<br>
                            <strong>Total Cost:</strong> {{ $release->total_cost }}<br>
                            <strong>Payment Status:</strong> {{ $release->payment_status ? 'Paid' : 'Pending' }}<br>
                            <strong>Notes:</strong> {{ $release->notes }}<br>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
