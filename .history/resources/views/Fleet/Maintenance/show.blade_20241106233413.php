@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/fleet') }}">Fleet Management</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/vehicle') }}">Manage Detail</a></li>
            <li class="breadcrumb-item active" aria-current="page">Trip Details</li>
        </ol>
    </nav>

    <div class="container">
        <h1>Trip Details</h1>

        <div class="card">
            <div class="card-body">
                {{-- <h5 class="card-title">Vehicle: {{ $maintenance->vehicle->license_plate }}</h5>  --}}
                <p><strong>Maintenance Type:</strong> {{ $maintenance->maintenance_type }}</p>
                <p><strong>Maintenance Date:</strong> {{ $maintenance->maintenance_date->format('Y-m-d') }}</p>
                <p><strong>Service Vendor:</strong> {{ $maintenance->service_vendor}}</p>
                <p><strong> Cost: </strong> {{$maintenance->cost}}</p>
                <p><strong> Status: </strong> {{$maintenance->status}}</p>
                <a href="{{ route('maintenance.index') }}" class="btn btn-primary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
