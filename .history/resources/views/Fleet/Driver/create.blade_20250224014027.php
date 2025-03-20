@extends('base')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/fleet') }}">Fleet Management</a></li>
        <li class="breadcrumb-item"><a href="{{ route('driver.index') }}">Driver List</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add New Driver</li>
    </ol>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add New Driver
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

                    <form action="{{ route('driver.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Vehicle Association --}}
                        <div class="form-group">
                            <label>Assign Vehicle</label>
                            <select name="vehicle_id" class="form-control">
                                <option value="">Select a Vehicle</option>
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->license_plate }} - {{ $vehicle->model }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Personal Information --}}
                        <h4>Personal Information</h4>
                        <div class="form-group">
                            <label>Driver Name</label>
                            <input type="text" name="driver_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input type="date" name="date_of_birth" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" class="form-control">
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>National ID Number</label>
                            <input type="text" name="national_id_number" class="form-control">
                        </div>

                        {{-- License Details --}}
                        <h4>License Information</h4>
                        <div class="form-group">
                            <label>License Number</label>
                            <input type="text" name="license_number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>License Category</label>
                            <select name="license_category" class="form-control">
                                <option value="">Select</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>License Expiry Date</label>
                            <input type="date" name="license_expiry_date" class="form-control">
                        </div>

                        {{-- Contact Information --}}
                        <h4>Contact Information</h4>
                        <div class="form-group">
                            <label>Contact Number</label>
                            <input type="text" name="contact_number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address" class="form-control"></textarea>
                        </div>

                        {{-- Employment Details --}}
                        <h4>Employment Information</h4>
                        <div class="form-group">
                            <label>Employment Status</label>
                            <select name="employment_status" class="form-control">
                                <option value="Full-Time">Full-Time</option>
                                <option value="Part-Time">Part-Time</option>
                                <option value="Contract">Contract</option>
                                <option value="Temporary">Temporary</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Hire Date</label>
                            <input type="date" name="hire_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Termination Date</label>
                            <input type="date" name="termination_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Driving Experience (Years)</label>
                            <input type="number" name="driving_experience_years" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Assigned Routes</label>
                            <textarea name="assigned_routes" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Certifications</label>
                            <textarea name="certifications" class="form-control"></textarea>
                        </div>

                        {{-- Background & Safety --}}
                        <h4>Background & Safety</h4>
                        <div class="form-group">
                            <label>Background Check Status</label>
                            <select name="background_check_status" class="form-control">
                                <option value="1">Passed</option>
                                <option value="0">Not Passed</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Accident History</label>
                            <textarea name="accident_history" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Training Completed</label>
                            <textarea name="training_completed" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Violation Records</label>
                            <textarea name="violation_records" class="form-control"></textarea>
                        </div>

                        {{-- Medical Details --}}
                        <h4>Medical Information</h4>
                        <div class="form-group">
                            <label>Medical Fitness Certificate</label>
                            <input type="file" name="medical_fitness_certificate" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Blood Type</label>
                            <input type="text" name="blood_type" class="form-control">
                        </div>

                        {{-- Emergency Contact --}}
                        <h4>Emergency Contact</h4>
                        <div class="form-group">
                            <label>Emergency Contact Name</label>
                            <input type="text" name="emergency_contact_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Emergency Contact Number</label>
                            <input type="text" name="emergency_contact_number" class="form-control">
                        </div>

                        {{-- Profile Picture --}}
                        <div class="form-group">
                            <label>Profile Picture</label>
                            <input type="file" name="profile_picture" class="form-control">
                        </div>

                        {{-- Status & Remarks --}}
                        <h4>Other Details</h4>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Remarks</label>
                            <textarea name="remarks" class="form-control"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Add Driver</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
