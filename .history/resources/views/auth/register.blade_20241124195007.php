<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #fff;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
        }

        .card {
            background-color: #fff;
            color: #333;
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-custom {
            background-color: #6a11cb;
            border: none;
            color: #fff;
            font-weight: bold;
        }

        .btn-custom:hover {
            background-color: #2575fc;
            color: #fff;
        }

        .form-control {
            border-radius: 0.5rem;
        }

        .form-control:focus {
            border-color: #6a11cb;
            box-shadow: 0 0 5px rgba(106, 17, 203, 0.5);
        }

        .logo {
            height: 80px;
            width: 80px;
        }

        .card-header {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: white;
            border-bottom: 0;
            text-align: center;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <!-- Header -->
                    <div class="card-header">
                        <img src="https://th.bing.com/th/id/OIP.B7lY1GPxjghWzpDx389HggHaHa?rs=1&pid=ImgDetMain" alt="Logo" class="logo rounded-circle">
                        <h3 class="mt-3">Create an Account</h3>
                    </div>
                    <!-- Form -->
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" value="{{ old('name') }}" required>
                                <div class="text-danger mt-1">@error('name') {{ $message }} @enderror</div>
                            </div>
                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required>
                                <div class="text-danger mt-1">@error('email') {{ $message }} @enderror</div>
                            </div>
                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Create a password" required>
                                <div class="text-danger mt-1">@error('password') {{ $message }} @enderror</div>
                            </div>
                            <!-- Confirm Password -->
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
                                <div class="text-danger mt-1">@error('password_confirmation') {{ $message }} @enderror</div>
                            </div>
                            <!-- Register Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-custom btn-lg">Register</button>
                            </div>
                        </form>
                        <!-- Already Registered -->
                        <div class="text-center mt-3">
                            <a href="{{ route('login') }}" class="text-decoration-none text-secondary">Already registered? Log in</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
