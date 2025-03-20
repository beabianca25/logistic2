@extends('base')

@section('title', 'Subcontractor Details')

@section('content')
    <div class="container">
        <h1 class="text-center">SUBCONTRACTOR APPLICATION FORM</h1>
        <h5 class="text-center">Reference Number: {{ $subcontractor->reference_number }}</h5>
        <hr>
        
        <!-- BUSINESS INFORMATION -->
        <h4>BUSINESS INFORMATION</h4>
        <table class="table table-bordered">
            <tr>
                <td><strong>Subcontractor Name:</strong></td>
                <td>{{ $subcontractor->subcontractor_name }}</td>
            </tr>
            <tr>
                <td><strong>Business Registration Number:</strong></td>
                <td>{{ $subcontractor->business_registration_number }}</td>
            </tr>
            <tr>
                <td><strong>Contact Person:</strong></td>
                <td>{{ $subcontractor->contact_person }}</td>
            </tr>
            <tr>
                <td><strong>Business Address:</strong></td>
                <td>{{ $subcontractor->business_address }}</td>
            </tr>
            <tr>
                <td><strong>Phone:</strong></td>
                <td>{{ $subcontractor->phone }}</td>
            </tr>
            <tr>
                <td><strong>Email:</strong></td>
                <td>{{ $subcontractor->email }}</td>
            </tr>
            <tr>
                <td><strong>Website:</strong></td>
                <td><a href="{{ $subcontractor->website }}" target="_blank">{{ $subcontractor->website }}</a></td>
            </tr>
            <tr>
                <td><strong>Services Offered:</strong></td>
                <td>{{ $subcontractor->services_offered }}</td>
            </tr>
            <tr>
                <td><strong>Relevant Experience:</strong></td>
                <td>{{ $subcontractor->relevant_experience }}</td>
            </tr>
        </table>

        <!-- REQUIREMENTS -->
        <h4>REQUIREMENTS</h4>
        <table class="table table-bordered">
            @foreach ($subcontractor->requirements as $requirement)
                <tr>
                    <td><strong>Estimated Cost:</strong></td>
                    <td>{{ $requirement->estimated_cost }}</td>
                </tr>
                <tr>
                    <td><strong>Preferred Payment Terms:</strong></td>
                    <td>{{ $requirement->preferred_payment_terms }}</td>
                </tr>
                <tr>
                    <td><strong>Start Date Availability:</strong></td>
                    <td>{{ $requirement->start_date_availability }}</td>
                </tr>
                <tr>
                    <td><strong>Estimated Completion Time:</strong></td>
                    <td>{{ $requirement->estimated_completion_time }}</td>
                </tr>
                <tr>
                    <td><strong>Resources Required:</strong></td>
                    <td>{{ $requirement->resources_required }}</td>
                </tr>
                <tr>
                    <td><strong>Insurance Coverage:</strong></td>
                    <td>{{ $requirement->insurance_coverage }}</td>
                </tr>
                <tr>
                    <td><strong>Certifications or Licenses:</strong></td>
                    <td>{{ $requirement->certifications_or_licenses }}</td>
                </tr>
            @endforeach
        </table>

        <!-- ATTACHMENTS -->
        <h4>ATTACHMENTS</h4>
        @foreach ($subcontractor->attachments as $attachment)
            <table class="table table-bordered">
                <tr>
                    <td><strong>Portfolio Samples:</strong></td>
                    <td><a href="{{ asset('storage/' . $attachment->portfolio_samples) }}" target="_blank">View File</a></td>
                </tr>
                <tr>
                    <td><strong>Business Licenses:</strong></td>
                    <td><a href="{{ asset('storage/' . $attachment->business_licenses) }}" target="_blank">View File</a></td>
                </tr>
                <tr>
                    <td><strong>Agreement Acknowledged:</strong></td>
                    <td>{{ $attachment->agreement_acknowledged ? 'Yes' : 'No' }}</td>
                </tr>
                <tr>
                    <td><strong>Signature:</strong></td>
                    <td><a href="{{ asset('storage/' . $attachment->signature) }}" target="_blank">View File</a></td>
                </tr>
                <tr>
                    <td><strong>Submission Date:</strong></td>
                    <td>{{ $attachment->submission_date }}</td>
                </tr>
            </table>
        @endforeach

        <!-- Buttons -->
        <div class="button-container mt-3">
            <a href="{{ route('subcontractor.index') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('subcontractor.edit', $subcontractor->id) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
@endsection
