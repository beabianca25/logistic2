@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Fuel Details</h2>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Vehicle</th>
                    <td>{{ $fuel->vehicle->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Refill Date</th>
                    <td>{{ $fuel->refill_date }}</td>
                </tr>
                <tr>
                    <th>Fuel Amount (Liters)</th>
                    <td>{{ $fuel->fuel_amount }}</td>
                </tr>
                <tr>
                    <th>Cost Per Liter</th>
                    <td>{{ $fuel->cost }}</td>
                </tr>
                <tr>
                    <th>Total Cost</th>
                    <td>{{ $fuel->total_cost ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Fuel Station</th>
                    <td>{{ $fuel->fuel_station }}</td>
                </tr>
                <tr>
                    <th>Station Location</th>
                    <td>{{ $fuel->fuel_station_location ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Fuel Type</th>
                    <td>{{ $fuel->fuel_type }}</td>
                </tr>
                <tr>
                    <th>Odometer Reading</th>
                    <td>{{ $fuel->odometer_reading ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Fuel Efficiency</th>
                    <td>{{ $fuel->fuel_efficiency ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Payment Method</th>
                    <td>{{ $fuel->payment_method }}</td>
                </tr>
                <tr>
                    <th>Receipt Number</th>
                    <td>{{ $fuel->receipt_number ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Vendor Contact</th>
                    <td>{{ $fuel->vendor_contact ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Fuel Status</th>
                    <td>{{ $fuel->fuel_status }}</td>
                </tr>
                <tr>
                    <th>Approved By</th>
                    <td>{{ $fuel->approvedBy->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $fuel->created_at }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ $fuel->updated_at }}</td>
                </tr>
            </table>
            <a href="{{ route('fuels.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
@endsection
