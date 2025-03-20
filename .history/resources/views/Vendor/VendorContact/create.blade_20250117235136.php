<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Contact</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <h1>Create Contact for Vendor</h1>

    <form action="{{ route('vendorcontact.store', ['vendor' => $vendor->id]) }}" method="POST">
        @csrf
        <div>
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
            @error('first_name')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
            @error('last_name')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="job_title">Job Title:</label>
            <input type="text" id="job_title" name="job_title" value="{{ old('job_title') }}">
            @error('job_title')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required>
            @error('phone')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit">Add Contact</button>

        @if(isset($vendorId) && $vendorId)
        <form action="{{ route('vendorconsent.create', ['vendor' => $vendorId]) }}" method="GET">
            <div>
                <button type="submit">Next: Add Consent</button>
            </div>
        </form>
    @else
        <p>Please save the vendor first to proceed to adding a contact.</p>
    @endif
    </form>
    
</body>
</html>
