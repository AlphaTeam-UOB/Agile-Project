<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .sidebar-transition {
            transition: width 0.3s ease-in-out, opacity 0.3s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-100 flex flex-col h-screen">

    <div x-data="{ isSidebarOpen: true }" class="flex flex-1">

        <!-- Sidebar -->
        <div :class="isSidebarOpen ? 'w-64' : 'w-20'" class="bg-gray-900 text-white h-full flex flex-col sidebar-transition">
            <div class="p-6 flex justify-between items-center">
                <h2 x-show="isSidebarOpen" class="text-2xl font-bold">Admin Panel</h2>
                <button @click="isSidebarOpen = !isSidebarOpen" class="focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="white">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
            <ul class="flex-1">
                <li class="mb-4">
                    <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 flex items-center hover:bg-gray-700 rounded transition">
                        <span class="mr-3">📊</span>
                        <span x-show="isSidebarOpen">Dashboard</span>
                    </a>
                </li>
                <li class="mb-4">
                    <a href="{{ route('admin.appointments') }}" class="block py-2 px-4 flex items-center hover:bg-gray-700 rounded transition">
                        <span class="mr-3">📅</span>
                        <span x-show="isSidebarOpen">Appointments</span>
                    </a>
                </li>
                <li class="mb-4">
                    <a href="{{ route('admin.profile') }}" class="block py-2 px-4 flex items-center hover:bg-gray-700 rounded transition">
                        <span class="mr-3">👤</span>
                        <span x-show="isSidebarOpen">Profile</span>
                    </a>
                </li>
            </ul>
            <div class="p-6">
                <a href="#" class="block py-2 px-4 flex items-center text-red-500 hover:text-red-300 transition">
                    <span class="mr-3">🚪</span>
                    <span x-show="isSidebarOpen">Logout</span>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">

            <!-- Top Bar -->
            <div class="bg-white shadow-md px-6 py-4 flex justify-between items-center">
                <h1 class="text-xl font-bold">Home</h1>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700 font-semibold">Admin Name</span>
                    <img src="https://via.placeholder.com/40" class="rounded-full w-10 h-10 border border-gray-300" alt="Admin Avatar">
                </div>
            </div>

            <!-- Page Content -->
            <div class="p-6 bg-gray-100 flex-1">
                @yield('content')
            </div>

            <!-- Copyright Bar -->
            <footer class="bg-gray-800 text-white text-center py-2 mt-auto">
                &copy; 2024 Admin Panel. All rights reserved.
            </footer>
        </div>
    </div>

</body>
</html>
