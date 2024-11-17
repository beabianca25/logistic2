@extends('base')

@section('content')
<div class="container" style="font-family: serif; font-size: small;">
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/assets') }}">Audit Management</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/assets') }}">Asset List</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Details</li>
    </ol>
</nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Asset
                            <a href="{{ url('supply') }}" class="btn btn-primary float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('assets.update', $asset->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="asset_name" class="form-label">Asset Name</label>
                                <input type="text" class="form-control" id="asset_name" name="asset_name" value="{{ $asset->asset_name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="asset_type" class="form-label">Asset Type</label>
                                <input type="text" class="form-control" id="asset_type" name="asset_type" value="{{ $asset->asset_type }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control" id="location" name="location" value="{{ $asset->location }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="condition" class="form-label">Condition</label>
                                <input type="text" class="form-control" id="condition" name="condition" value="{{ $asset->condition }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="acquisition_date" class="form-label">Acquisition Date</label>
                                <input type="date" class="form-control" id="acquisition_date" name="acquisition_date" value="{{ $asset->acquisition_date }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="assigned_department" class="form-label">Assigned Department</label>
                                <input type="text" class="form-control" id="assigned_department" name="assigned_department" value="{{ $asset->assigned_department }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Asset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
