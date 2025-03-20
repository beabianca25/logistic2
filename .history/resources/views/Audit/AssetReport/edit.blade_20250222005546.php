@extends('base') {{-- Extend your main layout --}}

@section('content')
<div class="container">
    <h2 class="my-4">Edit Asset Report</h2>

    {{-- Display validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Edit Asset Report Form --}}
    <form action="{{ route('assetreport.update', $report->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Asset Selection --}}
        <div class="mb-3">
            <label for="asset_id" class="form-label">Select Asset</label>
            <select class="form-control" id="asset_id" name="asset_id" required>
                <option value="">-- Choose an Asset --</option>
                @foreach ($assets as $asset)
                    <option value="{{ $asset->id }}" {{ $report->asset_id == $asset->id ? 'selected' : '' }}>
                        {{ $asset->asset_name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Report Title --}}
        <div class="mb-3">
            <label for="report_title" class="form-label">Report Title</label>
            <input type="text" class="form-control" id="report_title" name="report_title" 
                value="{{ old('report_title', $report->report_title) }}" required>
        </div>

        {{-- Report Type --}}
        <div class="mb-3">
            <label for="report_type" class="form-label">Report Type</label>
            <select class="form-control" id="report_type" name="report_type" required>
                <option value="Maintenance" {{ $report->report_type == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                <option value="Damage" {{ $report->report_type == 'Damage' ? 'selected' : '' }}>Damage</option>
                <option value="Warranty Expired" {{ $report->report_type == 'Warranty Expired' ? 'selected' : '' }}>Warranty Expired</option>
                <option value="General" {{ $report->report_type == 'General' ? 'selected' : '' }}>General</option>
            </select>
        </div>

        {{-- Status --}}
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="Pending Review" {{ $report->status == 'Pending Review' ? 'selected' : '' }}>Pending Review</option>
                <option value="Reviewed" {{ $report->status == 'Reviewed' ? 'selected' : '' }}>Reviewed</option>
                <option value="Resolved" {{ $report->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
            </select>
        </div>

        {{-- Report Date --}}
        <div class="mb-3">
            <label for="report_date" class="form-label">Report Date</label>
            <input type="date" class="form-control" id="report_date" name="report_date" 
                value="{{ old('report_date', $report->report_date) }}" required>
        </div>

        {{-- Report Description --}}
        <div class="mb-3">
            <label for="report_details" class="form-label">Report Description</label>
            <textarea class="form-control" id="report_details" name="report_details" rows="4" required>{{ old('description', $report->report_details) }}</textarea>
        </div>

        {{-- Submit Button --}}
        <button type="submit" class="btn btn-primary">Update Report</button>
        <a href="{{ route('assetreport.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
