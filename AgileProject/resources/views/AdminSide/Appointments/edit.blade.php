@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-6 py-12">
    <h1 class="text-4xl font-bold text-gray-900 text-center">Edit Appointment</h1>

    <form action="{{ route('admin.appointments.update', $appointment->id) }}" method="POST" class="mt-8 max-w-md mx-auto">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-lg" value="{{ $appointment->name }}" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded-lg" value="{{ $appointment->email }}" required>
        </div>
        <div class="mb-4">
            <label for="date" class="block text-gray-700">Date</label>
            <input type="date" name="date" id="date" class="w-full px-4 py-2 border rounded-lg" value="{{ $appointment->date }}" required>
        </div>
        <div class="mb-4">
            <label for="time" class="block text-gray-700">Time</label>
            <input type="time" name="time" id="time" class="w-full px-4 py-2 border rounded-lg" value="{{ $appointment->time }}" required>
        </div>
        <div class="mb-4">
            <label for="consultation_type" class="block text-gray-700">Consultation Type</label>
            <input type="text" name="consultation_type" id="consultation_type" class="w-full px-4 py-2 border rounded-lg" value="{{ $appointment->consultation_type }}" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description</label>
            <textarea name="description" id="description" class="w-full px-4 py-2 border rounded-lg" required>{{ $appointment->description }}</textarea>
        </div>
        <div class="mb-4">
            <label for="status" class="block text-gray-700">Status</label>
            <select name="status" id="status" class="w-full px-4 py-2 border rounded-lg" required>
                <option value="Scheduled" {{ $appointment->status === 'Scheduled' ? 'selected' : '' }}>Scheduled</option>
                <option value="Completed" {{ $appointment->status === 'Completed' ? 'selected' : '' }}>Completed</option>
                <option value="Cancelled" {{ $appointment->status === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>
        <div class="text-center">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Update Appointment
            </button>
        </div>
    </form>
</div>
@endsection
