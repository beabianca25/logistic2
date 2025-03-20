<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Contact Details</title>
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
        h2 {
            margin-top: 40px;
            margin-bottom: 20px;
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            color: #555;
        }
        p {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background: #f9f9f9;
        }
        .button-container {
            display: flex;
            justify-content: flex-start;
            margin-top: 20px;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .btn-back {
            background-color: #6c757d;
            color: white;
            margin-right: 10px;
        }
        .btn-back:hover {
            background-color: #5a6268;
        }
        .btn-edit {
            background-color: #007bff;
            color: white;
        }
        .btn-edit:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Vendor Contact Details</h1>

        <h2>Contact Information</h2>
        <label>First Name:</label>
        <p>{{ $vendorContact->first_name }}</p>

        <label>Last Name:</label>
        <p>{{ $vendorContact->last_name }}</p>

        <label>Job Title:</label>
        <p>{{ $vendorContact->job_title }}</p>

        <label>Phone:</label>
        <p>{{ $vendorContact->phone }}</p>

        <label>Email:</label>
        <p>{{ $vendorContact->email }}</p>

        <div class="button-container">
            <button class="btn-back" onclick="history.back()">Back</button>
            <a href="{{ route('vendorcontact.edit', $vendorContact->id) }}">
                <button class="btn-edit">Edit</button>
            </a>
        </div>
    </div>
</body>
</html>
