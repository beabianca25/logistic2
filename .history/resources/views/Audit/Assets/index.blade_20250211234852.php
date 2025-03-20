@extends('base')

@section('content')
<div class="container">
    <h2>Asset List</h2>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('assets.create') }}" class="btn btn-primary mb-3">Add New Asset</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Asset Name</th>
                <th>Category</th>
                <th>Asset Tag</th>
                <th>Purchase Date</th>
                <th>Supplier</th>
                <th>Cost</th>
                <th>Usage Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($assets as $asset)
                <tr>
                    <td>{{ $asset->id }}</td>
                    <td>{{ $asset->asset_name }}</td>
                    <td>{{ $asset->asset_category }}</td>
                    <td>{{ $asset->asset_tag }}</td>
                    <td>{{ $asset->purchase_date }}</td>
                    <td>{{ $asset->supplier_vendor }}</td>
                    <td>${{ number_format($asset->cost_of_asset, 2) }}</td>
                    <td>{{ $asset->usage_status }}</td>
                    <td>
                        <a href="{{ route('assets.show', $asset->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('assets.edit', $asset->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this asset?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No assets found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
