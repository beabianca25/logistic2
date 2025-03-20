<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Subcontractor Attachment</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1>Create Subcontractor Attachment</h1>

    <form action="{{ route('attachments.store') }}" method="POST" enctype="multipart/form-data">
       @csrf
        <input type="hidden" name="subcontractor_id" value="{{ $subcontractor->id }}">
        <div class="form-group">
            <label for="portfolio_samples">Portfolio Samples (PDF, JPG, PNG):</label>
            <input type="file" name="portfolio_samples" id="portfolio_samples" class="form-control" required>
            <div class="text-danger" id="portfolio_samples_error"></div>
        </div>

        <div class="form-group">
            <label for="business_licenses">Business Licenses (PDF, JPG, PNG):</label>
            <input type="file" name="business_licenses" id="business_licenses" class="form-control" required>
            <div class="text-danger" id="business_licenses_error"></div>
        </div>

        <div class="form-group">
            <label for="agreement_acknowledged">Agreement Acknowledged:</label>
            <input type="checkbox" name="agreement_acknowledged" id="agreement_acknowledged" value="1" required>
            <div class="text-danger" id="agreement_acknowledged_error"></div>
        </div>

        <div class="form-group">
            <label for="signature">Signature (JPG, PNG):</label>
            <input type="file" name="signature" id="signature" class="form-control" required>
            <div class="text-danger" id="signature_error"></div>
        </div>

        <div class="form-group">
            <label for="submission_date">Submission Date:</label>
            <input type="date" name="submission_date" id="submission_date" class="form-control" required>
            <div class="text-danger" id="submission_date_error"></div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Submit Attachment</button>
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Optional JS for form validation and error handling -->
<script>
    // Example for client-side validation
    document.querySelector('form').addEventListener('submit', function(event) {
        let valid = true;

        // Check if all required fields are filled
        if (!document.getElementById('portfolio_samples').files.length) {
            valid = false;
            document.getElementById('portfolio_samples_error').textContent = "Portfolio Samples are required.";
        }

        if (!document.getElementById('business_licenses').files.length) {
            valid = false;
            document.getElementById('business_licenses_error').textContent = "Business Licenses are required.";
        }

        if (!document.getElementById('agreement_acknowledged').checked) {
            valid = false;
            document.getElementById('agreement_acknowledged_error').textContent = "You must acknowledge the agreement.";
        }

        if (!document.getElementById('signature').files.length) {
            valid = false;
            document.getElementById('signature_error').textContent = "Signature is required.";
        }

        if (!document.getElementById('submission_date').value) {
            valid = false;
            document.getElementById('submission_date_error').textContent = "Submission date is required.";
        }

        // If invalid, prevent form submission
        if (!valid) {
            event.preventDefault();
        }
    });
</script>

</body>
</html>
