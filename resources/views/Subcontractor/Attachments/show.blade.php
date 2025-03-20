<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subcontractor Attachment Details</title>
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
        .details {
            margin-bottom: 15px;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        label {
            font-weight: bold;
            display: block;
            color: #555;
        }
        .btn-back {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-back:hover {
            background-color: #0056b3;
        }
        .button-container {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Subcontractor Attachment Details</h1>
    
    <div class="details">
        <label>Portfolio Samples:</label>
        <a href="{{ asset('storage/' . $attachment->portfolio_samples) }}" target="_blank">View File</a>
    </div>

    <div class="details">
        <label>Business Licenses:</label>
        <a href="{{ asset('storage/' . $attachment->business_licenses) }}" target="_blank">View File</a>
    </div>

    <div class="details">
        <label>Agreement Acknowledged:</label>
        <span>{{ $attachment->agreement_acknowledged ? 'Yes' : 'No' }}</span>
    </div>

    <div class="details">
        <label>Signature:</label>
        <a href="{{ asset('storage/' . $attachment->signature) }}" target="_blank">View File</a>
    </div>

    <div class="details">
        <label>Submission Date:</label>
        <span>{{ $attachment->submission_date }}</span>
    </div>

    <div class="button-container">
        <a href="{{ route('attachments.index') }}" class="btn-back">Back</a>
    </div>
</div>
</body>
</html>
