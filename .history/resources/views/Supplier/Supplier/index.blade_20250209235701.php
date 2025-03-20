@extends('base')

@section('title', 'Supplier List')

@section('content')
    <div class="container">
        <h1 class="text-center">Suppliers</h1>
        <hr>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Add New Supplier Button -->
        <div class="mb-3">
            <a href="{{ route('supplier.create') }}" class="btn btn-primary">Add New Supplier</a>
        </div>

        <!-- Supplier List Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Company Name</th>
                    <th>Business Type</th>
                    <th>Contact Name</th>
                    <th>Contact Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($suppliers as $supplier)
                    <tr>
                        <td>{{ $supplier->id }}</td>
                        <td>{{ $supplier->company_name }}</td>
                        <td>{{ $supplier->business_type }}</td>
                        <td>{{ $supplier->contact_name }}</td>
                        <td>{{ $supplier->contact_email }}</td>
                        <td>
                            <a href="{{ route('supplier.show', $supplier->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No suppliers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
