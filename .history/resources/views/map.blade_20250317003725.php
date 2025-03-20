@extends('base')
@section('content')
<h3>Tracking Map</h3>

<!DOCTYPE html>
<html lang="en">
<div class="col-md-12">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Realtime Location Tracker</title>

        <!-- Leaflet CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

        <style>
            body {
                margin: 0;
                padding: 0;
            }

            #map {
                width: 100%;
                height: 80vh;
            }

            #search-container {
                position: absolute;
                top: 10px;
                left: 50%;
                transform: translateX(-50%);
                z-index: 1000;
                background: white;
                padding: 10px;
                border-radius: 5px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            }

            #search {
                width: 250px;
                padding: 5px;
                font-size: 16px;
            }
        </style>
    </head>

    <body>
        <!-- Search Bar -->
        <div id="search-container">
            <input type="text" id="search" placeholder="Search vehicle..." onkeyup="searchVehicle()" />
        </div>

        <div id="map"></div>
    </body>
</div>
</html>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<script>
    // Custom Icons
    const carIcon = L.divIcon({
        html: '<i class="fas fa-car" style="font-size: 30px; color: blue;"></i>',
        iconSize: [30, 30],
        className: 'custom-car-icon'
    });

    const busIcon = L.divIcon({
        html: '<i class="fas fa-bus" style="font-size: 35px; color: red;"></i>',
        iconSize: [35, 35],
        className: 'custom-bus-icon'
    });

    // Initialize Map
    var map = L.map('map').setView([12.8797, 121.7740], 6);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    // Vehicle Data
    var vehicles = [
        { id: 1, lat: 14.599512, long: 120.984222, name: "Moving Car 1", icon: carIcon },
        { id: 2, lat: 15.870032, long: 120.984222, name: "Moving Bus 1", icon: busIcon }
    ];

    var vehicleMarkers = {};

    // Add Vehicles to Map
    vehicles.forEach(vehicle => {
        let marker = L.marker([vehicle.lat, vehicle.long], { icon: vehicle.icon })
            .addTo(map)
            .bindPopup(vehicle.name);
        vehicleMarkers[vehicle.name.toLowerCase()] = marker;
    });

    // Search Function
    function searchVehicle() {
        var query = document.getElementById("search").value.toLowerCase();
        if (query in vehicleMarkers) {
            map.setView(vehicleMarkers[query].getLatLng(), 12);
            vehicleMarkers[query].openPopup();
        }
    }
</script>

@endsection
