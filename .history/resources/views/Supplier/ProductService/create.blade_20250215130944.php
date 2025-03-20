<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product/Service</title>
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
        <h1>Add Product/Service for Supplier: {{ $supplier->company_name }}</h1>

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

        <!-- Product/Service Form -->
        <form action="{{ route('productservice.store') }}" method="POST">
            @csrf
            <input type="hidden" name="supplier_id" value="{{ $supplier->id }}">

            <!-- Category -->
            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" name="category" id="category" class="form-control" placeholder="Enter category" required>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control" placeholder="Enter description" required></textarea>
            </div>

            <!-- Price (Optional) -->
            <div class="form-group">
                <label for="price">Price (Optional):</label>
                <input type="number" step="0.01" name="price" id="price" class="form-control" placeholder="Enter price">
            </div>

            <!-- Lead Time -->
            <div class="form-group">
                <label for="lead_time">Lead Time:</label>
                <input type="text" name="lead_time" id="lead_time" class="form-control" placeholder="Enter lead time" required>
            </div>

            <!-- Minimum Order (Optional) -->
            <div class="form-group">
                <label for="minimum_order">Minimum Order (Optional):</label>
                <input type="text" name="minimum_order" id="minimum_order" class="form-control" placeholder="Enter minimum order">
            </div>

            <!-- Submit and Back Buttons -->
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
