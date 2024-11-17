@extends('base')

@section('content')
<div class="container" style="font-family: serif; font-size: small;">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/driver') }}">Audit Management</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/driver') }}">Supply List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Details</li>
        </ol>
    </nav>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Supply Details
                        <a href="{{ url('supply') }}" class="btn btn-primary float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('supply.update', $supply) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="supply_name" class="form-label">Supply Name:</label>
                            <input type="text" name="supply_name" id="supply_name" class="form-control" value="{{ $supply->supply_name }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Category:</label>
                            <input type="text" name="category" id="category" class="form-control" value="{{ $supply->category }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity:</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $supply->quantity }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="audit_date" class="form-label">Audit Date:</label>
                            <input type="date" name="audit_date" id="audit_date" class="form-control" value="{{ $supply->audit_date }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">Location:</label>
                            <input type="text" name="location" id="location" class="form-control" value="{{ $supply->location }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="condition" class="form-label">Condition:</label>
                            <input type="text" name="condition" id="condition" class="form-control" value="{{ $supply->condition }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status:</label>
                            <input type="text" name="status" id="status" class="form-control" value="{{ $supply->status }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="remarks" class="form-label">Remarks:</label>
                            <textarea name="remarks" id="remarks" class="form-control">{{ $supply->remarks }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="auditor_name" class="form-label">Auditor Name:</label>
                            <input type="text" name="auditor_name" id="auditor_name" class="form-control" value="{{ $supply->auditor_name }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="attachment" class="form-label">Attachment:</label>
                            <input type="file" name="attachment" id="attachment" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
