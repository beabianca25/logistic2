<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2>Vendor Details: {{ $vendor->name }}</h2>
            </div>
            <div class="card-body">
                <p><strong>Email:</strong> {{ $vendor->email }}</p>
                <p><strong>Phone:</strong> {{ $vendor->phone }}</p>
                <p><strong>Address:</strong> {{ $vendor->address }}</p>
            </div>
        </div>

        <!-- Vendor Contact Details -->
        <div class="card mt-3">
            <div class="card-header bg-secondary text-white">Vendor Contact</div>
            <div class="card-body">
                @foreach($contacts as $contact)
                    <p><strong>Contact Person:</strong> {{ $contact->contact_person }}</p>
                    <p><strong>Email:</strong> {{ $contact->email }}</p>
                    <p><strong>Phone:</strong> {{ $contact->phone }}</p>
                    <hr>
                @endforeach
            </div>
        </div>

        <!-- Vendor Services -->
        <div class="card mt-3">
            <div class="card-header bg-info text-white">Vendor Services</div>
            <div class="card-body">
                @foreach($services as $service)
                    <p><strong>Category:</strong> {{ $service->service_category }}</p>
                    <p><strong>Description:</strong> {{ $service->service_description }}</p>
                    <p><strong>Areas of Operation:</strong> {{ $service->areas_of_operation }}</p>
                    <p><strong>Price Range:</strong> {{ $service->price_range }}</p>
                    <hr>
                @endforeach
            </div>
        </div>

        <!-- Vendor Consent -->
        <div class="card mt-3">
            <div class="card-header bg-warning text-white">Vendor Consent</div>
            <div class="card-body">
                @if($consent)
                    <p><strong>Consent Given:</strong> {{ $consent->consent_given ? 'Yes' : 'No' }}</p>
                    <p><strong>Date:</strong> {{ $consent->date_given }}</p>
                @else
                    <p>No consent information available.</p>
                @endif
            </div>
        </div>

        <!-- Vendor Certifications -->
        <div class="card mt-3">
            <div class="card-header bg-success text-white">Vendor Certifications</div>
            <div class="card-body">
                @foreach($Certifications as $certification)
                    <p><strong>Certification:</strong> {{ $certification->certification_name }}</p>
                    <p><strong>Issued Date:</strong> {{ $certification->issued_date }}</p>
                    <p><strong>Expiration Date:</strong> {{ $certification->expiration_date }}</p>
                    <hr>
                @endforeach
            </div>
        </div>

        <!-- Vendor Invoices -->
        <div class="card mt-3">
            <div class="card-header bg-dark text-white">Vendor Invoicing</div>
            <div class="card-body text-white">
                @foreach($Invoices as $invoice)
                    <p><strong>Invoice Number:</strong> {{ $invoice->invoice_number }}</p>
                    <p><strong>Amount:</strong> {{ $invoice->amount }}</p>
                    <p><strong>Status:</strong> {{ $invoice->status }}</p>
                    <hr>
                @endforeach
            </div>
        </div>

        <!-- Vendor Reviews -->
        <div class="card mt-3">
            <div class="card-header bg-danger text-white">Vendor Reviews</div>
            <div class="card-body">
                @foreach($Reviews as $review)
                    <p><strong>Reviewer:</strong> {{ $review->reviewer_name }}</p>
                    <p><strong>Rating:</strong> {{ $review->rating }} / 5</p>
                    <p><strong>Review:</strong> {{ $review->review_text }}</p>
                    <hr>
                @endforeach
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-3">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</body>
</html>
