<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Contact</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <h1>Add Legal Compliance for Supplier: {{ $supplier->company_name }}</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <form action="{{ route('legalcompliance.store') }}" method="POST">
        @csrf
        <input type="hidden" name="supplier_id" value="{{ $supplier->id }}">

        <!-- Registration Number -->
        <div class="form-group">
            <label for="registration_number">Registration Number</label>
            <input type="text" class="form-control @error('registration_number') is-invalid @enderror" id="registration_number" name="registration_number" value="{{ old('registration_number') }}" required>
            @error('registration_number')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Tax Identification Number -->
        <div class="form-group">
            <label for="tax_identification_number">Tax Identification Number</label>
            <input type="text" class="form-control @error('tax_identification_number') is-invalid @enderror" id="tax_identification_number" name="tax_identification_number" value="{{ old('tax_identification_number') }}" required>
            @error('tax_identification_number')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Licenses and Certifications -->
        <div class="form-group">
            <label for="licenses_certifications">Licenses and Certifications</label>
            <textarea class="form-control @error('licenses_certifications') is-invalid @enderror" id="licenses_certifications" name="licenses_certifications" rows="4" required>{{ old('licenses_certifications') }}</textarea>
            @error('licenses_certifications')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Years of Operation -->
        <div class="form-group">
            <label for="years_of_operation">Years of Operation</label>
            <input type="number" class="form-control @error('years_of_operation') is-invalid @enderror" id="years_of_operation" name="years_of_operation" value="{{ old('years_of_operation') }}" min="1" required>
            @error('years_of_operation')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</body>
</html>
