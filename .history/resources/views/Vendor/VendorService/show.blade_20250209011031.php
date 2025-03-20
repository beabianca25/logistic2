<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Details</title>
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
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        label {
            font-weight: bold;
            display: block;
            color: #555;
        }
        .details {
            background: #eef;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .btn-back {
            background-color: #6c757d;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn-back:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Service Details</h2>
        
        <div class="details">
            <label>Service Category:</label>
            <p>{{ $service->service_category }}</p>
        </div>
        
        <div class="details">
            <label>Service Description:</label>
            <p>{{ $service->service_description }}</p>
        </div>
        
        <div class="details">
            <label>Areas of Operation:</label>
            <p>{{ $service->areas_of_operation }}</p>
        </div>
        
        <div class="details">
            <label>Price Range:</label>
            <p>{{ $service->price_range ?? 'Not specified' }}</p>
        </div>
        
        <button class="btn-back" onclick="history.back()">Back</button>
    </div>
</body>
</html>
