@extends('base')

@section('content')
<div class="container">
    <h2 class="mt-3">Edit Maintenance Record</h2>
    <a href="{{ route('maintenance.index') }}" class="btn btn-danger mb-3">Back</a>

    <form action="{{ route('maintenance.update', $maintenance->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="vehicle_id">Vehicle</label>
            <select name="vehicle_id" class="form-control">
                @foreach ($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}" {{ $vehicle->id == $maintenance->vehicle_id ? 'selected' : '' }}>
                        {{ $vehicle->license_plate }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="maintenance_type">Maintenance Type</label>
            <input type="text" name="maintenance_type" class="form-control" value="{{ $maintenance->maintenance_type }}" required>
        </div>

        <div class="form-group">
            <label for="maintenance_date">Maintenance Date</label>
            <input type="date" name="maintenance_date" class="form-control" value="{{ $maintenance->maintenance_date }}" required>
        </div>

        <div class="form-group">
            <label for="service_vendor">Service Vendor</label>
            <input type="text" name="service_vendor" class="form-control" value="{{ $maintenance->service_vendor }}" required>
        </div>

        <div class="form-group">
            <label for="service_vendor_contact">Service Vendor Contact</label>
            <input type="text" name="service_vendor_contact" class="form-control" value="{{ $maintenance->service_vendor_contact }}">
        </div>

        <div class="form-group">
            <label for="labor_cost">Labor Cost ($)</label>
            <input type="number" step="0.01" name="labor_cost" class="form-control" value="{{ $maintenance->labor_cost }}">
        </div>

        <div class="form-group">
            <label for="parts_cost">Parts Cost ($)</label>
            <input type="number" step="0.01" name="parts_cost" class="form-control" value="{{ $maintenance->parts_cost }}">
        </div>

        <div class="form-group">
            <label for="total_cost">Total Cost ($)</label>
            <input type="number" step="0.01" name="total_cost" class="form-control" value="{{ $maintenance->total_cost }}">
        </div>

        <div class="form-group">
            <label for="parts_replaced">Parts Replaced</label>
            <textarea name="parts_replaced" class="form-control">{{ $maintenance->parts_replaced }}</textarea>
        </div>

        <div class="form-group">
            <label for="odometer_reading">Odometer Reading</label>
            <input type="number" name="odometer_reading" class="form-control" value="{{ $maintenance->odometer_reading }}">
        </div>

        <div class="form-group">
            <label for="warranty_period">Warranty Period</label>
            <input type="text" name="warranty_period" class="form-control" value="{{ $maintenance->warranty_period }}">
        </div>

        <div class="form-group">
            <label for="next_service_due">Next Service Due</label>
            <input type="date" name="next_service_due" class="form-control" value="{{ $maintenance->next_service_due }}">
        </div>

        <div class="form-group">
            <label for="issue_reported">Issue Reported</label>
            <textarea name="issue_reported" class="form-control">{{ $maintenance->issue_reported }}</textarea>
        </div>

        <div class="form-group">
            <label for="issue_fixed">Issue Fixed</label>
            <textarea name="issue_fixed" class="form-control">{{ $maintenance->issue_fixed }}</textarea>
        </div>

        <div class="form-group">
            <label for="technician_name">Technician Name</label>
            <input type="text" name="technician_name" class="form-control" value="{{ $maintenance->technician_name }}">
        </div>

        <div class="form-group">
            <label for="maintenance_notes">Maintenance Notes</label>
            <textarea name="maintenance_notes" class="form-control">{{ $maintenance->maintenance_notes }}</textarea>
        </div>

        <div class="form-group">
            <label for="maintenance_status">Maintenance Status</label>
            <select name="maintenance_status" class="form-control">
                <option value="Pending" {{ $maintenance->maintenance_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="In Progress" {{ $maintenance->maintenance_status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                <option value="Completed" {{ $maintenance->maintenance_status == 'Completed' ? 'selected' : '' }}>Completed</option>
                <option value="Cancelled" {{ $maintenance->maintenance_status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <div class="form-group">
            <label for="approved_by">Approved By</label>
            <select name="approved_by" class="form-control">
                <option value="">Select Approver</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $maintenance->approved_by ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Maintenance</button>
    </form>
</div>
@endsection
