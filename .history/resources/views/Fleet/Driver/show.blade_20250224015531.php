@extends('base')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/fleet') }}">Fleet Management</a></li>
        <li class="breadcrumb-item"><a href="{{ route('driver.index') }}">Driver List</a></li>
        <li class="breadcrumb-item active" aria-current="page">Driver Details</li>
    </ol>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Driver Details
                        <a href="{{ route('driver.index') }}" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Profile Picture</th>
                            <td>
                                @if ($driver->profile_picture)
                                    <img src="{{ asset('storage/' . $driver->profile_picture) }}" width="100px" alt="Profile Picture">
                                @else
                                    No image uploaded
                                @endif
                            </td>
                        </tr>
                        <tr><th>Driver Name</th><td>{{ $driver->driver_name }}</td></tr>
                        <tr><th>Date of Birth</th><td>{{ $driver->date_of_birth }}</td></tr>
                        <tr><th>Gender</th><td>{{ $driver->gender }}</td></tr>
                        <tr><th>National ID Number</th><td>{{ $driver->national_id_number }}</td></tr>
                        <tr><th>License Number</th><td>{{ $driver->license_number }}</td></tr>
                        <tr><th>License Category</th><td>{{ $driver->license_category }}</td></tr>
                        <tr><th>License Expiry Date</th><td>{{ $driver->license_expiry_date }}</td></tr>
                        <tr><th>Contact Number</th><td>{{ $driver->contact_number }}</td></tr>
                        <tr><th>Email</th><td>{{ $driver->email }}</td></tr>
                        <tr><th>Address</th><td>{{ $driver->address }}</td></tr>
                        <tr><th>Employment Status</th><td>{{ $driver->employment_status }}</td></tr>
                        <tr><th>Hire Date</th><td>{{ $driver->hire_date }}</td></tr>
                        <tr><th>Termination Date</th><td>{{ $driver->termination_date }}</td></tr>
                        <tr><th>Driving Experience (Years)</th><td>{{ $driver->driving_experience_years }}</td></tr>
                        <tr><th>Assigned Routes</th><td>{{ $driver->assigned_routes }}</td></tr>
                        <tr><th>Certifications</th><td>{{ $driver->certifications }}</td></tr>
                        <tr><th>Background Check Status</th><td>{{ $driver->background_check_status ? 'Passed' : 'Not Passed' }}</td></tr>
                        <tr><th>Accident History</th><td>{{ $driver->accident_history }}</td></tr>
                        <tr><th>Training Completed</th><td>{{ $driver->training_completed }}</td></tr>
                        <tr><th>Violation Records</th><td>{{ $driver->violation_records }}</td></tr>
                        <tr><th>Medical Fitness Certificate</th>
                            <td>
                                @if ($driver->medical_fitness_certificate)
                                    <a href="{{ asset('storage/' . $driver->medical_fitness_certificate) }}" target="_blank">View Certificate</a>
                                @else
                                    No certificate uploaded
                                @endif
                            </td>
                        </tr>
                        <tr><th>Blood Type</th><td>{{ $driver->blood_type }}</td></tr>
                        <tr><th>Emergency Contact Name</th><td>{{ $driver->emergency_contact_name }}</td></tr>
                        <tr><th>Emergency Contact Number</th><td>{{ $driver->emergency_contact_number }}</td></tr>
                        <tr><th>Status</th><td>{{ $driver->status }}</td></tr>
                        <tr><th>Remarks</th><td>{{ $driver->remarks }}</td></tr>
                    </table>

                    <a href="{{ route('driver.edit', $driver->id) }}" class="btn btn-primary">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
