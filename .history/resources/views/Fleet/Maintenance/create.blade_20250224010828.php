@extends('base')

@section('content')
<div class="container">
    <h2 class="mt-3">Add Maintenance Record</h2>
    <a href="{{ route('maintenance.index') }}" class="btn btn-danger mb-3">Back</a>

    <form action="{{ route('maintenance.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="vehicle_id">Vehicle</label>
            <select name="vehicle_id" class="form-control">
                <option value="">Select a Vehicle</option>
                @foreach ($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}">{{ $vehicle->license_plate }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="maintenance_type">Maintenance Type</label>
            <input type="text" name="maintenance_type" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="maintenance_date">Maintenance Date</label>
            <input type="date" name="maintenance_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="service_vendor">Service Vendor</label>
            <input type="text" name="service_vendor" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="service_vendor_contact">Service Vendor Contact</label>
            <input type="text" name="service_vendor_contact" class="form-control">
        </div>

        <div class="form-group">
            <label for="labor_cost">Labor Cost ($)</label>
            <input type="number" step="0.01" name="labor_cost" class="form-control">
        </div>

        <div class="form-group">
            <label for="parts_cost">Parts Cost ($)</label>
            <input type="number" step="0.01" name="parts_cost" class="form-control">
        </div>

        <div class="form-group">
            <label for="total_cost">Total Cost ($)</label>
            <input type="number" step="0.01" name="total_cost" class="form-control">
        </div>

        <div class="form-group">
            <label for="parts_replaced">Parts Replaced</label>
            <textarea name="parts_replaced" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="odometer_reading">Odometer Reading</label>
            <input type="number" name="odometer_reading" class="form-control">
        </div>

        <div class="form-group">
            <label for="warranty_period">Warranty Period</label>
            <input type="text" name="warranty_period" class="form-control">
        </div>

        <div class="form-group">
            <label for="next_service_due">Next Service Due</label>
            <input type="date" name="next_service_due" class="form-control">
        </div>

        <div class="form-group">
            <label for="issue_reported">Issue Reported</label>
            <textarea name="issue_reported" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="issue_fixed">Issue Fixed</label>
            <textarea name="issue_fixed" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="technician_name">Technician Name</label>
            <input type="text" name="technician_name" class="form-control">
        </div>

        <div class="form-group">
            <label for="maintenance_notes">Maintenance Notes</label>
            <textarea name="maintenance_notes" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="maintenance_status">Maintenance Status</label>
            <select name="maintenance_status" class="form-control">
                <option value="Pending">Pending</option>
                <option value="In Progress">In Progress</option>
                <option value="Completed">Completed</option>
                <option value="Cancelled">Cancelled</option>
            </select>
        </div>

        <div class="form-group">
            <label for="approved_by">Approved By</label>
            <select name="approved_by" class="form-control">
                <option value="">Select Approver</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Save Maintenance</button>
    </form>
</div>
@endsection
