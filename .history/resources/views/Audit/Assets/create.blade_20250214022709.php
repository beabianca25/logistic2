@extends('base')

@section('content')
    <div class="container">

        <!-- Stepper Navigation -->
        <div class="d-flex justify-content-center align-items-center mb-4">
            <div class="stepper">
                <div class="step active" data-target="#step1">1</div>
                <div class="line"></div>
                <div class="step" data-target="#step2">2</div>
                <div class="line"></div>
                <div class="step" data-target="#step3">3</div>
                <div class="line"></div>
                <div class="step" data-target="#step4">4</div>
                <div class="line"></div>
                <div class="step" data-target="#step5">5</div>
            </div>
        </div>

        <form action="{{ route('assets.store') }}" method="POST">
            @csrf

            <!-- Form Steps -->
            <div class="step-content">

                <div class="step-panel active" id="step1">
                    <h4 class="text-center">Basic Information</h4>
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
                    <button type="button" class="btn btn-primary next-step">Next</button>
                </div>


                <div class="step-panel" id="step2">
                    <h4 class="text-center">Acquisition Details</h4>
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
                    <button type="button" class="btn btn-secondary prev-step">Previous</button>
                    <button type="button" class="btn btn-primary next-step">Next</button>
                </div>

                <!-- Step 3:  -->
                <div class="step-panel" id="step3">
                    <h4 class="text-center">Ownership & Assignment</h4>
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
                    <button type="button" class="btn btn-secondary prev-step">Previous</button>
                    <button type="button" class="btn btn-primary next-step">Next</button>
                </div>

                <!-- Step 4:  -->
                <div class="step-panel" id="step4">
                    <h4 class="text-center">Maintenance & Warranty</h4>
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
                    <button type="button" class="btn btn-secondary prev-step">Previous</button>
                    <button type="button" class="btn btn-primary next-step">Next</button>
                </div>

                <!-- Step 5:  -->
                <div class="step-panel" id="step5">
                    <h4 class="text-center">Disposal Details</h4>
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
                    <button type="button" class="btn btn-secondary prev-step">Previous</button>
                    <button type="submit" class="btn btn-success">Save Asset</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Styles -->
    <style>
        .stepper {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .step {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .step.active {
            background: #007bff;
            color: white;
        }

        .line {
            width: 50px;
            height: 5px;
            background: #ddd;
        }

        .step-panel {
            display: none;
        }

        .step-panel.active {
            display: block;
        }
    </style>

    <!-- JavaScript -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let steps = document.querySelectorAll(".step");
            let panels = document.querySelectorAll(".step-panel");
            let currentStep = 0;

            function showStep(index) {
                panels.forEach((panel, i) => {
                    panel.classList.toggle("active", i === index);
                    steps[i].classList.toggle("active", i <= index);
                });
            }

            document.querySelectorAll(".next-step").forEach(button => {
                button.addEventListener("click", () => {
                    if (currentStep < steps.length - 1) {
                        currentStep++;
                        showStep(currentStep);
                    }
                });
            });

            document.querySelectorAll(".prev-step").forEach(button => {
                button.addEventListener("click", () => {
                    if (currentStep > 0) {
                        currentStep--;
                        showStep(currentStep);
                    }
                });
            });

            showStep(currentStep);
        });
    </script>
@endsection
