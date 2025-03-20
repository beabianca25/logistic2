<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Invoicing Details</title>
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
        h1, h2 {
            text-align: center;
            color: #333;
        }
        h2 {
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            color: #555;
            display: block;
            margin-bottom: 5px;
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
        <h1>Vendor Invoicing Details</h1>
        <h2>Vendor: {{ $vendor->business_name }}</h2>

        <label>Accounts Payable Name:</label>
        <p>{{ $vendorInvoicing->accounts_payable_name }}</p>

        <label>Accounts Payable Email:</label>
        <p>{{ $vendorInvoicing->accounts_payable_email }}</p>

        <label>Postal Address:</label>
        <p>{{ $vendorInvoicing->postal_address }}</p>

        <label>Requires Purchase Order (PO):</label>
        <p>{{ $vendorInvoicing->requires_po }}</p>

        <label>Additional Instructions:</label>
        <p>{{ $vendorInvoicing->additional_instructions ?? 'None' }}</p>

        <div class="button-container">
            <button class="btn-back" onclick="history.back()">Back</button>
            <a href="{{ route('vendorinvoicing.edit', $vendorInvoicing->id) }}">
                <button class="btn-edit">Edit</button>
            </a>
        </div>
    </div>
</body>
</html>
