<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Favicon for Browser Tab -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <style>
        .sidebar-transition {
            transition: width 0.3s ease-in-out, opacity 0.3s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-100 flex flex-col h-screen">
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
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
                    <a href="{{ route('admin.appointments.index') }}" class="block py-2 px-4 flex items-center hover:bg-gray-700 rounded transition">
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
         
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">

<!-- Top Bar -->
<div class="bg-white shadow-md px-6 py-4 flex justify-between items-center">
    <h1 class="text-xl font-bold">Home</h1>
    <div class="flex items-center space-x-6">
        <!-- Time-Based Greeting -->
        <span class="text-gray-700 font-semibold">
            @php
                $hour = now()->hour; // Get the current hour
                $greeting = 'Good Day';
                if ($hour >= 5 && $hour < 12) {
                    $greeting = 'Good Morning';
                } elseif ($hour >= 12 && $hour < 18) {
                    $greeting = 'Good Afternoon';
                } elseif ($hour >= 18 && $hour < 22) {
                    $greeting = 'Good Evening';
                }
            @endphp
            {{ $greeting }},
        </span>

        <!-- User's Name -->
        <span class="text-gray-700 font-semibold">
            {{ Auth::check() ? Auth::user()->name : 'Guest' }}
        </span>

        <!-- Admin Avatar -->
        <img src="{{ asset('images/admin.png') }}" class="rounded-full w-10 h-10 border border-gray-300" alt="Admin Avatar">

        <!-- Logout Button with FontAwesome Icon -->
        @if(Auth::check())
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center text-gray-700 font-semibold text-sm bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
            </form>
        @endif
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


    @yield('scripts') 
</body>
</html>
