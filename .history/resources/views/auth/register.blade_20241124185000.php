<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-pink-400 via-pink-300 to-pink-200">
        <div class="flex flex-col lg:flex-row bg-white rounded-lg shadow-lg">
            <!-- Left Side -->
            <div class="hidden lg:flex items-center justify-center bg-gradient-to-r from-pink-500 to-pink-400 text-white p-8 rounded-l-lg">
                <h2 class="text-4xl font-bold rotate-90 transform text-white">
                    SIGN UP
                </h2>
            </div>
            
            <!-- Right Side -->
            <div class="p-8 w-full">
                <div class="flex justify-center mb-8">
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="h-20 w-20">
                </div>

                <!-- Laravel Register Form -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus 
                            class="block mt-1 w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500">
                        @error('name')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mt-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required 
                            class="block mt-1 w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500">
                        @error('email')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" type="password" name="password" required 
                            class="block mt-1 w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500">
                        @error('password')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required 
                            class="block mt-1 w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500">
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6">
                        <button type="submit" class="w-full bg-pink-500 text-white py-2 rounded-lg hover:bg-pink-600">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
