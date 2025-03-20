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
                <form action="{{ route('superadmin.updatePermissions', $user->id) }}" method="POST">
                    @csrf
                    @method('POST')
                    <td>{{ $user->name }}</td>
                    <td><input type="checkbox" name="permissions[vendor_management]" {{ $user->hasPermission('vendor_management') ? 'checked' : '' }}></td>
                    <td><input type="checkbox" name="permissions[audit_logs]" {{ $user->hasPermission('audit_logs') ? 'checked' : '' }}></td>
                    <td><input type="checkbox" name="permissions[vehicle_management]" {{ $user->hasPermission('vehicle_management') ? 'checked' : '' }}></td>
                    <td><button type="submit" class="btn btn-primary">Update</button></td>
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
