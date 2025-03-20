<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Review Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 50px;
            max-width: 700px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .btn-back {
            background-color: #6c757d;
            border: none;
        }
        .btn-back:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Vendor Review Details</h2>
        <h4>Vendor: {{ $vendor->name }}</h4>

        <label class="fw-bold">Reviewer Name:</label>
        <p>{{ $review->reviewer_name }}</p>

        <label class="fw-bold">Review:</label>
        <p>{{ $review->review_text }}</p>

        <label class="fw-bold">Rating:</label>
        <p>{{ $review->rating }} / 5</p>

        <label class="fw-bold">Submitted On:</label>
        <p>{{ $review->created_at->format('F d, Y') }}</p>

        <a href="{{ route('vendorreview.index') }}" class="btn btn-back">Back</a>
    </div>
</body>
</html>
