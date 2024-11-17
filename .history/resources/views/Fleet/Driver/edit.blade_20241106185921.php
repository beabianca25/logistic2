@extends('base')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Fleet Management</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/auction') }}">Vehicle List</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Details</li>
    </ol>
</nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Driver Request
                            <a href="{{ route('driver.index') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
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

                        <form action="{{ route('driver.update', $driver->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                    
                            <div class="form-group">
                                <label for="driver_name">Driver Name</label>
                                <input type="text" name="driver_name" class="form-control" value="{{ $driver->driver_name }}" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="license_number">License Number</label>
                                <input type="text" name="license_number" class="form-control" value="{{ $driver->license_number }}" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="contact_number">Contact Number</label>
                                <input type="text" name="contact_number" class="form-control" value="{{ $driver->contact_number }}" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $driver->email }}" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" class="form-control" value="{{ $driver->address }}" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="certifications">Certifications</label>
                                <input type="text" name="certifications" class="form-control" value="{{ $driver->certifications }}">
                            </div>
                    
                            <div class="form-group">
                                <label for="license_expiry_date">License Expiry Date</label>
                                <input type="date" name="license_expiry_date" class="form-control" value="{{ $driver->license_expiry_date }}">
                            </div>
                    
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control">
                                    <option value="active" {{ $driver->status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ $driver->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                    
                            <button type="submit" class="btn btn-success mt-3">Update Driver</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
