@extends('base')

@section('content')
<div class="container" style="font-family: sans-serif; font-size: small;">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/record') }}">Audit Management</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/record') }}">Record List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Record List</li>
        </ol>
    </nav>

    <div class="container">
        <!-- Trigger button for the modal -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createRecordModal">
            Create New Record
        </button>

        <!-- Modal Structure -->
        <div class="modal fade" id="createRecordModal" tabindex="-1" aria-labelledby="createRecordModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createRecordModalLabel">Create Record List</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('record.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="auditor_name">Auditor Name</label>
                                <input type="text" name="auditor_name" id="auditor_name" class="form-control" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="audit_type">Audit Type</label>
                                <select name="audit_type" id="audit_type" class="form-control" required>
                                    <option value="supplies">Supplies</option>
                                    <option value="assets">Assets</option>
                                </select>
                            </div>
                    
                            <div class="form-group">
                                <label for="item_or_asset_name">Item or Asset Name</label>
                                <input type="text" name="item_or_asset_name" id="item_or_asset_name" class="form-control" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="condition">Condition</label>
                                <textarea name="condition" id="condition" class="form-control"></textarea>
                            </div>
                    
                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea name="notes" id="notes" class="form-control"></textarea>
                            </div>
                    
                            <div class="form-group">
                                <label for="audit_date">Audit Date</label>
                                <input type="date" name="audit_date" id="audit_date" class="form-control" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input type="text" name="status" id="status" class="form-control" value="pending" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="actions_taken">Actions Taken</label>
                                <textarea name="actions_taken" id="actions_taken" class="form-control"></textarea>
                            </div>
                    
                            <button type="submit" class="btn btn-primary">Create Record</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
