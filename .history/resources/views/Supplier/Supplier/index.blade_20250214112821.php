@extends('base')

@section('title', 'Supplier List')

@section('content')
    <div class="container">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/suppliers') }}">Supplier Management</a></li>
                <li class="breadcrumb-item active" aria-current="page">Supplier List</li>
            </ol>
        </nav>

        <h3 class="my-4">Suppliers</h3>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Supplier List Table -->
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Company Name</th>
                    <th>Business Type</th>
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
