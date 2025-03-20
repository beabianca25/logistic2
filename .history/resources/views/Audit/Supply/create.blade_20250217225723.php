@extends('base')

@section('content')
    <div class="container">

        <a href="{{ route('supply.index') }}" class="btn btn-outline-secondary mb-3">Back</a>

        <!-- Alert for errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <!-- Stepper Navigation -->
        <div class="d-flex justify-content-center align-items-center mb-4">
            <div class="stepper">
                <div class="step active" data-target="#step1">1</div>
                <div class="line"></div>
                <div class="step" data-target="#step2">2</div>
                <div class="line"></div>
                <div class="step" data-target="#step3">3</div>
            </div>
        </div>

        <form action="{{ route('supply.store') }}" method="POST">
            @csrf

            <!-- Form Steps -->
            <div class="step-content">

                <!-- Step 1: Basic Information -->
                <div class="step-panel active" id="step1">
                    <h4 class="text-center">Basic Information</h4>
                    <div class="mb-3">
                        <label class="form-label">Supply Name</label>
                        <input type="text" name="supply_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <input type="text" name="category" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <button type="button" class="btn btn-primary next-step">Next</button>
                </div>

                <!-- Step 2: Purchase Details -->
                <div class="step-panel" id="step2">
                    <h4 class="text-center">Purchase Details</h4>
                    <div class="mb-3">
                        <label class="form-label">Supplier Vendor</label>
                        <input type="text" name="supplier_vendor" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantity Purchased</label>
                        <input type="number" name="quantity_purchased" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Unit Price</label>
                        <input type="number" step="0.01" name="unit_price" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Total Cost</label>
                        <input type="number" step="0.01" name="total_cost" class="form-control" required>
                    </div>
                    <button type="button" class="btn btn-secondary prev-step">Previous</button>
                    <button type="button" class="btn btn-primary next-step">Next</button>
                </div>

                <!-- Step 3: Inventory Management -->
                <div class="step-panel" id="step3">
                    <h4 class="text-center">Inventory Management</h4>
                    <div class="mb-3">
                        <label class="form-label">Stock on Hand</label>
                        <input type="number" name="stock_on_hand" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Reorder Level</label>
                        <input type="number" name="reorder_level" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Storage Location</label>
                        <input type="text" name="storage_location" class="form-control">
                    </div>
                    <button type="button" class="btn btn-secondary prev-step">Previous</button>
                    <button type="submit" class="btn btn-success">Save Supply</button>
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
