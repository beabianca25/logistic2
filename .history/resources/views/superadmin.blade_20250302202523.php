@extends('superadminbase')

@section('content')
<div class="container">
    <h2>Manage User Permissions</h2>
    <table class="table">
        <thead>
            <tr>
                <th>User</th>
                <th>Vendor Management</th>
                <th>Audit Logs</th>
                <th>Vehicle Management</th>
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
                        <input type="hidden" name="permissions[vendor_management]" value="0">
                        <input type="checkbox" name="permissions[vendor_management]" value="1" {{ $user->hasPermission('vendor_management') ? 'checked' : '' }}>
                </td>
                <td>
                        <input type="hidden" name="permissions[audit_logs]" value="0">
                        <input type="checkbox" name="permissions[audit_logs]" value="1" {{ $user->hasPermission('audit_logs') ? 'checked' : '' }}>
                </td>
                <td>
                        <input type="hidden" name="permissions[vehicle_management]" value="0">
                        <input type="checkbox" name="permissions[vehicle_management]" value="1" {{ $user->hasPermission('vehicle_management') ? 'checked' : '' }}>
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
