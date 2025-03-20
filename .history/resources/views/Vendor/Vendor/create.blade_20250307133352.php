<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Form</title>
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
            margin-bottom: 5px;
            display: block;
            color: #555;
        }
        input, select, textarea, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        textarea {
            resize: none;
        }
        button {
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn-next {
            background-color: #007bff;
            color: white;
            border: none;
        }
        .btn-next:hover {
            background-color: #0056b3;
        }
        .btn-back {
            background-color: #6c757d;
            color: white;
            border: none;
        }
        .btn-back:hover {
            background-color: #5a6268;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }
        .row {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }
        .col {
            flex: 1;
        }
    </style>
</head>
<body>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="container">
        <h2>Vendor Registration Form</h2>
        <form action="{{ route('vendor.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col">
                    <label for="business_name">Business Name:</label>
                    <input type="text" id="business_name" name="business_name" required>
                </div>
                <div class="col">
                    <label for="registration_number">Registration Number:</label>
                    <input type="text" id="registration_number" name="registration_number">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="business_type">Business Type:</label>
                    <select id="business_type" name="business_type" required>
                        <option value="" disabled selected>Select Business Type</option>
                        <option value="Company">Company</option>
                        <option value="Partnership">Partnership</option>
                        <option value="Sole Trader">Sole Trader</option>
                        <option value="Not-For-Profit">Not-For-Profit</option>
                        <option value="Trust">Trust</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="col">
                    <label for="industry_segment">Industry Segment:</label>
                    <select id="industry_segment" name="industry_segment" required>
                        <option value="" disabled selected>Select Industry Segment</option>
                        <option value="Accommodation">Accommodation</option>
                        <option value="Transportation">Transportation</option>
                        <option value="Tour Guide">Tour Guide</option>
                        <option value="Event Management">Event Management</option>
                        <option value="Hospitality">Hospitality</option>
                        <option value="Travel Agency">Travel Agency</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="number_of_employees">Number of Employees:</label>
                    <select id="number_of_employees" name="number_of_employees" required>
                        <option value="" disabled selected>Select Number of Employees</option>
                        <option value="1-10">1-10</option>
                        <option value="10-50">10-50</option>
                        <option value="50-100">50-100</option>
                        <option value="100-1000">100-1000</option>
                        <option value="1000+">1000+</option>
                    </select>
                </div>
                <div class="col">
                    <label for="geographical_coverage">Geographical Coverage:</label>
                    <select id="geographical_coverage" name="geographical_coverage" required>
                        <option value="" disabled selected>Select Coverage</option>
                        <option value="Local">Local</option>
                        <option value="National">National</option>
                        <option value="Regional">Regional</option>
                        <option value="Global">Global</option>
                    </select>
                </div>
            </div>
            <div>
                <label for="business_address">Business Address:</label>
                <textarea id="business_address" name="business_address" required></textarea>
            </div>
            <div class="row">
                <div class="col">
                    <label for="contact_phone">Contact Phone:</label>
                    <input type="tel" id="contact_phone" name="contact_phone" required>
                </div>
                <div class="col">
                    <label for="contact_email">Contact Email:</label>
                    <input type="email" id="contact_email" name="contact_email" required>
                </div>
            </div>
            <div>
                <label for="website_url">Website URL:</label>
                <input type="url" id="website_url" name="website_url">
            </div>
            <!-- Status Field -->
            <div class="row">
                <div class="col">
                    <label for="status">Status:</label>
                    <select id="status" name="status" required>
                        <option value="" disabled selected>Select Status</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                        <option value="Pending">Pending</option>
                    </select>
                </div>
            </div>
            <div class="button-container">
                <!-- Back Button -->
                <button type="button" class="btn-back" onclick="history.back()">Back</button>
                <!-- Next Button -->
                <button type="submit" class="btn-next">Next</button>
            </div>
        </form>
    </div>
</body>
</html>
