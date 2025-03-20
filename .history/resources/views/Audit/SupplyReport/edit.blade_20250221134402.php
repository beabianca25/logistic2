@extends('base')

@section('content')
    <div class="container mt-5">
        <h2>Edit Supply Report</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('supplyreport.update', $supplyReport->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="supply_id" class="form-label">Supply Name</label>
                <select name="supply_id" id="supply_id" class="form-control">
                    @foreach ($supplies as $supply)
                        <option value="{{ $supply->id }}" {{ $supplyReport->supply_id == $supply->id ? 'selected' : '' }}>
                            {{ $supply->supply_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="report_title" class="form-label">Report Title</label>
                <input type="text" name="report_title" id="report_title" class="form-control" value="{{ $supplyReport->report_title }}" required>
            </div>

            <div class="mb-3">
                <label for="report_details" class="form-label">Report Details</label>
                <textarea name="report_details" id="report_details" class="form-control" required>{{ $supplyReport->report_details }}</textarea>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="Pending Review" {{ $supplyReport->status == 'Pending Review' ? 'selected' : '' }}>Pending Review</option>
                    <option value="Reviewed" {{ $supplyReport->status == 'Reviewed' ? 'selected' : '' }}>Reviewed</option>
                    <option value="Resolved" {{ $supplyReport->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="document_status" class="form-label">Document Status</label>
                <select name="document_status" id="document_status" class="form-control">
                    <option value="Pending" {{ $supplyReport->document_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Submitted" {{ $supplyReport->document_status == 'Submitted' ? 'selected' : '' }}>Submitted</option>
                    <option value="Approved" {{ $supplyReport->document_status == 'Approved' ? 'selected' : '' }}>Approved</option>
                    <option value="Rejected" {{ $supplyReport->document_status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="submitted_at" class="form-label">Submitted At</label>
                <input type="date" name="submitted_at" id="submitted_at" class="form-control" value="{{ $supplyReport->submitted_at }}">
            </div>

            <button type="submit" class="btn btn-primary">Update Report</button>
            <a href="{{ route('supplyreport.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
