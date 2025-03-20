<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Subcontractor</title>
    <!-- Include your CSS framework, e.g., Tailwind, Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold mb-4">Create New Subcontractor</h1>

            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="mb-4">
                    <ul class="bg-red-100 text-red-700 p-4 rounded">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('subcontractors.store') }}" method="POST" class="space-y-4">
                @csrf
                <!-- Subcontractor Name -->
                <div>
                    <label for="subcontractor_name" class="block text-sm font-medium text-gray-700">Subcontractor Name</label>
                    <input type="text" name="subcontractor_name" id="subcontractor_name" value="{{ old('subcontractor_name') }}" 
                        class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <!-- Business Registration Number -->
                <div>
                    <label for="business_registration_number" class="block text-sm font-medium text-gray-700">Business Registration Number</label>
                    <input type="text" name="business_registration_number" id="business_registration_number" value="{{ old('business_registration_number') }}" 
                        class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <!-- Contact Person -->
                <div>
                    <label for="contact_person" class="block text-sm font-medium text-gray-700">Contact Person</label>
                    <input type="text" name="contact_person" id="contact_person" value="{{ old('contact_person') }}" 
                        class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <!-- Business Address -->
                <div>
                    <label for="business_address" class="block text-sm font-medium text-gray-700">Business Address</label>
                    <textarea name="business_address" id="business_address" rows="3" 
                        class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>{{ old('business_address') }}</textarea>
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" 
                        class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" 
                        class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <!-- Website -->
                <div>
                    <label for="website" class="block text-sm font-medium text-gray-700">Website (Optional)</label>
                    <input type="url" name="website" id="website" value="{{ old('website') }}" 
                        class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Services Offered -->
                <div>
                    <label for="services_offered" class="block text-sm font-medium text-gray-700">Services Offered</label>
                    <textarea name="services_offered" id="services_offered" rows="3" 
                        class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>{{ old('services_offered') }}</textarea>
                </div>

                <!-- Relevant Experience -->
                <div>
                    <label for="relevant_experience" class="block text-sm font-medium text-gray-700">Relevant Experience</label>
                    <textarea name="relevant_experience" id="relevant_experience" rows="3" 
                        class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>{{ old('relevant_experience') }}</textarea>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" 
                        class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
