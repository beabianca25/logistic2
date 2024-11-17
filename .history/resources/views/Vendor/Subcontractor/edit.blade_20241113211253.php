@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Vendor Portal</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/supplier') }}">Supplier</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Details</li>
        </ol>
    </nav>

    <div class="container" style="font-size: 0.9rem; font-family: serif;">
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

                        <form action="{{ route('subcontractors.update', $subcontractor->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Subcontractor Name</label>
                                <input type="text" name="subcontractor_name" class="form-control" value="{{ $subcontractor->subcontractor_name }}" required>
                            </div>
                            <div class="form-group">
                                <label>Project Scope</label>
                                <textarea name="project_scope" class="form-control" required>{{ $subcontractor->project_scope }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Cost Estimate</label>
                                <input type="number" name="cost_estimate" class="form-control" step="0.01" value="{{ $subcontractor->cost_estimate }}" required>
                            </div>
                            <div class="form-group">
                                <label>Timeline</label>
                                <input type="text" name="timeline" class="form-control" value="{{ $subcontractor->timeline }}" required>
                            </div>
                            <div class="form-group">
                                <label>Resources Required</label>
                                <textarea name="resources_required" class="form-control">{{ $subcontractor->resources_required }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Contact Information</label>
                                <input type="text" name="contact_information" class="form-control" value="{{ $subcontractor->contact_information }}" required>
                            </div>
                            <div class="form-group">
                                <label>Submitted Date</label>
                                <input type="date" name="submitted_date" class="form-control" value="{{ $subcontractor->submitted_date }}" required>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="Pending" {{ $subcontractor->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Admin_Review" {{ $subcontractor->status == 'Admin_Review' ? 'selected' : '' }}>Admin Review</option>
                                    <option value="Buyer_Approved" {{ $subcontractor->status == 'Buyer_Approved' ? 'selected' : '' }}>Buyer Approved</option>
                                    <option value="Manager_Approved" {{ $subcontractor->status == 'Manager_Approved' ? 'selected' : '' }}>Manager Approved</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Update Request</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
