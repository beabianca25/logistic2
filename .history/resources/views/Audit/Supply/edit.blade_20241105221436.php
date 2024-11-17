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
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Driver
                            <a href="{{ url('supply') }}" class="btn btn-primary float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('supply.update', $supply) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                        
                            <label>Supply Name:</label>
                            <input type="text" name="supply_name" value="{{ $supply->supply_name }}" required>
                        
                            <label>Category:</label>
                            <input type="text" name="category" value="{{ $supply->category }}" required>
                        
                            <label>Quantity:</label>
                            <input type="number" name="quantity" value="{{ $supply->quantity }}" required>
                        
                            <label>Audit Date:</label>
                            <input type="date" name="audit_date" value="{{ $supply->audit_date }}" required>
                        
                            <label>Location:</label>
                            <input type="text" name="location" value="{{ $supply->location }}" required>
                        
                            <label>Condition:</label>
                            <input type="text" name="condition" value="{{ $supply->condition }}" required>
                        
                            <label>Status:</label>
                            <input type="text" name="status" value="{{ $supply->status }}" required>
                        
                            <label>Remarks:</label>
                            <textarea name="remarks">{{ $supply->remarks }}</textarea>
                        
                            <label>Auditor Name:</label>
                            <input type="text" name="auditor_name" value="{{ $supply->auditor_name }}" required>
                        
                            <label>Attachment:</label>
                            <input type="file" name="attachment">
                        
                            <button type="submit">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
