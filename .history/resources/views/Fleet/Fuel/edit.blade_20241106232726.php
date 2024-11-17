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
                            <a href="{{ route('maintenance.index') }}" class="btn btn-danger float-end">Back</a>
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

                        <form action="{{ route('maintenance.update', $maintenance->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                    
                            <div class="form-group">
                                <label for="vehicle_id">Vehicle</label>
                                <select name="vehicle_id" id="vehicle_id" class="form-control" required>
                                    <option value="">Select a Vehicle</option>
                                    @foreach ($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}" {{ $maintenance->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                                            {{ $vehicle->license_plate }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                    
                            <div class="form-group">
                                <label for="maintenance_type">Maintenance Type</label>
                                <input type="text" name="maintenance_type" id="maintenance_type" class="form-control" value="{{ old('maintenance_type', $maintenance->maintenance_type) }}" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="maintenance_date">Maintenance Date</label>
                                <input type="date" name="maintenance_date" id="maintenance_date" class="form-control" value="{{ \Carbon\Carbon::parse($maintenance->maintenance_date)->format('Y-m-d H:i') }}" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="service_vendor">Service Vendor</label>
                                <input type="text" name="service_vendor" id="service_vendor" class="form-control" value="{{ old('service_vendor', $maintenance->service_vendor) }}" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="cost">Cost</label>
                                <input type="number" name="cost" id="cost" class="form-control" value="{{ old('cost', $maintenance->cost) }}" step="0.01" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="pending" {{ $maintenance->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="completed" {{ $maintenance->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </div>
                    
                            <button type="submit" class="btn btn-success">Update Maintenance</button>
                            <a href="{{ route('maintenance.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
