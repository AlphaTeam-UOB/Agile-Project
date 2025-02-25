@extends('layouts.admin')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold mb-6 text-center">Admin Profile</h2>

        <!-- Display Success Message if Available -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-2 mb-4 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <!-- Profile Update Form -->
        <form action="{{ route('admin.profile.update') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-lg">Name</label>
                <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-md" value="{{ old('name', $admin->name) }}" required>
                @error('name')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-lg">Email</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-md" value="{{ old('email', $admin->email) }}" required>
                @error('email')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-lg">New Password (Leave empty to keep current)</label>
                <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-md">
                @error('password')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-lg">Confirm New Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-2 border rounded-md">
            </div>

            <button type="submit" class="w-full py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Update Profile</button>
        </form>
    </div>
@endsection
