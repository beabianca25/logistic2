<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Consent Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        input, select, textarea, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background: #f9f9f9;
        }
        textarea {
            resize: vertical;
        }
        button {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
            border-radius: 4px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .alert {
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
        }
        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
        }
        .error-message {
            color: red;
            font-size: 0.9em;
            margin-top: -10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Vendor Consent Form</h1>

        <!-- Display Error Messages -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Display Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('vendorconsent.store', ['vendorId' => $vendor->id]) }}" method="POST" novalidate>
            @csrf

            <div class="form-group">
                <label for="authorized_person_name">Authorized Person Name:</label>
                <input type="text" name="authorized_person_name" id="authorized_person_name" 
                       value="{{ old('authorized_person_name') }}" required>
                @error('authorized_person_name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="contract_email">Contact Email:</label>
                <input type="email" name="contract_email" id="contract_email" 
                       value="{{ old('contract_email') }}" required>
                @error('contract_email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="agreement_to_terms">Agreement to Terms:</label>
                <select name="agreement_to_terms" id="agreement_to_terms" required>
                    <option value="">-- Select an Option --</option>
                    <option value="Yes" {{ old('agreement_to_terms') == 'Yes' ? 'selected' : '' }}>Yes</option>
                    <option value="No" {{ old('agreement_to_terms') == 'No' ? 'selected' : '' }}>No</option>
                </select>
                @error('agreement_to_terms')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="agreement_to_credit_check">Agreement to Credit Check:</label>
                <select name="agreement_to_credit_check" id="agreement_to_credit_check" required>
                    <option value="">-- Select an Option --</option>
                    <option value="Yes" {{ old('agreement_to_credit_check') == 'Yes' ? 'selected' : '' }}>Yes</option>
                    <option value="No" {{ old('agreement_to_credit_check') == 'No' ? 'selected' : '' }}>No</option>
                </select>
                @error('agreement_to_credit_check')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="signature">Signature:</label>
                <textarea name="signature" id="signature" rows="3" required>{{ old('signature') }}</textarea>
                @error('signature')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit">Submit Consent</button>
        </form>
    </div>
</body>
</html>
