@extends('base')

@section('content')
    <div class="container">
        <h1>Create Booking</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('booking.store') }}" method="POST" id="bookingForm">
            @csrf

            <div class="mb-3">
                <label for="service_type" class="form-label">Select Service Type:</label>
                <select id="service_type" name="service_type" class="form-control" onchange="toggleFields()" required>
                    <option value="">-- Select Service --</option>
                    <option value="Seminar/Meeting">Seminar/Meeting</option>
                    <option value="Birthday Celebration">Birthday Celebration</option>
                    <option value="Wedding/Anniversary">Wedding/Anniversary</option>
                    <option value="Team Building">Team Building</option>
                    <option value="Concert/Pageant">Concert/Pageant</option>
                    <option value="Field Trip">Field Trip</option>
                    <option value="Airline Ticketing">Airline Ticketing</option>
                    <option value="Tour Package">Tour Package</option>
                    <option value="Bus/Van Rental">Bus/Van Rental</option>
                </select>
            </div>

            <!-- General Fields -->
            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name:</label>
                <input type="text" class="form-control" id="full_name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Address:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number:</label>
                <input type="text" class="form-control" id="phone" name="phone_number" required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>

            <div class="mb-3">
                <label for="booking_date" class="form-label">Booking Date & Time:</label>
                <input type="datetime-local" class="form-control" id="booking_date" name="booking_date" required>
            </div>

            <!-- Hidden Fields -->
            <input type="hidden" name="status" value="Pending">
            <input type="hidden" name="payment_status" value="Pending">

            <!-- Dynamic Fields -->
            <div id="num_people_field" class="mb-3 hidden">
                <label for="number_of_people" class="form-label">Number of People:</label>
                <input type="number" class="form-control" id="number_of_people" name="number_of_people">
            </div>

            <div id="venue_field" class="mb-3 hidden">
                <label for="venue" class="form-label">Venue:</label>
                <input type="text" class="form-control" id="venue" name="venue">
            </div>

            <div id="pickup_dropoff_field" class="mb-3 hidden">
                <label for="pickup_location" class="form-label">Pickup Location:</label>
                <input type="text" class="form-control" id="pickup_location" name="pickup_location">
                <label for="dropoff_location" class="form-label mt-2">Dropoff Location:</label>
                <input type="text" class="form-control" id="dropoff_location" name="dropoff_location">
            </div>

            <div id="destination_field" class="mb-3 hidden">
                <label for="destination" class="form-label">Destination:</label>
                <input type="text" class="form-control" id="destination" name="destination">
            </div>

            <div id="flight_details_field" class="mb-3 hidden">
                <label for="departure_date" class="form-label">Departure Date:</label>
                <input type="date" class="form-control" id="departure_date" name="departure_date">
                <label for="return_date" class="form-label mt-2">Return Date:</label>
                <input type="date" class="form-control" id="return_date" name="return_date">
            </div>

            <div id="special_request_field" class="mb-3 hidden">
                <label for="special_requests" class="form-label">Special Requests:</label>
                <textarea class="form-control" id="special_requests" name="special_requests"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Book Now</button>
        </form>
    </div>

    <script>
        function toggleFields() {
            let bookingType = document.getElementById("service_type").value;

            // Hide all fields initially
            document.querySelectorAll('.hidden').forEach(field => {
                field.style.display = 'none';
            });

            // Show fields based on selection
            if (bookingType === "Seminar/Meeting" || bookingType === "Birthday Celebration" || bookingType === "Wedding/Anniversary") {
                document.getElementById("venue_field").style.display = 'block';
                document.getElementById("num_people_field").style.display = 'block';
            } else if (bookingType === "Field Trip" || bookingType === "Tour Package") {
                document.getElementById("destination_field").style.display = 'block';
                document.getElementById("num_people_field").style.display = 'block';
            } else if (bookingType === "Airline Ticketing") {
                document.getElementById("flight_details_field").style.display = 'block';
                document.getElementById("num_people_field").style.display = 'block';
            } else if (bookingType === "Bus/Van Rental") {
                document.getElementById("pickup_dropoff_field").style.display = 'block';
                document.getElementById("num_people_field").style.display = 'block';
            }
        }
    </script>

    <style>
        .hidden {
            display: none;
        }
    </style>
@endsection
