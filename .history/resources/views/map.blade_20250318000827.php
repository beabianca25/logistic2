@extends('base')
@section('content')

<h4>Tracking Map</h4>

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
                height: 60vh;
            }

            .table-container {
                max-height: 60vh;
                overflow-y: auto;
            }

            #search {
                width: 100%;
                padding: 5px;
                font-size: 16px;
                margin-bottom: 10px;
            }
        </style>
    </head>

    <body>

        <div class="row">
            <!-- Vehicle List Section -->
            <div class="col-md-6">
                <input type="text" id="search" onkeyup="filterTable()" placeholder="Search vehicle..." class="form-control">
                <div class="table-container">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Vehicle Model</th>
                                <th>License Plate</th>
                                <th>Current Location</th>
                            </tr>
                        </thead>
                        <tbody id="vehicleTable">
                            <!-- Vehicle data will be populated dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Map Section -->
            <div class="col-md-6">
                <div id="map"></div>
            </div>
        </div>

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
                let tableBody = document.getElementById("vehicleTable");
                tableBody.innerHTML = ""; // Clear existing data

                data.forEach(vehicle => {
                    if (vehicle.locations.length > 0) {
                        let latestLocation = vehicle.locations[0]; // Get latest location
                        let vehicleId = vehicle.id;
                       

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

                        // Populate vehicle table
                        let row = `
                            <tr>
                                <td>${vehicle.model}</td>
                                <td>${vehicle.license_plate}</td>
                                <td>${vehicle.type}</td>
                                <td>Lat: ${latestLocation.latitude}, Lng: ${latestLocation.longitude}</td>
                            </tr>
                        `;
                        tableBody.innerHTML += row;
                    }
                });
            })
            .catch(error => console.error('Error fetching vehicle locations:', error));
    }

    // Search function for filtering table
    function filterTable() {
        let input = document.getElementById("search").value.toLowerCase();
        let rows = document.getElementById("vehicleTable").getElementsByTagName("tr");

        for (let i = 0; i < rows.length; i++) {
            let text = rows[i].textContent.toLowerCase();
            rows[i].style.display = text.includes(input) ? "" : "none";
        }
    }

    setInterval(fetchVehicleLocations, 5000); // Refresh every 5 seconds
    fetchVehicleLocations();
</script>

@endsection
