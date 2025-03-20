@extends('base')

@section('content')
<div class="container">
    <h2>Location History for {{ $vehicle->model }} ({{ $vehicle->license_plate }})</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Recorded At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vehicle->locations as $location)
                <tr>
                    <td>{{ $location->latitude }}</td>
                    <td>{{ $location->longitude }}</td>
                    <td>{{ $location->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('vehicle.index') }}" class="btn btn-secondary">Back to Vehicles</a>
</div>
@endsection
