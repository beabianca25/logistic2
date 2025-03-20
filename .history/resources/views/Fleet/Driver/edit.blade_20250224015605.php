@extends('base')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/fleet') }}">Fleet Management</a></li>
        <li class="breadcrumb-item"><a href="{{ route('driver.index') }}">Driver List</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Driver</li>
    </ol>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Driver
                        <a href="{{ route('driver.index') }}" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('driver.update', $driver->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Driver Name</label>
                            <input type="text" name="driver_name" class="form-control" value="{{ $driver->driver_name }}" required>
                        </div>

                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input type="date" name="date_of_birth" class="form-control" value="{{ $driver->date_of_birth }}">
                        </div>

                        <div class="form-group">
                            <label>License Number</label>
                            <input type="text" name="license_number" class="form-control" value="{{ $driver->license_number }}" required>
                        </div>

                        <div class="form-group">
                            <label>License Expiry Date</label>
                            <input type="date" name="license_expiry_date" class="form-control" value="{{ $driver->license_expiry_date }}">
                        </div>

                        <div class="form-group">
                            <label>Contact Number</label>
                            <input type="text" name="contact_number" class="form-control" value="{{ $driver->contact_number }}" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $driver->email }}">
                        </div>

                        <div class="form-group">
                            <label>Employment Status</label>
                            <select name="employment_status" class="form-control">
                                <option value="Full-Time" {{ $driver->employment_status == 'Full-Time' ? 'selected' : '' }}>Full-Time</option>
                                <option value="Part-Time" {{ $driver->employment_status == 'Part-Time' ? 'selected' : '' }}>Part-Time</option>
                                <option value="Contract" {{ $driver->employment_status == 'Contract' ? 'selected' : '' }}>Contract</option>
                                <option value="Temporary" {{ $driver->employment_status == 'Temporary' ? 'selected' : '' }}>Temporary</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="Active" {{ $driver->status == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ $driver->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Remarks</label>
                            <textarea name="remarks" class="form-control">{{ $driver->remarks }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Update Driver</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
