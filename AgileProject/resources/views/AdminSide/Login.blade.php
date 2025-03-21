<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-50 to-indigo-50">
    <div class="w-full h-screen sm:h-auto max-w-md bg-white p-6 sm:p-8 rounded-lg shadow-2xl transform transition-all duration-500 hover:scale-105 flex flex-col justify-center">
        <div class="text-center mb-6 sm:mb-8">
            <img src="{{ asset('images/logo.png') }}" alt="A.A. Samarasinghe Logo" class="h-12 sm:h-16 w-auto mx-auto animate__animated animate__bounceIn">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900">Admin Login</h2>
            <p class="mt-2 text-sm sm:text-base text-gray-600">Welcome back! Please log in.</p>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-4 sm:space-y-6">
            @csrf
            <div>
                <label for="email" class="block text-base sm:text-lg font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required
                    class="w-full px-3 py-2 sm:px-4 sm:py-3 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password" class="block text-base sm:text-lg font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-3 py-2 sm:px-4 sm:py-3 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-center">
                <button type="submit"
                    class="w-3/4 sm:w-full py-2 sm:py-3 text-sm sm:text-base bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-lg transition duration-300 hover:scale-105">
                    Login
                </button>
            </div>
        </form>
    </div>
</body>

</html>