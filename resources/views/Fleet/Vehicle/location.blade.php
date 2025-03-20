@extends('base')

@section('content')
<div class="container">
    <h2>Set Vehicle Location</h2>
    
    <form method="POST" action="{{ route('vehicle.storeLocation', $vehicle->id) }}">
        @csrf
        
        <div>
            <label for="location_name">Location Name:</label>
            <input type="text" id="location_name" name="location_name" required class="form-control" oninput="setCoordinates()">
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
            "MANILA": { lat: 14.5995, lng: 120.9842 },
            "BAGUIO": { lat: 16.4023, lng: 120.5960 },
            "SAGADA": { lat: 17.0863, lng: 120.9024 },
            "QUEZON CITY": { lat: 14.6760, lng: 121.0437 },
            "VALENZUELA": { lat: 14.7004, lng: 120.9835 },
            "NAIA": { lat: 14.5086, lng: 121.0198 }
        };

        let input = document.getElementById("location_name").value.toUpperCase().trim();
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
