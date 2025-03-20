<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Subcontractor Requirement</title>
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
        <h1>Create Subcontractor Requirement</h1>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form to create a subcontractor requirement -->
        <form action="{{ route('requirements.store') }}" method="POST">
            @csrf
            <input type="hidden" name="subcontractor_id" value="{{ $subcontractor->id }}">

            <!-- Estimated Cost -->
            <div class="form-group">
                <label for="estimated_cost">Estimated Cost</label>
                <input type="number" name="estimated_cost" value="{{ old('estimated_cost') }}" required>
                @error('estimated_cost')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Preferred Payment Terms -->
            <div class="form-group">
                <label for="preferred_payment_terms">Preferred Payment Terms</label>
                <input type="text" name="preferred_payment_terms" value="{{ old('preferred_payment_terms') }}">
                @error('preferred_payment_terms')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Start Date Availability -->
            <div class="form-group">
                <label for="start_date_availability">Start Date Availability</label>
                <input type="date" name="start_date_availability" value="{{ old('start_date_availability') }}" required>
                @error('start_date_availability')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Estimated Completion Time -->
            <div class="form-group">
                <label for="estimated_completion_time">Estimated Completion Time</label>
                <input type="text" name="estimated_completion_time" value="{{ old('estimated_completion_time') }}" required>
                @error('estimated_completion_time')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Resources Required -->
            <div class="form-group">
                <label for="resources_required">Resources Required</label>
                <textarea name="resources_required">{{ old('resources_required') }}</textarea>
                @error('resources_required')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Insurance Coverage -->
            <div class="form-group">
                <label for="insurance_coverage">Insurance Coverage</label>
                <input type="text" name="insurance_coverage" value="{{ old('insurance_coverage') }}" required>
                @error('insurance_coverage')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Certifications or Licenses -->
            <div class="form-group">
                <label for="certifications_or_licenses">Certifications or Licenses</label>
                <textarea name="certifications_or_licenses">{{ old('certifications_or_licenses') }}</textarea>
                @error('certifications_or_licenses')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="button-container">
                <button type="button" class="btn-back" onclick="history.back()">Back</button>
                <button type="button" id="submitButton">Submit Attachment</button>
            </div>
        </form>
    </div>
</body>
</html>
