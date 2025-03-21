@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto py-6 px-4">
        <!-- Welcome Section with Smooth Animation -->
        <div class="text-center mb-10">
            <h1 class="text-5xl font-extrabold text-gray-800 animate-fade-in">
                Welcome, Admin!
            </h1>
            <p class="mt-4 text-lg text-gray-600 animate-slide-in">
                Effortlessly manage appointments, track progress, and stay organized.
            </p>
        </div>

        <!-- Dashboard Cards with Enhanced UI -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6 rounded-lg shadow-lg text-white transform transition duration-500 hover:scale-105 animate-fade-in">
                <h3 class="text-xl font-bold">Total Appointments</h3>
                <p class="text-4xl font-extrabold mt-2">{{ $totalAppointments }}</p>
            </div>
            <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 p-6 rounded-lg shadow-lg text-white transform transition duration-500 hover:scale-105 animate-fade-in delay-100">
                <h3 class="text-xl font-bold">Pending Requests</h3>
                <p class="text-4xl font-extrabold mt-2">{{ $pendingAppointments }}</p>
            </div>
            <div class="bg-gradient-to-r from-green-400 to-green-500 p-6 rounded-lg shadow-lg text-white transform transition duration-500 hover:scale-105 animate-fade-in delay-200">
                <h3 class="text-xl font-bold">Appointments Completed</h3>
                <p class="text-4xl font-extrabold mt-2">{{ $completedAppointments }}</p>
            </div>
        </div>

        <!-- Calendar Section with Enhanced Styling -->
        <div class="bg-white p-6 rounded-lg shadow-lg mt-10">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Scheduled Appointments</h2>
            <div id="calendar"></div>
        </div>
    </div>

    <!-- Include FullCalendar Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                selectable: true,
                events: @json($appointments), // Laravel will convert this to JSON
                eventTimeFormat: { 
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: true
                },
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                height: 'auto',
                contentHeight: 'auto',
                eventDisplay: 'block',
                eventColor: '#4CAF50', // Green for better visibility
            });
            calendar.render();
        });
    </script>
@endsection