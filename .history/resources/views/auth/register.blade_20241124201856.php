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
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #005ae2, #ef3648); /* Neon Blue and Red gradient */
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Navbar styles */
        .navbar {
            background: transparent;
            border-bottom: none;
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            color: #ffffff;
            margin: 0 10px;
        }

        .navbar-nav .nav-link:hover {
            color: #2575fc;
        }

        /* Main content styles */
        .main-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 90%;
            max-width: 1200px;
            margin-top: 40px;
        }

        /* Left section with illustration */
        .left-section {
            max-width: 50%;
        }

        .left-section img {
            max-width: 100%;
            height: auto;
        }

        /* Register form card */
        .register-card {
            background-color: white;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            border-radius: 20px;
            padding: 20px 30px;
            width: 300px;
        }

        .register-card h3 {
            font-weight: bold;
            color: #6a11cb;
            text-align: center;
            margin-bottom: 20px;
        }

        .register-card .form-control {
            border-radius: 10px;
        }

        .register-card .btn {
            width: 100%;
            margin-top: 15px;
            background: #6a11cb;
            color: white;
            border-radius: 10px;
        }

        .register-card .btn:hover {
            background: #2575fc;
        }

        .register-card .forgot-link {
            text-align: center;
            margin-top: 10px;
            color: #2575fc;
            font-size: 14px;
        }

        .create-account {
            margin-top: 15px;
            text-align: center;
        }

        .create-account a {
            text-decoration: none;
            color: #2575fc;
            font-weight: bold;
        }

        /* Media Query for responsiveness */
        @media (max-width: 768px) {
            .main-container {
                flex-direction: column;
                align-items: center;
            }

            .left-section {
                max-width: 100%;
                text-align: center;
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">Brand</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="#" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Services</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">About Us</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-container">
        <!-- Left Section with Illustration -->
        <div class="left-section">
            <img src="https://th.bing.com/th/id/OIP.B7lY1GPxjghWzpDx389HggHaHa?rs=1&pid=ImgDetMain" alt="Illustration">
        </div>

        <!-- Register Form -->
        <div class="register-card">
            <h3>Create an Account</h3>
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
                <button type="submit" class="btn">Register</button>
            </form>

            <!-- Already Registered -->
            <div class="create-account">
                <a href="{{ route('login') }}">Already registered? Log in</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
