@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-6 py-12">
    <h1 class="text-4xl font-bold text-gray-900 text-center">Create Appointment</h1>

    <form action="{{ route('admin.appointments.store') }}" method="POST" class="mt-8 max-w-md mx-auto">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-lg" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded-lg" required>
        </div>
        <div class="mb-4">
            <label for="date" class="block text-gray-700">Date</label>
            <input type="date" name="date" id="date" class="w-full px-4 py-2 border rounded-lg" required>
        </div>
        <div class="mb-4">
            <label for="time" class="block text-gray-700">Time</label>
            <input type="time" name="time" id="time" class="w-full px-4 py-2 border rounded-lg" required>
        </div>
        <div class="mb-4">
            <label class="block text-lg font-semibold text-gray-700 mt-4">Type of Consultation</label>
            <select name="consultation_type" required class="w-full p-2 border border-gray-300 rounded-lg mt-2">
                <option value="">Select Consultation Type</option>
                <option value="General Checkup">General Checkup</option>
                <option value="Eye Examination">Eye Examination</option>
                <option value="Contact Lens Fitting">Contact Lens Fitting</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description</label>
            <textarea name="description" id="description" class="w-full px-4 py-2 border rounded-lg" ></textarea>
        </div>
        <div class="mb-4">
            <label for="status" class="block text-gray-700">Status</label>
            <select name="status" id="status" class="w-full px-4 py-2 border rounded-lg" required>
                <option value="Scheduled">Scheduled</option>
                <option value="Completed">Completed</option>
                <option value="Cancelled">Cancelled</option>
            </select>
        </div>
        <div class="text-center">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Create Appointment
            </button>
        </div>
    </form>
</div>
@endsection
