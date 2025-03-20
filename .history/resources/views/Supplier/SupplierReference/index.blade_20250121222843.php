<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vendor Consent Form</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <h1>Vendor Consent Form</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('vendorconsent.store', ['vendorId' => $vendor->id]) }}" method="POST" novalidate>
        @csrf

        <div class="form-group">
            <label for="authorized_person_name">Authorized Person Name</label>
            <input type="text" name="authorized_person_name" id="authorized_person_name" 
                   class="form-control" value="{{ old('authorized_person_name') }}" required>
        </div>

        <div class="form-group">
            <label for="contract_email">Contact Email</label>
            <input type="email" name="contract_email" id="contract_email" 
                   class="form-control" value="{{ old('contract_email') }}" required>
        </div>

        <div class="form-group">
            <label for="agreement_to_terms">Agreement to Terms</label>
            <select name="agreement_to_terms" id="agreement_to_terms" class="form-control" required>
                <option value="">-- Select an Option --</option>
                <option value="Yes" {{ old('agreement_to_terms') == 'Yes' ? 'selected' : '' }}>Yes</option>
                <option value="No" {{ old('agreement_to_terms') == 'No' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="agreement_to_credit_check">Agreement to Credit Check</label>
            <select name="agreement_to_credit_check" id="agreement_to_credit_check" class="form-control" required>
                <option value="">-- Select an Option --</option>
                <option value="Yes" {{ old('agreement_to_credit_check') == 'Yes' ? 'selected' : '' }}>Yes</option>
                <option value="No" {{ old('agreement_to_credit_check') == 'No' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="signature">Signature</label>
            <textarea name="signature" id="signature" class="form-control" rows="3" required>{{ old('signature') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Consent</button>
    </form>
</body>
</html>
