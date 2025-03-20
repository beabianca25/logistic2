<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Legal Compliance</title>
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
        .button-container {
            display: flex;
            justify-content: flex-start;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add Legal Compliance for Supplier: {{ $supplier->company_name }}</h1>

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

        <!-- Legal Compliance Form -->
        <form action="{{ route('legalcompliance.store') }}" method="POST">
            @csrf
            <input type="hidden" name="supplier_id" value="{{ $supplier->id }}">

            <!-- Registration Number -->
            <div class="form-group">
                <label for="registration_number">Registration Number</label>
                <input type="text" id="registration_number" name="registration_number" value="{{ old('registration_number') }}" required>
                @error('registration_number')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tax Identification Number -->
            <div class="form-group">
                <label for="tax_identification_number">Tax Identification Number</label>
                <input type="text" id="tax_identification_number" name="tax_identification_number" value="{{ old('tax_identification_number') }}" required>
                @error('tax_identification_number')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Licenses and Certifications -->
            <div class="form-group">
                <label for="licenses_certifications">Licenses and Certifications</label>
                <textarea id="licenses_certifications" name="licenses_certifications" rows="4" required>{{ old('licenses_certifications') }}</textarea>
                @error('licenses_certifications')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Years of Operation -->
            <div class="form-group">
                <label for="years_of_operation">Years of Operation</label>
                <input type="number" id="years_of_operation" name="years_of_operation" value="{{ old('years_of_operation') }}" min="1" required>
                @error('years_of_operation')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Button Container -->
            <div class="button-container">
                <!-- Back Button -->
                <button type="button" class="btn-back" onclick="history.back()">Back</button>
                <!-- Submit Button -->
                <button type="submit">Next</button>
            </div>
        </form>
    </div>
</body>
</html>
