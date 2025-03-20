<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Financial Health Information</title>
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
        <h1>Create Financial Health Information for Supplier: {{ $supplier->contact_name }}</h1>

        <!-- Display any validation errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form for financial health information -->
        <form action="{{ route('financialhealth.store') }}" method="POST" novalidate>
            @csrf

            <!-- Bank Account Number -->
            <div class="form-group">
                <label for="bank_account_number">Bank Account Number:</label>
                <input type="text" id="bank_account_number" name="bank_account_number" value="{{ old('bank_account_number') }}" required>
                @error('bank_account_number')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tax Compliance -->
            <div class="form-group">
                <label for="tax_compliance">Tax Compliance:</label>
                <input type="text" id="tax_compliance" name="tax_compliance" value="{{ old('tax_compliance') }}">
                @error('tax_compliance')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Insurance Coverage -->
            <div class="form-group">
                <label for="insurance_coverage">Insurance Coverage:</label>
                <input type="text" id="insurance_coverage" name="insurance_coverage" value="{{ old('insurance_coverage') }}">
                @error('insurance_coverage')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Hidden supplier_id -->
            <input type="hidden" name="supplier_id" value="{{ $supplier->id }}">

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
