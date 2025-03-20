@extends('base')

@section('content')

    <div class="container mt-5">
        <h2>Asset List</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Button to Add New Asset -->
        <a href="{{ route('asset.create') }}" class="btn btn-success mb-3">Add New Asset</a>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Asset Name</th>
                    <th>Category</th>
                    <th>Assigned To</th>
                    <th>Usage Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($assets as $asset)
                    <tr>
                        <td>{{ $asset->id }}</td>
                        <td>{{ $asset->asset_name }}</td>
                        <td>{{ $asset->asset_category }}</td>
                        <td>{{ $asset->assigned_to ?? 'Unassigned' }}</td>
                        <td>{{ $asset->usage_status }}</td>
                        <td>
                            <a href="{{ route('asset.show', $asset->id) }}" class="btn btn-info btn-sm">Show</a>
                            <a href="{{ route('asset.edit', $asset->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <!-- Delete Form -->
                            <form action="{{ route('asset.destroy', $asset->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this asset?')">Delete</button>
                            </form>

                            <!-- Update Usage Status Form -->
                            <form action="{{ route('asset.update', $asset->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <select name="usage_status" class="form-control d-inline w-50">
                                    <option value="Active" {{ $asset->usage_status == 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="Under Maintenance" {{ $asset->usage_status == 'Under Maintenance' ? 'selected' : '' }}>Under Maintenance</option>
                                    <option value="Retired" {{ $asset->usage_status == 'Retired' ? 'selected' : '' }}>Retired</option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
