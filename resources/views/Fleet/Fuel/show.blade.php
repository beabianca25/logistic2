@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: sans-serif;">
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
                <h5 class="card-title"><strong>Vehicle:</strong> {{ $fuel->vehicle->license_plate ?? 'N/A' }}</h5>
                <p><strong>Refill Date:</strong> {{ \Carbon\Carbon::parse($fuel->refill_date)->format('Y-m-d') }}</p>
                <p><strong>Fuel Amount:</strong> {{ $fuel->fuel_amount }} liters/gallons</p>
                <p><strong>Cost:</strong> ${{ number_format($fuel->cost, 2) }}</p>
                <p><strong>Fuel Station:</strong> {{ $fuel->fuel_station }}</p>
                <p><strong>Status:</strong> {{ ucfirst($fuel->status) }}</p>
            </div>
        </div>
        <div class="mt-3">
            <a href="{{ route('fuel.index') }}" class="btn btn-primary">Back to Fuel List</a>
            <a href="{{ route('fuel.edit', $fuel->id) }}" class="btn btn-warning">Edit Fuel Refill</a>
        </div>
    </div>
@endsection
