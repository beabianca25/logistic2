<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8c102, #6a11cb, #2575fc);
            min-height: 100vh;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .career-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            max-width: 500px;
            width: 100%;
        }

        .card {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card h5 {
            margin: 0;
            font-weight: bold;
            color: #000;
        }

        .btn-apply {
            background-color: #e84d4d;
            color: #000;
            font-weight: bold;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            transition: all 0.3s ease-in-out;
        }

        .btn-apply:hover {
            background-color: #2575fc;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="career-container">
        <!-- Vendor Card -->
        <div class="card">
            <h5>Vendor</h5>
            <button class="btn btn-apply" onclick="window.location.href='/vendor/create'">Apply</button>
        </div>

        <!-- Subcontractor Card -->
        <div class="card">
            <h5>Subcontractor</h5>
            <button class="btn btn-apply" onclick="window.location.href='/supplier/create'">Apply</button>
        </div>

        <!-- Supplier Card -->
        <div class="card">
            <h5>Supplier</h5>
            <button class="btn btn-apply" onclick="window.location.href='/apply-supplier'">Apply</button>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
