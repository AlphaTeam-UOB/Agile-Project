<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Tailwind CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        function loginAdmin(event) {
            event.preventDefault(); // Prevent form submission
            window.location.href = "/admin/dashboard"; // Redirect to Laravel dashboard route
        }
    </script>
    
</head>
<body>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-50 to-indigo-50">
        <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-2xl transform transition-all duration-500 hover:scale-105">
            <div class="text-center mb-8">
                <img src="public/images/logo.png" alt="Company Logo" class="w-24 h-24 mx-auto mb-4">
                <h2 class="text-3xl font-extrabold text-gray-900">Admin Login</h2>
                <p class="mt-2 text-gray-600">Welcome back! Please log in.</p>
            </div>

            <!-- Login Form -->
            <form onsubmit="loginAdmin(event)" class="space-y-6">
                <div>
                    <label class="block text-lg font-medium text-gray-700">Email</label>
                    <input type="email" required class="w-full px-4 py-3 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-lg font-medium text-gray-700">Password</label>
                    <input type="password" required class="w-full px-4 py-3 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <button type="submit" class="w-full py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-lg transition duration-300 hover:scale-105">
                    Login
                </button>
            </form>
        </div>
    </div>
</body>
</html>
