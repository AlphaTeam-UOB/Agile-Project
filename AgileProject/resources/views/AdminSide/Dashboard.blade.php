@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto py-6">
        <!-- Animated Welcome Section -->
        <div class="text-center">
            <h1 class="text-5xl font-extrabold text-gray-800 animate-fade-in">
                Welcome to the Admin Dashboard
            </h1>
            <p class="mt-4 text-lg text-gray-600 animate-slide-in">
                Manage appointments, your profile, and more with ease.
            </p>
        </div>

        <!-- Dashboard Cards with Animation -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">
            <div class="bg-white p-6 rounded-lg shadow-lg transform transition duration-500 hover:scale-105 animate-fade-in">
                <h3 class="text-xl font-bold text-gray-700">Total Appointments</h3>
                <p class="text-3xl font-extrabold text-indigo-600 mt-2">124</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg transform transition duration-500 hover:scale-105 animate-fade-in delay-100">
                <h3 class="text-xl font-bold text-gray-700">Pending Requests</h3>
                <p class="text-3xl font-extrabold text-yellow-500 mt-2">15</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg transform transition duration-500 hover:scale-105 animate-fade-in delay-200">
                <h3 class="text-xl font-bold text-gray-700">Appointments Completed</h3>
                <p class="text-3xl font-extrabold text-green-500 mt-2">89</p>
            </div>
        </div>
    </div>
@endsection
