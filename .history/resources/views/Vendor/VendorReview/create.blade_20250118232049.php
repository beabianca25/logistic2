<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Review</title>
    <!-- Include any necessary stylesheets (Bootstrap, custom styles, etc.) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Review Vendor: {{ $vendor->name }}</h2>

        <!-- Display any success or error messages -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('vendorreview.store', $vendor->id) }}" method="POST">
            @csrf

            <!-- Reviewer Name -->
            <div class="mb-3">
                <label for="reviewer_name" class="form-label">Your Name</label>
                <input type="text" name="reviewer_name" id="reviewer_name" class="form-control" required>
            </div>

            <!-- Review Text -->
            <div class="mb-3">
                <label for="review_text" class="form-label">Review</label>
                <textarea name="review_text" id="review_text" class="form-control" rows="4" required></textarea>
            </div>

            <!-- Rating -->
            <div class="mb-3">
                <label for="rating" class="form-label">Rating (1-5)</label>
                <select name="rating" id="rating" class="form-select" required>
                    <option value="">Select Rating</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>
    </div>

    <!-- Include any necessary JavaScript (Bootstrap JS, custom scripts, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
