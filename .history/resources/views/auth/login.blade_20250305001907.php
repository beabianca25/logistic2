<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JVD Travel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: url('https://khaleejmag.com/wp-content/uploads/2022/05/Traveling-the-World.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: -250px;
            background: #6a11cb;
            padding-top: 20px;
            transition: 0.4s;
            color: white;
            overflow-y: auto;
        }

        .sidebar a {
            padding: 15px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: #2575fc;
        }

        .sidebar .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 25px;
            cursor: pointer;
        }

        /* Hamburger Icon */
        .open-btn {
            font-size: 30px;
            cursor: pointer;
            background: none;
            border: none;
            color: white;
            position: absolute;
            top: 15px;
            left: 15px;
        }

        .main-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 90%;
            max-width: 1200px;
            margin-top: 40px;
            flex-wrap: wrap;
        }

        .left-section {
            max-width: 50%;
        }

        .left-section h1 {
            color: white;
            font-size: 4rem;
            text-align: center;
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

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <span class="close-btn" onclick="toggleSidebar()">×</span>
        <a href="#">Home</a>
        <a href="#">Bookings</a>
        <a href="#">Fleet Management</a>
        <a href="#">Vendor Portal</a>
        <a href="/apply">Join Us</a>
        <a href="#">About Us</a>
        <a href="#">Contact Us</a>
    </div>

    <!-- Hamburger Button -->
    <button class="open-btn" onclick="toggleSidebar()">☰</button>

    <!-- Main Content -->
    <div class="main-container">
        <div class="left-section">
            <h1>Let's Book a Trip!</h1>
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
                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter your username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="termsCheckbox" required>
                    <label class="form-check-label" for="termsCheckbox">
                        I agree to the <a href="/condition">Terms and Conditions</a>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
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
    
    <!-- Sidebar Toggle Script -->
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById("sidebar");
            if (sidebar.style.left === "0px") {
                sidebar.style.left = "-250px";
            } else {
                sidebar.style.left = "0px";
            }
        }
    </script>

</body>

</html>
