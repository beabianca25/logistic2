@extends('base')

@section('content')
<div class="container">
    <h2 class="mt-3">Maintenance Details</h2>
    <a href="{{ route('maintenance.index') }}" class="btn btn-danger mb-3">Back</a>

    <table class="table table-bordered">
        <tr>
            <th>Vehicle</th>
            <td>{{ $maintenance->vehicle->license_plate ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Maintenance Type</th>
            <td>{{ $maintenance->maintenance_type }}</td>
        </tr>
        <tr>
            <th>Maintenance Date</th>
            <td>{{ $maintenance->maintenance_date }}</td>
        </tr>
        <tr>
            <th>Service Vendor</th>
            <td>{{ $maintenance->service_vendor }}</td>
        </tr>
        <tr>
            <th>Service Vendor Contact</th>
            <td>{{ $maintenance->service_vendor_contact }}</td>
        </tr>
        <tr>
            <th>Labor Cost</th>
            <td>${{ number_format($maintenance->labor_cost, 2) }}</td>
        </tr>
        <tr>
            <th>Parts Cost</th>
            <td>${{ number_format($maintenance->parts_cost, 2) }}</td>
        </tr>
        <tr>
            <th>Total Cost</th>
            <td>${{ number_format($maintenance->total_cost, 2) }}</td>
        </tr>
        <tr>
            <th>Parts Replaced</th>
            <td>{{ $maintenance->parts_replaced }}</td>
        </tr>
        <tr>
            <th>Odometer Reading</th>
            <td>{{ $maintenance->odometer_reading }} km</td>
        </tr>
        <tr>
            <th>Issue Reported</th>
            <td>{{ $maintenance->issue_reported }}</td>
        </tr>
        <tr>
            <th>Issue Fixed</th>
            <td>{{ $maintenance->issue_fixed }}</td>
        </tr>
        <tr>
            <th>Technician Name</th>
            <td>{{ $maintenance->technician_name }}</td>
        </tr>
        <tr>
            <th>Maintenance Status</th>
            <td>{{ $maintenance->maintenance_status }}</td>
        </tr>
        <tr>
            <th>Approved By</th>
            <td>{{ $maintenance->approver->name ?? 'N/A' }}</td>
        </tr>
    </table>

    <a href="{{ route('maintenance.edit', $maintenance->id) }}" class="btn btn-warning">Edit</a>
</div>
@endsection
