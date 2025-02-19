@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-6 py-12">
    <h1 class="text-4xl font-bold text-gray-900 text-center">Appointments</h1>
    <p class="mt-4 text-lg text-gray-700 text-center">
        Here are the upcoming appointments.
    </p>

    <!-- Display appointments -->
    <div class="mt-8">
        @php
            // Hard-coded appointment data
            $appointments = [
                [
                    'name' => 'John Doe',
                    'email' => 'johndoe@example.com',
                    'date' => '2025-02-20',
                    'time' => '10:00 AM',
                    'status' => 'Scheduled',
                ],
                [
                    'name' => 'Jane Smith',
                    'email' => 'janesmith@example.com',
                    'date' => '2025-02-21',
                    'time' => '2:00 PM',
                    'status' => 'Scheduled',
                ]
            ];
        @endphp

        @if(count($appointments) > 0)
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                <thead>
                    <tr>
                        <th class="py-2 px-4 text-left">Name</th>
                        <th class="py-2 px-4 text-left">Email</th>
                        <th class="py-2 px-4 text-left">Date</th>
                        <th class="py-2 px-4 text-left">Time</th>
                        <th class="py-2 px-4 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                        <tr class="border-t border-gray-200">
                            <td class="py-2 px-4">{{ $appointment['name'] }}</td>
                            <td class="py-2 px-4">{{ $appointment['email'] }}</td>
                            <td class="py-2 px-4">{{ $appointment['date'] }}</td>
                            <td class="py-2 px-4">{{ $appointment['time'] }}</td>
                            <td class="py-2 px-4">{{ $appointment['status'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center text-gray-500">No appointments available at the moment.</p>
        @endif
    </div>
</div>
@endsection
