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
                        <h5>Document Details

                        </h5>
                    </div>
                    <li><strong>Vehicle:</strong> {{ $vehiclereservation->vehicle->name }}</li>
                    <li><strong>Driver:</strong> {{ $vehiclereservation->driver->name }}</li>
                    <li><strong>Seats:</strong> {{ $vehiclereservation->seats }}</li>
                    <li><strong>Status:</strong> {{ $vehiclereservation->status }}</li>
                    <li><strong>Location:</strong> {{ $vehiclereservation->location }}</li>
                    <li><strong>Availability Date:</strong> {{ $vehiclereservation->availability_date ? \Carbon\Carbon::parse($vehiclereservation->availability_date)->format('Y-m-d H:i') : 'N/A' }}</li>
                
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
