@extends('layouts.admin')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold mb-6 text-center">Admin Profile</h2>
        <form action="{{ route('admin.profile.update') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-lg">Name</label>
                <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-md" value="Admin Name" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-lg">Email</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-md" value="admin@example.com" required>
            </div>
            <button type="submit" class="w-full py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Update Profile</button>
        </form>
    </div>
@endsection
