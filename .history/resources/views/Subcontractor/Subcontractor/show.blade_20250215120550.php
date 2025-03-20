@extends('base')
@section('content')
    <div class="container" style="font-family: sans-serif; font-size: small;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/subcontractor') }}">Subcontractor Management</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/subcontractor') }}">Subcontractor List</a></li>
                <li class="breadcrumb-item active" aria-current="page">Show Details</li>
            </ol>
        </nav>

        <div class="container">
            <div class="row">
                <!-- General Information Section -->
                <div class="col-md-6">
                    <div class="card mb-6">
                        <div class="card-header">
                            <h4>Business Information</h4>
                        </div>
                        <div class="card-body row">
                            <div class="col-md-6">
                                <p><strong>Subcontractor Name:</strong> {{ $subcontractor->subcontractor_name }}</p>
                                <p><strong>Registration Number:</strong> {{ $subcontractor->business_registration_number }}
                                </p>
                                <p><strong>Contact Person:</strong> {{ $subcontractor->contact_person }}</p>
                                <p><strong>Address</Address>:</strong> {{ $subcontractor->business_address }}</p>
                                <p><strong>Phone:</strong> {{ $subcontractor->phone }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Email:</strong> {{ $subcontractor->email }}</p>
                                <p><strong>Website:</strong> {{ $subcontractor->website }}</p>
                                <p><strong>Service Offered:</strong> {{ $subcontractor->services_offered }}</p>
                                <p><strong>Experience:</strong> {{ $subcontractor->relevant_experience }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Project Details -->
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Requirements</h4>
                        </div>
                        <div class="card-body">
                            @foreach ($subcontractor->requirements as $requirement)
                                <p><strong>Project Scope:</strong> {{ $requirement->estimated_cost }}</p>
                                <p><strong>Timeline:</strong> {{ $subcontractor->timeline }}</p>
                                <p><strong>Budget:</strong> ${{ number_format($subcontractor->budget, 2) }}</p>
                                <p><strong>Timeline:</strong> {{ $subcontractor->timeline }}</p>
                                <p><strong>Timeline:</strong> {{ $subcontractor->timeline }}</p>
                                <p><strong>Timeline:</strong> {{ $subcontractor->timeline }}</p>
                                <p><strong>Timeline:</strong> {{ $subcontractor->timeline }}</p>
                                <p><strong>Project Scope:</strong> {{ $requirement->preffered }}</p>
                            @endforeach
                        </div>

                    </div>
                </div>

                <!-- Financial Details -->
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Financial Details</h4>
                        </div>
                        <div class="card-body">
                            <p><strong>Cost Estimate:</strong> ${{ number_format($subcontractor->cost_estimate, 2) }}</p>
                            <p><strong>Payment Terms:</strong> {{ $subcontractor->payment_terms }}</p>
                        </div>
                    </div>
                </div>

                <!-- Contract & Compliance -->
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Contract & Compliance</h4>
                        </div>
                        <div class="card-body">
                            <p><strong>Contract Status:</strong> {{ $subcontractor->contract_status }}</p>
                            <p><strong>Certifications:</strong> {{ $subcontractor->certifications }}</p>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="col-md-3 text-center mt-3">
                    <a href="{{ url('subcontractor') }}" class="btn btn-primary">Back</a>
                    <a href="{{ route('subcontractor.edit', $subcontractor->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('subcontractor.destroy', $subcontractor->id) }}" method="POST"
                        class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete this subcontractor?');">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
