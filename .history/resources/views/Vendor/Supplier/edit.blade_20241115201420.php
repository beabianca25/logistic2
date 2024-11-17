@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: sans-serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Vendor Portal</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/supplier') }}">Supplier</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Details</li>
        </ol>
    </nav>

    <div class="container" style="font-size: 0.9rem; font-family: sans-serif;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Supplier
                            <a href="{{ route('supplier.index') }}" class="btn btn-sm btn btn-danger float-end">Back</a>
                        </h5>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('supplier.update', $supplier->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="supplier_name" class="form-label">Supplier Name</label>
                                <input type="text" name="supplier_name" class="form-control"
                                    value="{{ $supplier->supplier_name }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="product_service_description" class="form-label">Product/Service
                                    Description</label>
                                <textarea name="product_service_description" class="form-control" required>{{ $supplier->product_service_description }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="price_quote" class="form-label">Price/Quote</label>
                                <input type="number" name="price_quote" step="0.01" class="form-control"
                                    value="{{ $supplier->price_quote }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="availability_lead_time" class="form-label">Availability/Lead Time</label>
                                <input type="text" name="availability_lead_time" class="form-control"
                                    value="{{ $supplier->availability_lead_time }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="contact_information" class="form-label">Contact Information</label>
                                <input type="text" name="contact_information" class="form-control"
                                    value="{{ $supplier->contact_information }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="attachments" class="form-label">Attachments</label>
                                <input type="file" name="attachments" class="form-control">
                            </div>

                            <!-- Status -->
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="Pending"
                                        {{ old('status', $supplier->status) == 'Pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="Admin_Review"
                                        {{ old('status', $supplier->status) == 'Admin_Review' ? 'selected' : '' }}>Admin
                                        Review</option>
                                    <option value="Buyer_Approved"
                                        {{ old('status', $supplier->status) == 'Buyer_Approved' ? 'selected' : '' }}>Buyer
                                        Approved</option>
                                    <option value="Manager_Approved"
                                        {{ old('status', $supplier->status) == 'Manager_Approved' ? 'selected' : '' }}>
                                        Manager Approved</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
