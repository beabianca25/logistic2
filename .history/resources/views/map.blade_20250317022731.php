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

    // Initialize the map
    var map = L.map('map').setView([14.6760, 121.0437], 12); // Default: Quezon City
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    var vehicleMarkers = {}; // Store vehicle markers

    function fetchVehicleLocations() {
        fetch('/api/vehicle-locations')
            .then(response => response.json())
            .then(data => {
                data.forEach(vehicle => {
                    if (vehicle.locations.length > 0) {
                        let latestLocation = vehicle.locations[0]; // Get latest location

                        let icon = vehicle.type === 'bus' ? busIcon : carIcon;

                        if (vehicleMarkers[vehicle.id]) {
                            vehicleMarkers[vehicle.id].setLatLng([latestLocation.latitude, latestLocation.longitude]);
                        } else {
                            vehicleMarkers[vehicle.id] = L.marker([latestLocation.latitude, latestLocation.longitude], { icon })
                                .addTo(map)
                                .bindPopup(`<strong>${vehicle.model}</strong><br>Plate: ${vehicle.license_plate}`);
                        }
                    }
                });
            });
    }

    setInterval(fetchVehicleLocations, 5000); // Refresh every 5 seconds
    fetchVehicleLocations();
</script>


@endsection
