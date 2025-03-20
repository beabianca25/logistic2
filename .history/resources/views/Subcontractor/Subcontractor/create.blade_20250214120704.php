<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Subcontractor</title>
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
        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            color: #555;
        }
        input, select, textarea, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        .btn-back {
            background-color: #6c757d;
            margin-right: 10px;
        }
        .btn-back:hover {
            background-color: #5a6268;
        }
        .button-container {
            display: flex;
            justify-content: flex-start;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create Subcontractor</h1>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please fix the errors before submitting.',
                });
            </script>
        @endif

        <!-- Subcontractor Form -->
        <form id="subcontractor-form" action="{{ route('subcontractor.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="subcontractor_name">Subcontractor Name:</label>
                <input type="text" id="subcontractor_name" name="subcontractor_name" value="{{ old('subcontractor_name') }}" required>
            </div>

            <div class="form-group">
                <label for="business_registration_number">Business Registration Number:</label>
                <input type="text" id="business_registration_number" name="business_registration_number" value="{{ old('business_registration_number') }}" required>
            </div>

            <div class="form-group">
                <label for="contact_person">Contact Person:</label>
                <input type="text" id="contact_person" name="contact_person" value="{{ old('contact_person') }}" required>
            </div>

            <div class="form-group">
                <label for="business_address">Business Address:</label>
                <textarea id="business_address" name="business_address" rows="3">{{ old('business_address') }}</textarea>
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="website">Website (Optional):</label>
                <input type="url" id="website" name="website" value="{{ old('website') }}">
            </div>

            <div class="form-group">
                <label for="services_offered">Services Offered:</label>
                <textarea id="services_offered" name="services_offered" rows="3">{{ old('services_offered') }}</textarea>
            </div>

            <div class="form-group">
                <label for="relevant_experience">Relevant Experience:</label>
                <textarea id="relevant_experience" name="relevant_experience" rows="3">{{ old('relevant_experience') }}</textarea>
            </div>

            <div class="button-container">
                <button type="button" class="btn-back" onclick="history.back()">Back</button>
                <button type="submit" id="submit-btn">Next</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('subcontractor-form').addEventListener('submit', function(event) {
            event.preventDefault();
            
            Swal.fire({
                title: 'Thank you!',
                text: 'Please wait for an email confirmation.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit();
                }
            });
        });
    </script>

</body>
</html>
