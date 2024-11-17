@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/document') }}">Document Tracking</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/document') }}">Document Submission</a></li>
            <li class="breadcrumb-item active" aria-current="page">Document Details</li>
        </ol>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header" style="font-size: 0.9rem; font-family: serif;">
                        <h5>Document Details</h5>
                    </div>
                    <div class="card-body" style="font-size: 0.9rem; font-family: serif;">
                        <ul class="list-unstyled">
                            <li><strong>Vehicle:</strong> {{ $reservation->vehicle->name }}</li>
                            <li><strong>Driver:</strong> {{ $reservation->driver->name }}</li>
                            <li><strong>Seats:</strong> {{ $reservation->seats }}</li>
                            <li><strong>Status:</strong> {{ $reservation->status }}</li>
                            <li><strong>Location:</strong> {{ $reservation->location }}</li>
                            <li><strong>Availability Date:</strong> 
                                {{ $reservation->availability_date ? \Carbon\Carbon::parse($reservation->availability_date)->format('Y-m-d H:i') : 'N/A' }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
