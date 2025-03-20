<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Service</title>
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
        select, textarea, input, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        select, textarea, input {
            background: #f9f9f9;
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
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create Service for Vendor</h1>

        <!-- Display Errors -->
        @if ($errors->any())
            <div class="alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form for Creating Vendor Service -->
        <form action="{{ route('vendorservice.store', ['vendorId' => $vendor->id]) }}" method="POST">
            @csrf
            <div>
                <label for="service_category">Service Category:</label>
                <select name="service_category" id="service_category" required>
                    <option value="">-- Select Category --</option>
                    <option value="Accommodation" {{ old('service_category') == 'Accommodation' ? 'selected' : '' }}>Accommodation</option>
                    <option value="Transportation" {{ old('service_category') == 'Transportation' ? 'selected' : '' }}>Transportation</option>
                    <option value="Tours & Packages" {{ old('service_category') == 'Tours & Packages' ? 'selected' : '' }}>Tours & Packages</option>
                    <option value="Event Planning" {{ old('service_category') == 'Event Planning' ? 'selected' : '' }}>Event Planning</option>
                    <option value="Catering" {{ old('service_category') == 'Catering' ? 'selected' : '' }}>Catering</option>
                    <option value="Other" {{ old('service_category') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('service_category')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="service_description">Service Description:</label>
                <textarea name="service_description" id="service_description" rows="4" required>{{ old('service_description') }}</textarea>
                @error('service_description')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="areas_of_operation">Areas of Operation:</label>
                <textarea name="areas_of_operation" id="areas_of_operation" rows="3" required>{{ old('areas_of_operation') }}</textarea>
                @error('areas_of_operation')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="price_range">Price Range (Optional):</label>
                <input type="text" name="price_range" id="price_range" value="{{ old('price_range') }}">
                @error('price_range')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit">Create Vendor Service</button>
        </form>
    </div>
</body>
</html>
