<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Supplier</title>
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
        input, textarea, button {
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
        .alert {
            color: red;
            background-color: #f8d7da;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
        }
        .error-message {
            color: red;
            font-size: 0.9em;
            margin-top: -10px;
            margin-bottom: 10px;
        }
        .note {
            color: #555;
            font-size: 0.9em;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Create New Supplier</h1>

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

        <!-- Supplier Form -->
        <form action="{{ route('supplier.store') }}" method="POST">
            @csrf

            <!-- Company Name -->
            <div class="form-group">
                <label for="company_name">Company Name:</label>
                <input type="text" id="company_name" name="company_name" value="{{ old('company_name') }}" required>
                @error('company_name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Business Type -->
            <div class="form-group">
                <label for="business_type">Business Type:</label>
                <input type="text" id="business_type" name="business_type" value="{{ old('business_type') }}" required>
                @error('business_type')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Contact Name -->
            <div class="form-group">
                <label for="contact_name">Contact Name:</label>
                <input type="text" id="contact_name" name="contact_name" value="{{ old('contact_name') }}" required>
                @error('contact_name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Contact Email -->
            <div class="form-group">
                <label for="contact_email">Contact Email:</label>
                <input type="email" id="contact_email" name="contact_email" value="{{ old('contact_email') }}" required>
                @error('contact_email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Contact Phone -->
            <div class="form-group">
                <label for="contact_phone">Contact Phone:</label>
                <input type="text" id="contact_phone" name="contact_phone" value="{{ old('contact_phone') }}" required>
                @error('contact_phone')
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

            <!-- Website -->
            <div class="form-group">
                <label for="website">Website (Optional):</label>
                <input type="url" id="website" name="website" value="{{ old('website') }}">
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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Supplier Reference</title>
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
        input, textarea, button {
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
        .alert {
            color: red;
            background-color: #f8d7da;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
        }
        .error-message {
            color: red;
            font-size: 0.9em;
            margin-top: -10px;
            margin-bottom: 10px;
        }
        .button-container {
            display: flex;
            justify-content: flex-start;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create Supplier Reference</h1>

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

        <!-- Supplier Reference Form -->
        <form action="{{ route('supplierreference.store') }}" method="POST" novalidate>
            @csrf

            <!-- Supplier ID -->
            <input type="hidden" name="supplier_id" value="{{ $supplier->id }}">

            <!-- Client Name -->
            <div class="form-group">
                <label for="client_name">Client Name:</label>
                <input type="text" id="client_name" name="client_name" value="{{ old('client_name') }}" required>
                @error('client_name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Client Contact -->
            <div class="form-group">
                <label for="client_contact">Client Contact:</label>
                <input type="text" id="client_contact" name="client_contact" value="{{ old('client_contact') }}" required>
                @error('client_contact')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Project Description -->
            <div class="form-group">
                <label for="project_description">Project Description:</label>
                <textarea id="project_description" name="project_description" rows="3" required>{{ old('project_description') }}</textarea>
                @error('project_description')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="button-container">
                <!-- Back Button -->
                <button type="button" class="btn-back" onclick="history.back()">Back</button>
                <!-- Submit Button -->
                <button type="submit">Save Reference</button>
            </div>
        </form>
    </div>
</body>
</html>
