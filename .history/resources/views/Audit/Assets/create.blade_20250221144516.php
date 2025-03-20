@extends('base')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Create New Asset</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('assets.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Asset Name:</label>
                        <input type="text" name="asset_name" class="form-control" value="{{ old('asset_name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Category:</label>
                        <input type="text" name="asset_category" class="form-control" value="{{ old('asset_category') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Asset Tag:</label>
                        <input type="text" name="asset_tag" class="form-control" value="{{ old('asset_tag') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description:</label>
                        <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Purchase Date:</label>
                        <input type="date" name="purchase_date" class="form-control" value="{{ old('purchase_date') }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Supplier/Vendor:</label>
                        <input type="text" name="supplier_vendor" class="form-control" value="{{ old('supplier_vendor') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Invoice Number:</label>
                        <input type="text" name="invoice_number" class="form-control" value="{{ old('invoice_number') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Cost of Asset:</label>
                        <input type="number" step="0.01" name="cost_of_asset" class="form-control" value="{{ old('cost_of_asset') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Assigned To:</label>
                        <input type="text" name="assigned_to" class="form-control" value="{{ old('assigned_to') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Location:</label>
                        <input type="text" name="location" class="form-control" value="{{ old('location') }}">
                    </div>
                </div>
            </div>

            <div class="text-center mt-3">
                <button type="submit" class="btn btn-success">Save Asset</button>
            </div>
        </form>
    </div>
@endsection
