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
                height: 60vh;
            }

            #search-container {
                margin-bottom: 10px;
            }

            #search {
                width: 300px;
                padding: 5px;
                font-size: 16px;
            }

            .table-container {
                max-height: 300px;
                overflow-y: auto;
            }
        </style>
    </head>

    <body>

        <div id="search-container">
            <input type="text" id="search" onkeyup="filterTable()" placeholder="Search vehicle..." class="form-control">
        </div>

        <div class="table-container">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Vehicle Model</th>
                        <th>License Plate</th>
                        <th>Type</th>
                        <th>Current Location</th>
                    </tr>
                </thead>
                <tbody id="vehicleTable">
                    <!-- Vehicle data will be populated dynamically -->
                </tbody>
            </table>
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

    // Initialize the map
    var map = L.map('map').setView([14.6760, 121.0437], 12); // Default: Quezon City
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    var vehicleMarkers = {};  // Store vehicle markers
    var vehiclePaths = {};    // Store vehicle movement history
    var polylines = {};       // Store poly
