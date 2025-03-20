<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Certification Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
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
            justify-content: space-between;
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
        <h1>Certification Details</h1>

        <label>Certification Name:</label>
        <p>{{ $certification->certification_name }}</p>

        <label>Certification Type:</label>
        <p>{{ $certification->certification_type }}</p>

        <label>Valid Until:</label>
        <p>{{ $certification->valid_until ? $certification->valid_until->format('F d, Y') : 'N/A' }}</p>

        <label>Certification File:</label>
        <p>
            @if($certification->file_path)
                <a href="{{ asset('storage/' . $certification->file_path) }}" target="_blank">View Certification</a>
            @else
                No file uploaded
            @endif
        </p>

        <div class="button-container">
            <button class="btn-back" onclick="history.back()">Back</button>
            <a href="{{ route('vendorcertification.edit', $certification->id) }}">
                <button class="btn-edit">Edit</button>
            </a>
        </div>
    </div>
</body>
</html>
