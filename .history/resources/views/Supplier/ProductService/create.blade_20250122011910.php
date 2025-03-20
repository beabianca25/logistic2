<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product/Service</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Add Product/Service for Supplier: {{ $supplier->company_name }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('ProductService.store') }}" method="POST">
            @csrf
            <input type="hidden" name="supplier_id" value="{{ $supplier->id }}">

            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" name="category" id="category" class="form-control" placeholder="Enter category" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control" placeholder="Enter description" required></textarea>
            </div>

            <div class="form-group">
                <label for="price">Price (Optional):</label>
                <input type="number" step="0.01" name="price" id="price" class="form-control" placeholder="Enter price">
            </div>

            <div class="form-group">
                <label for="lead_time">Lead Time:</label>
                <input type="text" name="lead_time" id="lead_time" class="form-control" placeholder="Enter lead time" required>
            </div>

            <div class="form-group">
                <label for="minimum_order">Minimum Order (Optional):</label>
                <input type="text" name="minimum_order" id="minimum_order" class="form-control" placeholder="Enter minimum order">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
