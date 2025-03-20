<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Subcontractor</title>
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
        h2 {
            margin-top: 40px;
            margin-bottom: 20px;
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
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
        .row {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }
        .col {
            flex: 1;
        }
        .error-message {
            color: red;
            font-size: 0.9em;
            margin-top: -10px;
            margin-bottom: 10px;
        }
        .alert {
            color: red;
            background-color: #f8d7da;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
        }
        .note {
            color: #555;
            font-size: 0.9em;
            text-align: center;
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
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Subcontractor Form -->
        <form action="{{ route('subcontractor.store') }}" method="POST" novalidate>
            @csrf

            <!-- Subcontractor Name -->
            <div class="form-group">
                <label for="subcontractor_name">Subcontractor Name:</label>
                <input type="text" id="subcontractor_name" name="subcontractor_name" value="{{ old('subcontractor_name') }}" required>
                @error('subcontractor_name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Business Registration Number -->
            <div class="form-group">
                <label for="business_registration_number">Business Registration Number:</label>
                <input type="text" id="business_registration_number" name="business_registration_number" value="{{ old('business_registration_number') }}" required>
                @error('business_registration_number')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Contact Person -->
            <div class="form-group">
                <label for="contact_person">Contact Person:</label>
                <input type="text" id="contact_person" name="contact_person" value="{{ old('contact_person') }}" required>
                @error('contact_person')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Business Address -->
            <div class="form-group">
                <label for="business_address">Business Address:</label>
                <textarea id="business_address" name="business_address" rows="3">{{ old('business_address') }}</textarea>
                @error('business_address')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Phone -->
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required>
                @error('phone')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Website -->
            <div class="form-group">
                <label for="website">Website (Optional):</label>
                <input type="url" id="website" name="website" value="{{ old('website') }}">
            </div>

            <!-- Services Offered -->
            <div class="form-group">
                <label for="services_offered">Services Offered:</label>
                <textarea id="services_offered" name="services_offered" rows="3">{{ old('services_offered') }}</textarea>
                @error('services_offered')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Relevant Experience -->
            <div class="form-group">
                <label for="relevant_experience">Relevant Experience:</label>
                <textarea id="relevant_experience" name="relevant_experience" rows="3">{{ old('relevant_experience') }}</textarea>
                @error('relevant_experience')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="button-container">
                <!-- Back Button -->
                <button type="button" class="btn-back" onclick="history.back()">Back</button>
                <!-- Submit Button -->
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
