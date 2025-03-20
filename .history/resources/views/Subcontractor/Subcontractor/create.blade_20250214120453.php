<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Subcontractor</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .progress-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .progress-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            flex: 1;
        }
        .circle {
            width: 40px;
            height: 40px;
            background-color: #ccc;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-weight: bold;
            position: relative;
            z-index: 1;
        }
        .progress-step.active .circle {
            background-color: #007bff;
        }
        .progress-step .label {
            margin-top: 5px;
            font-size: 14px;
            color: #333;
        }
        .line {
            height: 4px;
            background-color: #ccc;
            width: 100%;
            position: absolute;
            top: 50%;
            left: 50%;
            z-index: 0;
        }
        .progress-step:not(:last-child)::after {
            content: "";
            height: 4px;
            background-color: #ccc;
            width: 100%;
            position: absolute;
            top: 20px;
            left: 50%;
            z-index: 0;
        }
        .progress-step.active:not(:last-child)::after {
            background-color: #007bff;
        }
        .form-group {
            display: none;
        }
        .form-group.active {
            display: block;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            color: #555;
        }
        input, textarea, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        .btn-back {
            background-color: #6c757d;
            margin-right: 10px;
        }
        .btn-back:hover {
            background-color: #5a6268;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create Subcontractor</h1>

        <!-- Progress Bar -->
        <div class="progress-container">
            <div class="progress-step active">
                <div class="circle">1</div>
                <div class="label">Step 1</div>
            </div>
            <div class="progress-step">
                <div class="circle">2</div>
                <div class="label">Step 2</div>
            </div>
            <div class="progress-step">
                <div class="circle">3</div>
                <div class="label">Step 3</div>
            </div>
        </div>

        <!-- Form -->
        <form id="subcontractor-form" action="{{ route('subcontractor.store') }}" method="POST">
            @csrf

            <div class="form-group active">
                <label for="subcontractor_name">Subcontractor Name:</label>
                <input type="text" id="subcontractor_name" name="subcontractor_name" required>
            </div>

            <div class="form-group">
                <label for="business_registration_number">Business Registration Number:</label>
                <input type="text" id="business_registration_number" name="business_registration_number" required>
            </div>

            <div class="form-group">
                <label for="contact_person">Contact Person:</label>
                <input type="text" id="contact_person" name="contact_person" required>
            </div>

            <div class="button-container">
                <button type="button" class="btn-back" onclick="prevStep()" id="prevBtn" disabled>Back</button>
                <button type="button" id="nextBtn" onclick="nextStep()">Next</button>
                <button type="submit" id="submitBtn" style="display: none;">Submit</button>
            </div>
        </form>
    </div>

    <script>
        let currentStep = 0;
        const steps = document.querySelectorAll('.form-group');
        const progressSteps = document.querySelectorAll('.progress-step');
        const nextBtn = document.getElementById('nextBtn');
        const prevBtn = document.getElementById('prevBtn');
        const submitBtn = document.getElementById('submitBtn');

        function updateSteps() {
            steps.forEach((step, index) => {
                step.classList.toggle('active', index === currentStep);
            });

            progressSteps.forEach((step, index) => {
                step.classList.toggle('active', index <= currentStep);
            });

            prevBtn.disabled = currentStep === 0;
            nextBtn.style.display = currentStep < steps.length - 1 ? "inline-block" : "none";
            submitBtn.style.display = currentStep === steps.length - 1 ? "inline-block" : "none";
        }

        function nextStep() {
            if (currentStep < steps.length - 1) {
                currentStep++;
                updateSteps();
            }
        }

        function prevStep() {
            if (currentStep > 0) {
                currentStep--;
                updateSteps();
            }
        }

        document.getElementById('subcontractor-form').addEventListener('submit', function(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Thank you!',
                text: 'Please wait for an email confirmation.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit();
                }
            });
        });

        updateSteps();
    </script>
</body>
</html>
