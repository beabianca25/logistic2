<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Vendor Invoicing</title>
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
        <h1>Create Vendor Invoicing</h1>
        <h3>Vendor: {{ $vendor->business_name }}</h3>

        <!-- Error Message Section -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Vendor Invoicing Form -->
        <form action="{{ route('vendorinvoicing.store', $vendor->id) }}" method="POST" novalidate>
            @csrf

            <!-- Hidden Field for Vendor ID -->
            <input type="hidden" name="vendor_id" value="{{ $vendor->id }}">

            <!-- Accounts Payable Name -->
            <div class="form-group">
                <label for="accounts_payable_name">Accounts Payable Name:</label>
                <input type="text" id="accounts_payable_name" name="accounts_payable_name" 
                       value="{{ old('accounts_payable_name') }}" required>
                @error('accounts_payable_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Accounts Payable Email -->
            <div class="form-group">
                <label for="accounts_payable_email">Accounts Payable Email:</label>
                <input type="email" id="accounts_payable_email" name="accounts_payable_email" 
                       value="{{ old('accounts_payable_email') }}" required>
                @error('accounts_payable_email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Postal Address -->
            <div class="form-group">
                <label for="postal_address">Postal Address:</label>
                <textarea id="postal_address" name="postal_address" 
                          rows="4">{{ old('postal_address') }}</textarea>
                @error('postal_address')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Requires Purchase Order -->
            <div class="form-group">
                <label for="requires_po">Requires Purchase Order (PO):</label>
                <select id="requires_po" name="requires_po" required>
                    <option value="">-- Select an Option --</option>
                    <option value="Yes" {{ old('requires_po') == 'Yes' ? 'selected' : '' }}>Yes</option>
                    <option value="No" {{ old('requires_po') == 'No' ? 'selected' : '' }}>No</option>
                </select>
                @error('requires_po')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Additional Instructions -->
            <div class="form-group">
                <label for="additional_instructions">Additional Instructions:</label>
                <textarea id="additional_instructions" name="additional_instructions" 
                          rows="4">{{ old('additional_instructions') }}</textarea>
                @error('additional_instructions')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Buttons -->
            <button type="submit">Submit</button>
            <a href="{{ url()->previous() }}" class="btn-secondary" style="text-align: center; display: inline-block; padding: 10px; text-decoration: none; color: white; border-radius: 4px;">Back</a>
        </form>
    </div>
</body>
</html>
