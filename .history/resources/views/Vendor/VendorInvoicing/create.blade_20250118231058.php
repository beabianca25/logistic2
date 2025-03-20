<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Vendor Invoicing</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Create Vendor Invoicing for Vendor: {{ $vendor->name }}</h1>

        <form action="{{ route('vendorinvoicing.store', $vendor->id) }}" method="POST">
            @csrf

            <!-- Hidden field for vendor_id -->
            <input type="hidden" name="vendor_id" value="{{ $vendor->id }}">

            <!-- Accounts Payable Name -->
            <div class="form-group">
                <label for="accounts_payable_name">Accounts Payable Name:</label>
                <input type="text" id="accounts_payable_name" name="accounts_payable_name" class="form-control" value="{{ old('accounts_payable_name') }}" required>
                @error('accounts_payable_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Accounts Payable Email -->
            <div class="form-group">
                <label for="accounts_payable_email">Accounts Payable Email:</label>
                <input type="email" id="accounts_payable_email" name="accounts_payable_email" class="form-control" value="{{ old('accounts_payable_email') }}" required>
                @error('accounts_payable_email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Postal Address -->
            <div class="form-group">
                <label for="postal_address">Postal Address:</label>
                <textarea id="postal_address" name="postal_address" class="form-control">{{ old('postal_address') }}</textarea>
                @error('postal_address')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Requires Purchase Order (PO) -->
            <div class="form-group">
                <label for="requires_po">Requires Purchase Order (PO):</label>
                <select id="requires_po" name="requires_po" class="form-control" required>
                    <option value="Yes" {{ old('requires_po') == 'Yes' ? 'selected' : '' }}>Yes</option>
                    <option value="No" {{ old('requires_po') == 'No' ? 'selected' : '' }}>No</option>
                </select>
                @error('requires_po')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Additional Instructions -->
            <div class="form-group">
                <label for="additional_instructions">Additional Instructions:</label>
                <textarea id="additional_instructions" name="additional_instructions" class="form-control">{{ old('additional_instructions') }}</textarea>
                @error('additional_instructions')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>

    </div>
</body>
</html>
