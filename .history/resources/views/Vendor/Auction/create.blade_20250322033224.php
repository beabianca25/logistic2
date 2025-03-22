@extends('base')

@section('content')
    <div class="container">
        <h1>Create New Auction
            <a href="{{ route('auction.index') }}" class="btn btn-danger float-end">Back</a>
        </h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('auction.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Type Selection -->
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select class="form-select" id="type" name="type" required>
                    <option value="">Select Type</option>
                    <option value="product">Product</option>
                    <option value="service">Service</option>
                    <option value="rental">Rental</option>
                </select>
            </div>

            <!-- Category Selection -->
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" name="category" disabled required>
                    <!-- Categories will be populated based on the selected type -->
                </select>
            </div>

            <!-- Common fields -->
            <div class="mb-3">
                <label for="auction_title" class="form-label">Auction Title</label>
                <input type="text" class="form-control" id="auction_title" name="auction_title" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>

            <!-- Fields based on the type -->
            <div id="type-specific-fields">
                <!-- Fields for 'rent' -->
                <div id="rent-fields" class="d-none">
                    <div class="mb-3">
                        <label for="price_per_unit" class="form-label">Price per Unit</label>
                        <input type="number" step="0.01" class="form-control" id="price_per_unit" name="price_per_unit">
                    </div>
                    <div class="mb-3">
                        <label for="rental_duration_unit" class="form-label">Rental Duration Unit</label>
                        <input type="text" class="form-control" id="rental_duration_unit" name="rental_duration_unit">
                    </div>
                </div>

                <!-- Fields for 'service' -->
                <div id="service-fields" class="d-none">
                    <div class="mb-3">
                        <label for="destination" class="form-label">Destination</label>
                        <input type="text" class="form-control" id="destination" name="destination">
                    </div>
                    <div class="mb-3">
                        <label for="duration" class="form-label">Duration</label>
                        <input type="text" class="form-control" id="duration" name="duration">
                    </div>
                    <div class="mb-3">
                        <label for="included_services" class="form-label">Included Services</label>
                        <textarea class="form-control" id="included_services" name="included_services" rows="3"></textarea>
                    </div>
                </div>

                <!-- Fields for 'product' -->
                <div id="product-fields" class="d-none">
                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input type="number" class="form-control" id="year" name="year">
                    </div>
                    <div class="mb-3">
                        <label for="condition" class="form-label">Condition</label>
                        <input type="text" class="form-control" id="condition" name="condition">
                    </div>
                    <div class="mb-3">
                        <label for="product_version" class="form-label">Product Version</label>
                        <input type="text" class="form-control" id="product_version" name="product_version">
                    </div>
                    <div class="mb-3">
                        <label for="company" class="form-label">Company</label>
                        <input type="text" class="form-control" id="company" name="company">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="photo" class="form-label">Photo</label>
                <input type="file" class="form-control" id="photo" name="photo">
            </div>

            <div class="mb-3">
                <label for="min_estimate_price" class="form-label">Minimum Estimate Price</label>
                <input type="number" step="0.01" class="form-control" id="min_estimate_price"
                    name="min_estimate_price">
            </div>

            <div class="mb-3">
                <label for="end_date" class="form-label">End Date:</label>
                <input type="date" step="0.01" class="form-control" id="end_date" name="end_date">
            </div>
            <input type="hidden" name="status" value="active">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeSelect = document.getElementById('type');
            const categorySelect = document.getElementById('category');
            const rentFields = document.getElementById('rent-fields');
            const serviceFields = document.getElementById('service-fields');
            const productFields = document.getElementById('product-fields');

            const categories = {
                product: ['Electronics', 'Furniture', 'Clothing'],
                service: ['Consulting', 'Design', 'Maintenance'],
                rental: ['Vehicles', 'Equipment', 'Properties']
            };

            typeSelect.addEventListener('change', function() {
                const selectedType = typeSelect.value;
                categorySelect.innerHTML = ''; // Clear existing options

                if (selectedType && categories[selectedType]) {
                    categories[selectedType].forEach(function(category) {
                        const option = document.createElement('option');
                        option.value = category;
                        option.textContent = category;
                        categorySelect.appendChild(option);
                    });
                    categorySelect.disabled = false; // Enable the category select
                } else {
                    categorySelect.disabled = true; // Disable if no type is selected
                }

                // Show or hide type-specific fields
                rentFields.classList.add('d-none');
                serviceFields.classList.add('d-none');
                productFields.classList.add('d-none');

                if (selectedType === 'rent') {
                    rentFields.classList.remove('d-none');
                } else if (selectedType === 'service') {
                    serviceFields.classList.remove('d-none');
                } else if (selectedType === 'product') {
                    productFields.classList.remove('d-none');
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                const alert = document.querySelector('.alert');
                if (alert) {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }
            }, 5000);
        });
    </script>
@endsection
