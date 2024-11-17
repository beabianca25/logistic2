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

                        <form action="{{ route('fuel.update', $fuel->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-group">
                                <label for="vehicle_id">Vehicle</label>
                                <select name="vehicle_id" id="vehicle_id" class="form-control">
                                    <option value="">Select Vehicle</option>
                                    @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_type }}-{{ $vehicle->license_plate }}</option>
                                @endforeach
                                </select>
                            </div>
                    
                            <div class="form-group">
                                <label for="refill_date">Refill Date</label>
                                <input type="date" name="refill_date" id="refill_date" class="form-control" value="{{ \Carbon\Carbon::parse($fuel->refill_date)->format('Y-m-d') }}" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="fuel_amount">Fuel Amount (liters/gallons)</label>
                                <input type="number" step="0.01" name="fuel_amount" id="fuel_amount" class="form-control" value="{{ $fuel->fuel_amount }}" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="cost">Cost ($)</label>
                                <input type="number" step="0.01" name="cost" id="cost" class="form-control" value="{{ $fuel->cost }}" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="fuel_station">Fuel Station</label>
                                <input type="text" name="fuel_station" id="fuel_station" class="form-control" value="{{ $fuel->fuel_station }}" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="pending" {{ $fuel->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="completed" {{ $fuel->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </div>
                    
                            <button type="submit" class="btn btn-primary mt-3">Update Fuel Refill</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
