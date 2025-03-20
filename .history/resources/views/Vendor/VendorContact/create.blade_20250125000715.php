<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Vendor Details</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Create Vendor Details</h1>

        <!-- Create Contact Section -->
        <h2>Create Contact for Vendor</h2>
        <form action="{{ route('vendorcontact.store', ['vendor' => $vendor->id]) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col">
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                    @error('first_name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col">
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                    @error('last_name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="job_title">Job Title:</label>
                    <input type="text" id="job_title" name="job_title" value="{{ old('job_title') }}">
                    @error('job_title')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col">
                    <label for="phone">Phone:</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required>
                    @error('phone')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="button-container">
                <!-- Back Button -->
                <button type="button" class="btn-back" onclick="history.back()">Back</button>
                <!-- Next Button -->
                <button type="submit" class="btn-next">Next</button>
            </div>
        </form>
    </div>
</body>
</html>
