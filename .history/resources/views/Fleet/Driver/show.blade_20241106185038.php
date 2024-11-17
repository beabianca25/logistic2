@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/fleet') }}">Fleet Management</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/vehicle') }}">Vehicle List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vehicle Details</li>
        </ol>
    </nav>

    <div class="container">
        <h1>Vehicle Details</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $driver->driver_name }}</h5>
                <p><strong>License Number:</strong> {{ $driver->license_number }}</p>
                <p><strong>Contact Number:</strong> {{ $driver->contact_number }}</p>
                <p><strong>Email:</strong> {{ $driver->email }}</p>
                <p><strong>Address:</strong> {{ $driver->address }}</p>
                <p><strong>Certifications:</strong> {{ $driver->certifications }}</p>
                <p><strong>License Expiry Date:</strong> {{ $driver->license_expiry_date }}</p>
                <p><strong>Status:</strong> {{ $driver->status }}</p>
                <a href="{{ route('drivers.index') }}" class="btn btn-primary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
