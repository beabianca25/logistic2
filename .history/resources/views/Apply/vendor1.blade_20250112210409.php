
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Application</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background-color: #f8f9fa;">

<div class="container mt-5">
    <h2 class="text-center mb-4">Vendor Application Form</h2>
    <form action="/submit-vendor-application" method="POST" class="p-4 border rounded shadow-sm bg-white">
        <!-- Business Details -->
        <div class="form-group">
            <label for="businessName">Business Name*</label>
            <input type="text" class="form-control" id="businessName" name="businessName" placeholder="Enter your business name" required>
        </div>
        <div class="form-group">
            <label for="registrationNumber">Registration Number*</label>
            <input type="text" class="form-control" id="registrationNumber" name="registrationNumber" placeholder="Enter registration number" required>
        </div>
        <div class="form-group">
            <label for="businessType">Business Type*</label>
            <select class="form-control" id="businessType" name="businessType" required>
                <option value="" disabled selected>Select business type</option>
                <option value="Sole Proprietor">Sole Proprietor</option>
                <option value="Partnership">Partnership</option>
                <option value="Corporation">Corporation</option>
                <option value="LLC">LLC</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="form-group">
            <label for="industrySegment">Industry Segment*</label>
            <input type="text" class="form-control" id="industrySegment" name="industrySegment" placeholder="Enter your industry segment" required>
        </div>
        <div class="form-group">
            <label for="numberOfEmployees">Number of Employees*</label>
            <select class="form-control" id="numberOfEmployees" name="numberOfEmployees" required>
                <option value="1-10">1-10</option>
                <option value="10-50">10-50</option>
                <option value="50-100">50-100</option>
                <option value="100-1000">100-1000</option>
                <option value="1000+">1000+</option>
            </select>
        </div>
        <div class="form-group">
            <label for="geographicalCoverage">Geographical Coverage*</label>
            <input type="text" class="form-control" id="geographicalCoverage" name="geographicalCoverage" placeholder="Enter areas you cover (e.g., National, Regional, Global)" required>
        </div>
        <!-- Contact Information -->
        <h5 class="mt-4">Contact Information</h5>
        <div class="form-group">
            <label for="contactPhone">Contact Phone*</label>
            <input type="tel" class="form-control" id="contactPhone" name="contactPhone" placeholder="Enter contact phone number" required>
        </div>
        <div class="form-group">
            <label for="contactEmail">Contact Email*</label>
            <input type="email" class="form-control" id="contactEmail" name="contactEmail" placeholder="Enter contact email" required>
        </div>
        <div class="form-group">
            <label for="websiteUrl">Website URL</label>
            <input type="url" class="form-control" id="websiteUrl" name="websiteUrl" placeholder="Enter website URL">
        </div>
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary btn-block">Submit Application</button>
    </form>
</div>

</body>
</html>

@endsection