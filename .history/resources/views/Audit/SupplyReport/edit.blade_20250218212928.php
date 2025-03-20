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

        <form action="{{ route('supplyreport.update', $report->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="supply_name" class="form-label">Supply Name</label>
                <input type="text" class="form-control" id="supply_name" value="{{ $report->supply->supply_name ?? 'No Supply' }}" disabled>
            </div>

            <div class="mb-3">
                <label for="report_title" class="form-label">Report Title</label>
                <input type="text" class="form-control" name="report_title" id="report_title" value="{{ old('report_title', $report->report_title) }}" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" name="status" id="status" required>
                    <option value="Pending" {{ $report->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Approved" {{ $report->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                    <option value="Rejected" {{ $report->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" name="location" id="location" value="{{ old('location', $report->location) }}" required>
            </div>

            <div class="mb-3">
                <label for="report_date" class="form-label">Report Date</label>
                <input type="date" class="form-control" name="report_date" id="report_date" value="{{ old('report_date', $report->report_date) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Report</button>
            <a href="{{ route('supplyreport.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
