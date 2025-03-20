<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JVD Travel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: url('photo1.png') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }


        .navbar {
            background: transparent;
            border-bottom: none;
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            color: #d36b6b;
            margin: 0 10px;
        }

        .navbar-nav .nav-link:hover {
            color: #2575fc;
        }

        .main-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 90%;
            max-width: 1200px;
            margin-top: 40px;
            flex-wrap: wrap;
        }

        .left-section {
            max-width: 50%;
        }

        .left-section img {
            max-width: 100%;
            height: auto;
        }

        .login-card {
            background-color: white;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            border-radius: 20px;
            padding: 30px;
            width: 350px;
            text-align: center;
        }

        .login-card h3 {
            font-weight: bold;
            color: #6a11cb;
            text-align: center;
            margin-bottom: 20px;
        }

        .login-card .form-control {
            border-radius: 10px;
        }

        .login-card .btn {
            width: 100%;
            margin-top: 15px;
            background: #6a11cb;
            color: white;
            border-radius: 10px;
            transition: background-color 0.3s ease-in-out;
        }

        .login-card .btn:hover {
            background: #2575fc;
        }

        .login-card .forgot-link {
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

        .terms {
            margin-top: 20px;
            font-size: 14px;
            text-align: center;
            color: #555;
        }

        .terms a {
            color: #2575fc;
            text-decoration: none;
            font-weight: bold;
        }

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
            <a class="navbar-brand" href="#">JVD Travel Management</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="#" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Services</a></li>
                    <li class="nav-item"><a href="/apply" class="nav-link">Career</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">About Us</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-container">
        <div class="left-section">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTawJkegFbeVV3UlMveKCht-XZKpSMCp_HKHQ"
                alt="jvd logo">
        </div>

        <div class="login-card">
            <h3>Welcome!</h3>


            <!-- Display any validation errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="/login">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Username</label>
                    <input type="text" class="form-control" id="email" name="email"
                        placeholder="Enter your username" aria-label="Username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Enter your password" aria-label="Password">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="termsCheckbox" required>
                    <label class="form-check-label" for="termsCheckbox">
                        I agree to the <a href="/condition">Terms and Conditions</a>
                    </label>
                </div>
                <button type="submit" class="btn">Login</button>
                <div class="forgot-link">
                    <a href="/forgot-password">Forgot Password?</a>
                </div>
                <div class="create-account">
                    <a href="/register">Create Account</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
