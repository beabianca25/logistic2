@extends('base')

@section('content')
<div class="container">
    <h2>Set Vehicle Location</h2>
    
    <form method="POST" action="{{ route('vehicle.storeLocation', $vehicle->id) }}">
        @csrf
        
        <div>
            <label for="location_code">Location Code:</label>
            <input type="text" id="location_code" name="location_code" required class="form-control" oninput="setCoordinates()">
        </div>

        <div>
            <label for="latitude">Latitude:</label>
            <input type="text" id="latitude" name="latitude" required class="form-control" readonly>
        </div>

        <div>
            <label for="longitude">Longitude:</label>
            <input type="text" id="longitude" name="longitude" required class="form-control" readonly>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Save Location</button>
    </form>
</div>

<script>
    function setCoordinates() {
        const locationMap = {
            "A": { lat: 14.5995, lng: 120.9842 }, // Example: Manila
            "B": { lat: 10.3157, lng: 123.8854 }, // Example: Cebu
            "C": { lat: 7.1907, lng: 125.4553 },  // Example: Davao
        };

        let input = document.getElementById("location_code").value.toUpperCase();
        if (locationMap[input]) {
            document.getElementById("latitude").value = locationMap[input].lat;
            document.getElementById("longitude").value = locationMap[input].lng;
        } else {
            document.getElementById("latitude").value = "";
            document.getElementById("longitude").value = "";
        }
    }
</script>
@endsection
