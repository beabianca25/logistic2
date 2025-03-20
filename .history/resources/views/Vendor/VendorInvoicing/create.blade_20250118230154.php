<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Vendor Invoicing</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <h1>Create Vendor Invoicing for Vendor: {{ $vendor->name }}</h1>

    <form action="{{ route('vendorinvoicing.store', ['vendorId' => $vendor->id]) }}" method="POST">
        @csrf
        <div>
            <label for="accounts_payable_name">Accounts Payable Name:</label>
            <input type="text" id="accounts_payable_name" name="accounts_payable_name" value="{{ old('accounts_payable_name') }}" required>
            @error('accounts_payable_name')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="accounts_payable_email">Accounts Payable Email:</label>
            <input type="email" id="accounts_payable_email" name="accounts_payable_email" value="{{ old('accounts_payable_email') }}" required>
            @error('accounts_payable_email')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="postal_address">Postal Address:</label>
            <textarea id="postal_address" name="postal_address">{{ old('postal_address') }}</textarea>
            @error('postal_address')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="requires_po">Requires Purchase Order (PO):</label>
            <select id="requires_po" name="requires_po" required>
                <option value="Yes" {{ old('requires_po') == 'Yes' ? 'selected' : '' }}>Yes</option>
                <option value="No" {{ old('requires_po') == 'No' ? 'selected' : '' }}>No</option>
            </select>
            @error('requires_po')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="additional_instructions">Additional Instructions:</label>
            <textarea id="additional_instructions" name="additional_instructions">{{ old('additional_instructions') }}</textarea>
            @error('additional_instructions')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit">Submit</button>
    </form>

</body>
</html>
