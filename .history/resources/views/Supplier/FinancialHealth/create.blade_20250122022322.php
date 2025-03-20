<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Contact</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <h1>Create Financial Health Information for Supplier: {{ $supplier->contact_name }}</h1>

    <form action="{{ route('FinancialHealth.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="bank_account_number">Bank Account Number</label>
            <input type="text" name="bank_account_number" id="bank_account_number" class="form-control" value="{{ old('bank_account_number') }}" required>
        </div>

        <div class="form-group">
            <label for="tax_compliance">Tax Compliance</label>
            <input type="text" name="tax_compliance" id="tax_compliance" class="form-control" value="{{ old('tax_compliance') }}">
        </div>

        <div class="form-group">
            <label for="insurance_coverage">Insurance Coverage</label>
            <input type="text" name="insurance_coverage" id="insurance_coverage" class="form-control" value="{{ old('insurance_coverage') }}">
        </div>

        <!-- Hidden field to pass the supplier_id -->
        <input type="hidden" name="supplier_id" value="{{ $supplier->id }}">

        <button type="submit" class="btn btn-primary">Create Financial Health Information</button>
    </form>
</body>
</html>
