<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Subcontractor Requirement</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold mb-4">Create Subcontractor Requirement</h1>

            @if ($errors->any())
                <div class="mb-4">
                    <ul class="bg-red-100 text-red-700 p-4 rounded">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('requirements.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="subcontractor_id" value="{{ $subcontractor->id }}">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Estimated Cost</label>
                    <input type="number" name="estimated_cost" value="{{ old('estimated_cost') }}" class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Preferred Payment Terms</label>
                    <input type="text" name="preferred_payment_terms" value="{{ old('preferred_payment_terms') }}" class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Start Date Availability</label>
                    <input type="date" name="start_date_availability" value="{{ old('start_date_availability') }}" class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Estimated Completion Time</label>
                    <input type="text" name="estimated_completion_time" value="{{ old('estimated_completion_time') }}" class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Resources Required</label>
                    <textarea name="resources_required" class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('resources_required') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Insurance Coverage</label>
                    <input type="text" name="insurance_coverage" value="{{ old('insurance_coverage') }}" class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Certifications or Licenses</label>
                    <textarea name="certifications_or_licenses" class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('certifications_or_licenses') }}</textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
