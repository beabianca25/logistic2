@extends('base')

@section('content')
<div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('reservation.index') }}">Reservations</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Vehicle Reservation</li>
        </ol>
    </nav>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <h2>Create Vehicle Reservation</h2>

    <form action="{{ route('reservation.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Customer Name</label>
            <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') }}" required>
            @error('customer_name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Customer Contact</label>
            <input type="text" name="customer_contact" class="form-control" value="{{ old('customer_contact') }}" required>
            @error('customer_contact') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Select Vehicles -->
        <div class="mb-3">
            <label class="form-label">Select Vehicles</label>
            <div class="form-check">
                <input type="checkbox" id="selectAllVehicles" class="form-check-input">
                <label class="form-check-label" for="selectAllVehicles">Select All Vehicles</label>
            </div>
            <select name="vehicle_ids[]" class="form-control" multiple size="5" required id="vehicleSelect">
                @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}">{{ $vehicle->model }} ({{ $vehicle->vehicle_type }})</option>
                @endforeach
            </select>
            @error('vehicle_ids') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Vehicle Count -->
        <div class="mb-3">
            <label class="form-label">Vehicle Count</label>
            <input type="number" name="vehicle_count" id="vehicleCount" class="form-control" min="1" required readonly>
            @error('vehicle_count') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Select Driver</label>
            <select name="driver_id" class="form-control" required>
                <option value="">Select a Driver</option>
                @foreach($drivers as $driver)
                    <option value="{{ $driver->id }}">{{ $driver->driver_name }}</option>
                @endforeach
            </select>
            @error('driver_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Reservation Start Date</label>
            <input type="date" name="reservation_start_date" class="form-control" required value="{{ old('reservation_start_date') }}">
            @error('reservation_start_date') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Reservation End Date</label>
            <input type="date" name="reservation_end_date" class="form-control" required value="{{ old('reservation_end_date') }}">
            @error('reservation_end_date') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Approved" {{ old('status') == 'Approved' ? 'selected' : '' }}>Approved</option>
                <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                <option value="Cancelled" {{ old('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            @error('status') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Location</label>
            <input type="text" name="location" class="form-control" value="{{ old('location') }}">
            @error('location') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Reservation Notes</label>
            <textarea name="reservation_notes" class="form-control">{{ old('reservation_notes') }}</textarea>
            @error('reservation_notes') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Total Price</label>
            <input type="number" step="0.01" name="total_price" class="form-control" value="{{ old('total_price') }}">
            @error('total_price') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-success">Create Reservation</button>
    </form>
</div>

<!-- JavaScript for Vehicle Selection -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const vehicleSelect = document.getElementById('vehicleSelect');
        const vehicleCount = document.getElementById('vehicleCount');
        const selectAllCheckbox = document.getElementById('selectAllVehicles');

        function updateVehicleCount() {
            vehicleCount.value = vehicleSelect.selectedOptions.length;

            // Check if all vehicles are selected
            const allSelected = vehicleSelect.selectedOptions.length === vehicleSelect.options.length;
            selectAllCheckbox.checked = allSelected;
        }

        // Update vehicle count when selecting/deselecting vehicles
        vehicleSelect.addEventListener('change', updateVehicleCount);

        // "Select All" functionality
        selectAllCheckbox.addEventListener('change', function() {
            const isChecked = selectAllCheckbox.checked;
            for (let option of vehicleSelect.options) {
                option.selected = isChecked;
            }
            updateVehicleCount();
        });

        // Ensure "Select All" is unchecked when any vehicle is deselected
        vehicleSelect.addEventListener('click', function() {
            if (vehicleSelect.selectedOptions.length !== vehicleSelect.options.length) {
                selectAllCheckbox.checked = false;
            }
            updateVehicleCount();
        });
    });
</script>

@endsection
