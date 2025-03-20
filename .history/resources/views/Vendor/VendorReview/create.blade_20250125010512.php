<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Review</title>
    <!-- Include Bootstrap for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include SweetAlert CSS -->
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
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .alert {
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Review Vendor: {{ $vendor->name }}</h2>

        <!-- Display Success or Error Messages -->
        @if(session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Thank you!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#007bff',
                });
            </script>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Vendor Review Form -->
        <form id="reviewForm" action="{{ route('vendorreview.store', $vendor->id) }}" method="POST">
            @csrf

            <!-- Reviewer Name -->
            <div class="mb-3">
                <label for="reviewer_name" class="form-label">Your Name</label>
                <input type="text" name="reviewer_name" id="reviewer_name" class="form-control" 
                       value="{{ old('reviewer_name') }}" placeholder="Enter your name" required>
                @error('reviewer_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Review Text -->
            <div class="mb-3">
                <label for="review_text" class="form-label">Review</label>
                <textarea name="review_text" id="review_text" class="form-control" rows="4" 
                          placeholder="Write your review here" required>{{ old('review_text') }}</textarea>
                @error('review_text')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Rating -->
            <div class="mb-3">
                <label for="rating" class="form-label">Rating (1-5)</label>
                <select name="rating" id="rating" class="form-select" required>
                    <option value="">Select Rating</option>
                    <option value="1" {{ old('rating') == '1' ? 'selected' : '' }}>1 - Poor</option>
                    <option value="2" {{ old('rating') == '2' ? 'selected' : '' }}>2 - Fair</option>
                    <option value="3" {{ old('rating') == '3' ? 'selected' : '' }}>3 - Good</option>
                    <option value="4" {{ old('rating') == '4' ? 'selected' : '' }}>4 - Very Good</option>
                    <option value="5" {{ old('rating') == '5' ? 'selected' : '' }}>5 - Excellent</option>
                </select>
                @error('rating')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="button" class="btn btn-primary w-100" id="submitReview">Submit Review</button>
        </form>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert Confirmation Script -->
    <script>
        document.getElementById('submitReview').addEventListener('click', function () {
            Swal.fire({
                title: 'Submit',
                text: "After filling up everything, we will send an email confirmation.",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#007bff',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Submit it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('reviewForm').submit();
                }
            });
        });
    </script>
</body>
</html>
