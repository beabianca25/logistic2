<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Supplier Reference</title>
</head>
<body>
    <div class="container">
        <h2>Create Supplier Reference</h2>
        
        <form action="{{ route('supplierreference.store') }}" method="POST">
            @csrf
        
            <!-- Include Supplier ID as a Hidden Input -->
            <input type="hidden" name="supplier_id" value="{{ $supplier->id }}">
        
            <!-- Client Name -->
            <div class="mb-3">
                <label for="client_name" class="form-label">Client Name</label>
                <input type="text" name="client_name" id="client_name" class="form-control" required>
            </div>
        
            <!-- Client Contact -->
            <div class="mb-3">
                <label for="client_contact" class="form-label">Client Contact</label>
                <input type="text" name="client_contact" id="client_contact" class="form-control" required>
            </div>
        
            <!-- Project Description -->
            <div class="mb-3">
                <label for="project_description" class="form-label">Project Description</label>
                <textarea name="project_description" id="project_description" class="form-control" required></textarea>
            </div>
        
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Save Reference</button>
        </form>
        
    </div>
</body>
</html>
