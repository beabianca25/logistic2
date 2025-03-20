@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: sans-serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/subcontractors') }}">Subcontractors</a></li>
            <li class="breadcrumb-item active" aria-current="page">Subcontractor Details</li>
        </ol>
    </nav>

    <div class="container">
        <h1>Subcontractor Details</h1>
        <div class="card mb-3">
            <div class="card-body">
                <ul class="nav nav-tabs" id="subcontractorTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="business-info-tab" data-bs-toggle="tab" href="#business-info"
                            role="tab" aria-controls="business-info" aria-selected="true">Business Info</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="contact-info-tab" data-bs-toggle="tab" href="#contact-info" role="tab"
                            aria-controls="contact-info" aria-selected="false">Contact Info</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="service-details-tab" data-bs-toggle="tab" href="#service-details"
                            role="tab" aria-controls="service-details" aria-selected="false">Service Details</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="attachments-tab" data-bs-toggle="tab" href="#attachments" role="tab"
                            aria-controls="attachments" aria-selected="false">Attachments</a>
                    </li>
                </ul>

                <div class="tab-content mt-3" id="subcontractorTabContent">
                    <div class="tab-pane fade show active" id="business-info" role="tabpanel"
                        aria-labelledby="business-info-tab">
                        <h3>Business Information</h3>
                        <p><strong>Name:</strong> {{ $subcontractor->subcontractor_name }}</p>
                        <p><strong>Business Registration Number:</strong> {{ $subcontractor->business_registration_number }}
                        </p>
                        <p><strong>Business Address:</strong> {{ $subcontractor->business_address }}</p>
                        <p><strong>Website:</strong>
                            @if ($subcontractor->website)
                                <a href="{{ $subcontractor->website }}" target="_blank">{{ $subcontractor->website }}</a>
                            @else
                                N/A
                            @endif
                        </p>
                    </div>

                    <div class="tab-pane fade" id="contact-info" role="tabpanel" aria-labelledby="contact-info-tab">
                        <h3>Contact Information</h3>
                        <!-- Subcontractor Information -->
                        <div class="info">
                            <p><strong>Name:</strong> {{ $subcontractor->subcontractor_name }}</p>
                            <p><strong>Business Registration Number:</strong>
                                {{ $subcontractor->business_registration_number }}</p>
                            <p><strong>Contact Person:</strong> {{ $subcontractor->contact_person }}</p>
                            <p><strong>Business Address:</strong> {{ $subcontractor->business_address }}</p>
                            <p><strong>Phone:</strong> {{ $subcontractor->phone }}</p>
                            <p><strong>Email:</strong> {{ $subcontractor->email }}</p>
                            <p><strong>Website:</strong> <a href="{{ $subcontractor->website }}"
                                    target="_blank">{{ $subcontractor->website }}</a></p>
                            <p><strong>Services Offered:</strong> {{ $subcontractor->services_offered }}</p>
                            <p><strong>Relevant Experience:</strong> {{ $subcontractor->relevant_experience }}</p>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="service-details" role="tabpanel" aria-labelledby="service-details-tab">
                        <!-- Requirements Section -->
                        <h2>Requirements</h2>
                        @if ($subcontractor->requirements->isNotEmpty())
                            <ul class="list-group">
                                @foreach ($subcontractor->requirements as $requirement)
                                    <li class="list-group-item">
                                        {{ $requirement->requirement_name }} - {{ $requirement->status }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No requirements available.</p>
                        @endif
                    </div>

                    <div class="tab-pane fade" id="attachments" role="tabpanel" aria-labelledby="attachments-tab">
                        <!-- Attachments Section -->
                        <h2>Attachments</h2>
                        @if ($subcontractor->attachments->isNotEmpty())
                            <ul class="list-group">
                                @foreach ($subcontractor->attachments as $attachment)
                                    <li class="list-group-item">
                                        <a href="{{ asset('storage/' . $attachment->file_path) }}"
                                            target="_blank">{{ $attachment->file_name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No attachments available.</p>
                        @endif


                    </div>

                    <a href="{{ route('subcontractor.index') }}" class="btn btn-secondary mt-3">Back</a>
                    <a href="{{ route('subcontractor.edit', $subcontractor->id) }}" class="btn btn-primary mt-3">Edit</a>
                </div>
            </div>
        </div>
    @endsection
