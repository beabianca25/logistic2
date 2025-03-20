<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Certification</title>
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
        input, select, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background: #f9f9f9;
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
        .error-message {
            color: red;
            font-size: 0.9em;
            margin-top: -10px;
            margin-bottom: 10px;
        }
        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create Certification for Vendor</h1>

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

        <!-- Certification Form -->
        <form action="{{ route('vendorcertification.store', ['vendorId' => $vendor->id]) }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf

            <div class="form-group">
                <label for="certification_name">Certification Name:</label>
                <input type="text" id="certification_name" name="certification_name" 
                       value="{{ old('certification_name') }}" required>
                @error('certification_name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="certification_type">Certification Type:</label>
                <select id="certification_type" name="certification_type" required>
                    <option value="">-- Select Certification Type --</option>
                    <option value="Business License" {{ old('certification_type') == 'Business License' ? 'selected' : '' }}>Business License</option>
                    <option value="Safety Certification" {{ old('certification_type') == 'Safety Certification' ? 'selected' : '' }}>Safety Certification</option>
                    <option value="Insurance Document" {{ old('certification_type') == 'Insurance Document' ? 'selected' : '' }}>Insurance Document</option>
                    <option value="Other" {{ old('certification_type') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('certification_type')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="file_path">Upload Certification File:</label>
                <input type="file" id="file_path" name="file_path" accept="application/pdf,image/*" required>
                @error('file_path')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="valid_until">Valid Until:</label>
                <input type="date" id="valid_until" name="valid_until" value="{{ old('valid_until') }}">
                @error('valid_until')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit">Add Certification</button>
        </form>
    </div>
</body>
</html>
