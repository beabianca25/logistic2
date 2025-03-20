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

    var vehicleMarkers = {};  // Store vehicle markers
    var vehiclePaths = {};    // Store vehicle movement history
    var polylines = {};       // Store polyline for each vehicle

    function fetchVehicleLocations() {
        fetch('/api/vehicle-locations')
            .then(response => response.json())
            .then(data => {
                data.forEach(vehicle => {
                    if (vehicle.locations.length > 0) {
                        let latestLocation = vehicle.locations[0]; // Get latest location
                        let vehicleId = vehicle.id;
                        let icon = vehicle.type === 'bus' ? busIcon : carIcon;

                        // Initialize path history if not existing
                        if (!vehiclePaths[vehicleId]) {
                            vehiclePaths[vehicleId] = [];
                        }

                        // Append latest location to history (for movement tracking)
                        vehiclePaths[vehicleId].push([latestLocation.latitude, latestLocation.longitude]);

                        // Ensure the path history doesn't grow indefinitely (keep last 10 locations)
                        if (vehiclePaths[vehicleId].length > 10) {
                            vehiclePaths[vehicleId].shift();
                        }

                        // If marker exists, update position
                        if (vehicleMarkers[vehicleId]) {
                            vehicleMarkers[vehicleId].setLatLng([latestLocation.latitude, latestLocation.longitude]);
                        } else {
                            // Create a new marker for the vehicle
                            vehicleMarkers[vehicleId] = L.marker([latestLocation.latitude, latestLocation.longitude], { icon })
                                .addTo(map)
                                .bindPopup(`<strong>${vehicle.model}</strong><br>Plate: ${vehicle.license_plate}`);
                        }

                        // Remove previous polyline if exists
                        if (polylines[vehicleId]) {
                            map.removeLayer(polylines[vehicleId]);
                        }

                        // Draw a new polyline showing movement
                        polylines[vehicleId] = L.polyline(vehiclePaths[vehicleId], {
                            color: 'blue',
                            weight: 4,
                            dashArray: '5, 10'
                        }).addTo(map);
                    }
                });
            })
            .catch(error => console.error('Error fetching vehicle locations:', error));
    }

    setInterval(fetchVehicleLocations, 5000); // Refresh every 5 seconds
    fetchVehicleLocations();
</script>

@endsection
