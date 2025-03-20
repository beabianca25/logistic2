@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: sans-serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/vehicle_reservation') }}">Fleet Management</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/vehicle_releases') }}">Vehicle Releases</a></li>
            <li class="breadcrumb-item active" aria-current="page">New Vehicle Release</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Vehicle Release</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('release.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="vehicle_reservation_id" class="form-label">Vehicle Reservation</label>
                            <select class="form-control" id="vehicle_reservation_id" name="vehicle_reservation_id" required>
                                <option value="">Select a reservation</option>
                                @foreach ($reservations as $reservation)
                                    <option value="{{ $reservation->vehicle_reservation_id }}"
                                        data-customer="{{ $reservation->customer_name }}"
                                        data-contact="{{ $reservation->customer_contact }}"
                                        data-reservation-start-date="{{ $reservation->reservation_start_date }}"
                                        {{ str_pad(strtoupper(dechex($reservation->id)), 4, '0', STR_PAD_LEFT) }} -
                                        @foreach ($reservation->vehicles as $vehicle)
                                            {{ $vehicle->vehicle_type }} ({{ $vehicle->license_plate }})
                                        @endforeach

                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Customer Name</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" readonly
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="customer_contact" class="form-label">Customer Contact</label>
                            <input type="text" class="form-control" id="customer_contact" name="customer_contact"
                                readonly required>
                        </div>

                        <div class="mb-3">
                            <label for="reservation_date" class="form-label">Reservation Date</label>
                            <input type="datetime-local" class="form-control" id="reservation_date" name="reservation_date"
                                readonly required>
                        </div>

                        <div class="mb-3">
                            <label for="release_date" class="form-label">Release Date</label>
                            <input type="datetime-local" class="form-control" id="release_date" name="release_date"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="drop_off_date" class="form-label">Drop-off Date</label>
                            <input type="datetime-local" class="form-control" id="drop_off_date" name="drop_off_date">
                        </div>

                        <div class="mb-3">
                            <label for="total_cost" class="form-label">Total Cost</label>
                            <input type="number" class="form-control" id="total_cost" name="total_cost" required
                                step="0.01">
                        </div>

                        <div class="mb-3">
                            <label for="payment_status" class="form-label">Payment Status</label>
                            <select class="form-control" id="payment_status" name="payment_status">
                                <option value="0">Pending</option>
                                <option value="1">Paid</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="Pending">Pending</option>
                                <option value="Ongoing">Ongoing</option>
                                <option value="Completed">Completed</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("vehicle_reservation_id").addEventListener("change", function() {
            var selectedOption = this.options[this.selectedIndex];
            document.getElementById("customer_name").value = selectedOption.getAttribute("data-customer") || "";
            document.getElementById("customer_contact").value = selectedOption.getAttribute("data-contact") || "";
            document.getElementById("reservation_date").value = selectedOption.getAttribute(
                "data-reservation-date") || "";
        });
    </script>
@endsection
