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
            <p><strong>Website:</strong> <a href="{{ $subcontractor->website }}" target="_blank">{{ $subcontractor->website }}</a></p>
            <p><strong>Services Offered:</strong> {{ $subcontractor->services_offered }}</p>
            <p><strong>Relevant Experience:</strong> {{ $subcontractor->relevant_experience }}</p>
        </div>

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

        <!-- Attachments Section -->
        <h2>Attachments</h2>
        @if ($subcontractor->attachments->isNotEmpty())
            <ul class="list-group">
                @foreach ($subcontractor->attachments as $attachment)
                    <li class="list-group-item">
                        <a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank">{{ $attachment->file_name }}</a>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No attachments available.</p>
        @endif

        <!-- Back and Edit Buttons -->
        <div class="button-container mt-3">
            <a href="{{ route('subcontractor.index') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('subcontractor.edit', $subcontractor->id) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
@endsection
