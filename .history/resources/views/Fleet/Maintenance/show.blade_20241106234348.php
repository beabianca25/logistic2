@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/fleet') }}">Fleet Management</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/vehicle') }}">Manage Detail</a></li>
            <li class="breadcrumb-item active" aria-current="page">Maintenance Details</li>
        </ol>
    </nav>

    <div class="container">
        <h1>Maintenance Details</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <strong>Vehicle:</strong>
                    @if($maintenance->vehicle && $maintenance->vehicle->vehicle_type)
                        {{ $maintenance->vehicle->license_plate }}
                    @else
                        N/A
                    @endif
                </h5>
                
                <p><strong>Maintenance Type:</strong> {{ $maintenance->maintenance_type }}</p>
                <p><strong>Maintenance Date:</strong> {{ \Carbon\Carbon::parse($maintenance->maintenance_date)->format('Y-m-d H:i') }}</p>
                <p><strong>Service Vendor:</strong> {{ $maintenance->service_vendor}}</p>
                <p><strong> Cost: </strong> {{$maintenance->cost}}</p>
                <p><strong> Status: </strong> {{$maintenance->status}}</p>
                <a href="{{ route('maintenance.index') }}" class="btn btn-primary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
