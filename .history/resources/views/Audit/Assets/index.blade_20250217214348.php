<!-- resources/views/Audit/Asset/index.blade.php -->

@extends('base')

@section('content')
    <h1>Assets</h1>

    <a href="{{ route('assets.create') }}" class="btn btn-primary mb-3">Create New Asset</a>

    <table class="table">
        <thead>
            <tr>
                <th>Asset Name</th>
                <th>Category</th>
                <th>Asset Tag</th>
                <th>Supplier</th>
                <th>Location</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($assets as $asset)
                <tr>
                    <td>{{ $asset->asset_name }}</td>
                    <td>{{ $asset->asset_category }}</td>
                    <td>{{ $asset->asset_tag }}</td>
                    <td>{{ $asset->supplier_vendor }}</td>
                    <td>{{ $asset->location }}</td>
                    <td>{{ $asset->usage_status }}</td>
                    <td>
                        <a href="{{ route('asset.edit', $asset) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('asset.destroy', $asset) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
