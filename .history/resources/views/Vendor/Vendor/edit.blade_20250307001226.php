@extends('base')

@section('content')
<div class="container">
    <h2>Edit Vendor</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('vendor.update', $vendor->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Vendor Details --}}
        <div class="card mb-3">
            <div class="card-header">Vendor Information</div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Business Name</label>
                    <input type="text" name="business_name" class="form-control" value="{{ $vendor->business_name }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Registration Number</label>
                    <input type="text" name="registration_number" class="form-control" value="{{ $vendor->registration_number }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Business Type</label>
                    <input type="text" name="business_type" class="form-control" value="{{ $vendor->business_type }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Contact Email</label>
                    <input type="email" name="contact_email" class="form-control" value="{{ $vendor->contact_email }}" required>
                </div>

                {{-- Status Dropdown --}}
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="Active" {{ $vendor->status == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ $vendor->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="Pending" {{ $vendor->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Admin_Review" {{ $vendor->status == 'Admin_Review' ? 'selected' : '' }}>Admin Review</option>
                        <option value="Manager_Approved" {{ $vendor->status == 'Manager_Approved' ? 'selected' : '' }}>Manager Approved</option>
                    </select>
                </div>
                
            </div>
        </div>


        <button type="submit" class="btn btn-primary">Update Vendor</button>
        <a href="{{ route('vendor.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
