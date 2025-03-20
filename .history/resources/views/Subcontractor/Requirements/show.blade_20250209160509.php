<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subcontractor Requirement Details</title>
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
            color: #333;
        }
        p {
            font-size: 16px;
            color: #555;
            margin-bottom: 10px;
        }
        .info {
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .button-container {
            display: flex;
            justify-content: flex-start;
            margin-top: 20px;
        }
        .btn-back, .btn-edit {
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
        .btn-back {
            background-color: #6c757d;
            margin-right: 10px;
        }
        .btn-back:hover {
            background-color: #5a6268;
        }
        .btn-edit:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Subcontractor Requirement Details</h1>

        <div class="info">
            <p><strong>Estimated Cost:</strong> {{ $requirement->estimated_cost }}</p>
            <p><strong>Preferred Payment Terms:</strong> {{ $requirement->preferred_payment_terms }}</p>
            <p><strong>Start Date Availability:</strong> {{ $requirement->start_date_availability }}</p>
            <p><strong>Estimated Completion Time:</strong> {{ $requirement->estimated_completion_time }}</p>
            <p><strong>Resources Required:</strong> {{ $requirement->resources_required }}</p>
            <p><strong>Insurance Coverage:</strong> {{ $requirement->insurance_coverage }}</p>
            <p><strong>Certifications or Licenses:</strong> {{ $requirement->certifications_or_licenses }}</p>
        </div>

        <div class="button-container">
            <a href="{{ route('requirements.index') }}" class="btn-back">Back</a>
            <a href="{{ route('requirements.edit', $requirement->id) }}" class="btn-edit">Edit</a>
        </div>
    </div>
</body>
</html>
