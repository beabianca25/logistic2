@extends('base')

@section('content')
<div class="container">
    <h2>Set Vehicle Location</h2>
    
    <form method="POST" action="{{ route('vehicle.storeLocation', $vehicle->id) }}">
        @csrf
        
        <div>
            <label for="latitude">Latitude:</label>
            <input type="text" name="latitude" required class="form-control">
        </div>

        <div>
            <label for="longitude">Longitude:</label>
            <input type="text" name="longitude" required class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Save Location</button>
    </form>
</div>
@endsection
