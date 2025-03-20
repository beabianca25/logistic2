@extends('base')

@section('title', 'Subcontractor Details')

@section('content')
    <div class="container">
        <h1>Subcontractor Details</h1>

        <!-- Subcontractor Information -->
        <div class="info">
            <p><strong>Name:</strong> {{ $subcontractor->subcontractor_name }}</p>
            <p><strong>Business Registration Number:</strong> {{ $subcontractor->business_registration_number }}</p>
            <p><strong>Contact Person:</strong> {{ $subcontractor->contact_person }}</p>
            <p><strong>Business Address:</strong> {{ $subcontractor->business_address }}</p>
            <p><strong>Phone:</strong> {{ $subcontractor->phone }}</p>
            <p><strong>Email:</strong> {{ $subcontractor->email }}</p>
            <p><strong>Website:</strong>
                <a href="{{ $subcontractor->website }}" target="_blank">{{ $subcontractor->website }}</a>
            </p>
            <p><strong>Services Offered:</strong> {{ $subcontractor->services_offered }}</p>
            <p><strong>Relevant Experience:</strong> {{ $subcontractor->relevant_experience }}</p>
        </div>

        <!-- Requirements Section -->
        <h2>Requirements</h2>
        <div class="info">
            @foreach ($subcontractor->requirements as $requirement)
                <p><strong>Estimated Cost:</strong> {{ $requirement->estimated_cost }}</p>
                <p><strong>Preferred Payment Terms:</strong> {{ $requirement->preferred_payment_terms }}</p>
                <p><strong>Start Date Availability:</strong> {{ $requirement->start_date_availability }}</p>
                <p><strong>Estimated Completion Time:</strong> {{ $requirement->estimated_completion_time }}</p>
                <p><strong>Resources Required:</strong> {{ $requirement->resources_required }}</p>
                <p><strong>Insurance Coverage:</strong> {{ $requirement->insurance_coverage }}</p>
                <p><strong>Certifications or Licenses:</strong> {{ $requirement->certifications_or_licenses }}</p>
            @endforeach
        </div>

        <!-- Attachments Section -->

        <h1>Subcontractor Attachment Details</h1>
        $@foreach ($subcontractor->attachments as $attachment)
            <div class="details">
                <label>Portfolio Samples:</label>
                <a href="{{ asset('storage/' . $attachment->portfolio_samples) }}" target="_blank">View File</a>
            </div>

            <div class="details">
                <label>Business Licenses:</label>
                <a href="{{ asset('storage/' . $attachment->business_licenses) }}" target="_blank">View File</a>
            </div>

            <div class="details">
                <label>Agreement Acknowledged:</label>
                <span>{{ $attachment->agreement_acknowledged ? 'Yes' : 'No' }}</span>
            </div>

            <div class="details">
                <label>Signature:</label>
                <a href="{{ asset('storage/' . $attachment->signature) }}" target="_blank">View File</a>
            </div>

            <div class="details">
                <label>Submission Date:</label>
                <span>{{ $attachment->submission_date }}</span>
            </div>
        @endforeach
        <!-- Back and Edit Buttons -->
        <div class="button-container mt-3">
            <a href="{{ route('subcontractor.index') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('subcontractor.edit', $subcontractor->id) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
@endsection
