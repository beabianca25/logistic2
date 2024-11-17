@extends('base')

@section('content')
<nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: serif;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Vendor Portal</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/supplier_request') }}">Supplier Request</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Details</li>
    </ol>
</nav>

<div class="container" style="font-size: 0.9rem; font-family: serif;">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Edit Supplier Request
                        <a href="{{ route('supplier_request.index') }}" class="btn btn-sm btn btn-danger float-end">Back</a>
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

                    <form action="{{ route('supplier_request.update', $supplier_request->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="supplier_name" class="form-label">Supplier Name</label>
                            <input type="text" name="supplier_name" class="form-control"
                                value="{{ $supplier_request->supplier_name }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="product_service_description" class="form-label">Product/Service Description</label>
                            <textarea name="product_service_description" class="form-control" required>{{ $supplier_request->product_service_description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="price_quote" class="form-label">Price/Quote</label>
                            <input type="number" name="price_quote" step="0.01" class="form-control"
                                value="{{ $supplier_request->price_quote }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="availability_lead_time" class="form-label">Availability/Lead Time</label>
                            <input type="text" name="availability_lead_time" class="form-control"
                                value="{{ $supplier_request->availability_lead_time }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="contact_information" class="form-label">Contact Information</label>
                            <input type="text" name="contact_information" class="form-control"
                                value="{{ $supplier_request->contact_information }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="attachments" class="form-label">Attachments</label>
                            <input type="file" name="attachments" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
