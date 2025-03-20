<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Certification</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <h1>Create Certification for Vendor</h1>


    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="{{ route('vendorcertification.store', ['vendorId' => $vendor->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="certification_name">Certification Name:</label>
            <input type="text" id="certification_name" name="certification_name" required>
        </div>
        <div>
            <label for="certification_type">Certification Type:</label>
            <select id="certification_type" name="certification_type" required>
                <option value="Business License">Business License</option>
                <option value="Safety Certification">Safety Certification</option>
                <option value="Insurance Document">Insurance Document</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div>
            <label for="file_path">File:</label>
            <input type="file" id="file_path" name="file_path" accept="application/pdf,image/*" required>
        </div>
        <div>
            <label for="valid_until">Valid Until:</label>
            <input type="date" id="valid_until" name="valid_until">
        </div>
        <button type="submit">Add Certification</button>
    </form>
</body>
</html>
