@extends('base')

@section('content')
<div class="container">
    <h2>Add New Asset</h2>
    <form action="{{ route('assets.store') }}" method="POST">
        @csrf

        <!-- Tabs for navigation -->
        <ul class="nav nav-tabs" id="assetFormTabs">
            <li class="nav-item">
                <a class="nav-link active" id="step1-tab" data-bs-toggle="tab" href="#step1">Basic Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="step2-tab" data-bs-toggle="tab" href="#step2">Acquisition Details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="step3-tab" data-bs-toggle="tab" href="#step3">Ownership & Assignment</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="step4-tab" data-bs-toggle="tab" href="#step4">Maintenance & Warranty</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="step5-tab" data-bs-toggle="tab" href="#step5">Disposal Details</a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content mt-3">
            <!-- Step 1: Basic Information -->
            <div class="tab-pane fade show active" id="step1">
                <div class="mb-3">
                    <label class="form-label">Asset Name</label>
                    <input type="text" name="asset_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <input type="text" name="asset_category" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Asset Tag</label>
                    <input type="text" name="asset_tag" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>
                <button type="button" class="btn btn-primary next-tab" data-next="#step2-tab">Next</button>
            </div>

            <!-- Step 2: Acquisition Details -->
            <div class="tab-pane fade" id="step2">
                <div class="mb-3">
                    <label class="form-label">Purchase Date</label>
                    <input type="date" name="purchase_date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Supplier Vendor</label>
                    <input type="text" name="supplier_vendor" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Invoice Number</label>
                    <input type="text" name="invoice_number" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Cost of Asset</label>
                    <input type="number" step="0.01" name="cost_of_asset" class="form-control" required>
                </div>
                <button type="button" class="btn btn-secondary prev-tab" data-prev="#step1-tab">Previous</button>
                <button type="button" class="btn btn-primary next-tab" data-next="#step3-tab">Next</button>
            </div>

            <!-- Step 3: Ownership & Assignment -->
            <div class="tab-pane fade" id="step3">
                <div class="mb-3">
                    <label class="form-label">Assigned To</label>
                    <input type="text" name="assigned_to" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Usage Status</label>
                    <select name="usage_status" class="form-control">
                        <option value="Active">Active</option>
                        <option value="Under Maintenance">Under Maintenance</option>
                        <option value="Retired">Retired</option>
                    </select>
                </div>
                <button type="button" class="btn btn-secondary prev-tab" data-prev="#step2-tab">Previous</button>
                <button type="button" class="btn btn-primary next-tab" data-next="#step4-tab">Next</button>
            </div>

            <!-- Step 4: Maintenance & Warranty -->
            <div class="tab-pane fade" id="step4">
                <div class="mb-3">
                    <label class="form-label">Warranty Expiry Date</label>
                    <input type="date" name="warranty_expiry_date" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Maintenance Schedule</label>
                    <input type="text" name="maintenance_schedule" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Last Maintenance Date</label>
                    <input type="date" name="last_maintenance_date" class="form-control">
                </div>
                <button type="button" class="btn btn-secondary prev-tab" data-prev="#step3-tab">Previous</button>
                <button type="button" class="btn btn-primary next-tab" data-next="#step5-tab">Next</button>
            </div>

            <!-- Step 5: Disposal Details -->
            <div class="tab-pane fade" id="step5">
                <div class="mb-3">
                    <label class="form-label">Disposal Date</label>
                    <input type="date" name="disposal_date" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Disposal Method</label>
                    <input type="text" name="disposal_method" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Resale Value</label>
                    <input type="number" step="0.01" name="resale_value" class="form-control">
                </div>
                <button type="button" class="btn btn-secondary prev-tab" data-prev="#step4-tab">Previous</button>
                <button type="submit" class="btn btn-success">Save Asset</button>
            </div>
        </div>
    </form>
</div>

<!-- Script to handle navigation -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".next-tab").forEach(button => {
            button.addEventListener("click", function() {
                let nextTab = document.querySelector(this.dataset.next);
                new bootstrap.Tab(nextTab).show();
            });
        });

        document.querySelectorAll(".prev-tab").forEach(button => {
            button.addEventListener("click", function() {
                let prevTab = document.querySelector(this.dataset.prev);
                new bootstrap.Tab(prevTab).show();
            });
        });
    });
</script>
@endsection
