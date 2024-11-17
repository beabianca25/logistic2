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

                        <form action="{{ route('trip.update', $trip->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                    
                            <div class="form-group">
                    
                            <div class="form-group">
                                <label for="starting_location">Starting Location</label>
                                <input type="text" name="starting_location" class="form-control" value="{{ $trip->starting_location }}" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="destination">Destination</label>
                                <input type="text" name="destination" class="form-control" value="{{ $trip->destination }}" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="departure_time">Departure Time</label>
                                <input type="datetime-local" name="departure_time" class="form-control" value="{{ $trip->departure_time->format('Y-m-d\TH:i') }}" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="expected_arrival_time">Expected Arrival Time</label>
                                <input type="datetime-local" name="expected_arrival_time" class="form-control" value="{{ $trip->expected_arrival_time->format('Y-m-d\TH:i') }}" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="scheduled" {{ $trip->status == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                                    <option value="ongoing" {{ $trip->status == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                    <option value="completed" {{ $trip->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="delayed" {{ $trip->status == 'delayed' ? 'selected' : '' }}>Delayed</option>
                                </select>
                            </div>
                    
                            <button type="submit" class="btn btn-success mt-3">Update Trip</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
