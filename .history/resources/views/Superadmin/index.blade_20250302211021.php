@extends('superadminbase')

@section('content')
<div class="container">
    <h2>Manage User Permissions</h2>

    <table class="table">
        <thead>
            <tr>
                <th>User</th>
                <th>Vendor View</th>
                <th>Vendor Manage</th>
                <th>Audit Logs</th>
                <th>Vehicle Management</th>
                <th>Auction View</th>
                <th>Auction Manage</th>
                <th>Bid View</th> <!-- NEW COLUMN -->
                <th>Bid Manage</th> <!-- NEW COLUMN -->
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>
                    <form action="{{ route('superadmin.updatePermissions', $user->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="permissions[vendor_view]" value="0">
                        <input type="checkbox" name="permissions[vendor_view]" value="1" {{ $user->hasPermission('vendor_view') ? 'checked' : '' }}>
                        <a href="{{ route('vendor.index') }}" class="btn btn-link">View</a>
                </td>
                <td>
                        <input type="hidden" name="permissions[vendor_manage]" value="0">
                        <input type="checkbox" name="permissions[vendor_manage]" value="1" {{ $user->hasPermission('vendor_manage') ? 'checked' : '' }}>
                </td>
                <td>
                        <input type="hidden" name="permissions[audit_logs]" value="0">
                        <input type="checkbox" name="permissions[audit_logs]" value="1" {{ $user->hasPermission('audit_logs') ? 'checked' : '' }}>
                        <a href="{{ route('assets.index') }}" class="btn btn-link">View</a>
                </td>
                <td>
                        <input type="hidden" name="permissions[vehicle_management]" value="0">
                        <input type="checkbox" name="permissions[vehicle_management]" value="1" {{ $user->hasPermission('vehicle_management') ? 'checked' : '' }}>
                        <a href="{{ route('vehicle.index') }}" class="btn btn-link">View</a>
                </td>
                <td>
                        <input type="hidden" name="permissions[auction_view]" value="0">
                        <input type="checkbox" name="permissions[auction_view]" value="1" {{ $user->hasPermission('auction_view') ? 'checked' : '' }}>
                        <a href="{{ route('auction.index') }}" class="btn btn-link">View</a>
                </td>
                <td>
                        <input type="hidden" name="permissions[auction_manage]" value="0">
                        <input type="checkbox" name="permissions[auction_manage]" value="1" {{ $user->hasPermission('auction_manage') ? 'checked' : '' }}>
                </td>
                <td>
                        <input type="hidden" name="permissions[bid_view]" value="0"> <!-- NEW FIELD -->
                        <input type="checkbox" name="permissions[bid_view]" value="1" {{ $user->hasPermission('bid_view') ? 'checked' : '' }}>
                        <a href="{{ route('bid.index') }}" class="btn btn-link">View</a>
                </td>
                <td>
                        <input type="hidden" name="permissions[bid_manage]" value="0"> <!-- NEW FIELD -->
                        <input type="checkbox" name="permissions[bid_manage]" value="1" {{ $user->hasPermission('bid_manage') ? 'checked' : '' }}>
                </td>
                <td>
                    <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
