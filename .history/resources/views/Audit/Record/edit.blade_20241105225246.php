@extends('base')

@section('content')
<div class="container" style="font-family: serif; font-size: small;">
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/record') }}">Audit Management</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/record') }}">Record List</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Details</li>
    </ol>
</nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Audit Record
                            <a href="{{ url('record') }}" class="btn btn-primary float-end">Back</a>
                        </h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('record.update', $record->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="auditor_name">Auditor Name</label>
                                <input type="text" name="auditor_name" id="auditor_name" class="form-control" value="{{ $record->auditor_name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="audit_type">Audit Type</label>
                                <select name="audit_type" id="audit_type" class="form-control" required>
                                    <option value="supplies" {{ $record->audit_type == 'supplies' ? 'selected' : '' }}>Supplies</option>
                                    <option value="assets" {{ $record->audit_type == 'assets' ? 'selected' : '' }}>Assets</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="item_or_asset_name">Item or Asset Name</label>
                                <input type="text" name="item_or_asset_name" id="item_or_asset_name" class="form-control" value="{{ $record->item_or_asset_name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="condition">Condition</label>
                                <textarea name="condition" id="condition" class="form-control">{{ $record->condition }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea name="notes" id="notes" class="form-control">{{ $record->notes }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="audit_date">Audit Date</label>
                                <input type="date" name="audit_date" id="audit_date" class="form-control" value="{{ $record->audit_date }}" required>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input type="text" name="status" id="status" class="form-control" value="{{ $record->status }}" required>
                            </div>
                            <div class="form-group">
                                <label for="actions_taken">Actions Taken</label>
                                <textarea name="actions_taken" id="actions_taken" class="form-control">{{ $auditrecord->actions_taken }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Record</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
