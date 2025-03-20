<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Subcontractor Attachment</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            color: #555;
        }
        input[type="file"], input[type="date"], input[type="text"], input[type="email"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .btn-back, button[type="button"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn-back:hover, button[type="button"]:hover {
            background-color: #0056b3;
        }
        .button-container {
            display: flex;
            justify-content: flex-start;
            gap: 10px;
        }
        .error-message {
            color: red;
            font-size: 0.9em;
            margin-top: -10px;
        }
        .alert {
            color: red;
            background-color: #f8d7da;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Create Subcontractor Attachment</h1>

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Display Success Message with SweetAlert2 -->
    @if(session('success'))
        <script>
            Swal.fire({
                title: "Success!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonColor: "#007bff"
            });
        </script>
    @endif

    <form id="attachmentForm" action="{{ route('attachments.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="subcontractor_id" value="{{ $subcontractor->id }}">

        <div class="form-group">
            <label for="portfolio_samples">Portfolio Samples (PDF, JPG, PNG):</label>
            <input type="file" name="portfolio_samples" id="portfolio_samples" required>
            @error('portfolio_samples')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="business_licenses">Business Licenses (PDF, JPG, PNG):</label>
            <input type="file" name="business_licenses" id="business_licenses" required>
            @error('business_licenses')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="agreement_acknowledged">Agreement Acknowledged:</label>
            <input type="checkbox" name="agreement_acknowledged" id="agreement_acknowledged" value="1" required>
            @error('agreement_acknowledged')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="signature">Signature (JPG, PNG):</label>
            <input type="file" name="signature" id="signature" required>
            @error('signature')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="submission_date">Submission Date:</label>
            <input type="date" name="submission_date" id="submission_date" required>
            @error('submission_date')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="button-container">
            <button type="button" class="btn-back" onclick="history.back()">Back</button>
            <button type="button" id="submitButton">Submit Attachment</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('submitButton').addEventListener('click', function () {
        Swal.fire({
            title: 'Thank you!',
                text: "We have received your application. We will email you for confirmation.",
                icon: 'success',
                confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('attachmentForm').submit();
            }
        });
    });
</script>

</body>
</html>
