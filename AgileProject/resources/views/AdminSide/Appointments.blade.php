@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto py-6">
        <h2 class="text-3xl font-bold text-gray-800">Manage Appointments</h2>
        <div class="mt-6">
            <table class="min-w-full bg-white border rounded-lg shadow-md">
                <thead>
                    <tr>
                        <th class="py-2 px-4 text-left border-b">Name</th>
                        <th class="py-2 px-4 text-left border-b">Date</th>
                        <th class="py-2 px-4 text-left border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $appointment->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $appointment->date }}</td>
                            <td class="py-2 px-4 border-b">
                                <a href="#" class="text-blue-600">Edit</a> |
                                <a href="#" class="text-red-600">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
