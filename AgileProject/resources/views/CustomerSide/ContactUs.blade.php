@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <!-- Hero Section -->
    <div class="text-center mb-16 animate-fade-in">
        <h1 class="text-5xl font-extrabold text-gray-900 leading-tight transform transition duration-500 hover:scale-105">
            Contact Us
        </h1>
        <p class="mt-4 text-xl text-gray-700 max-w-2xl mx-auto animate-slide-up">
            We're here to help! Whether you have questions about our services, need to schedule an appointment, or just want to say hello, we'd love to hear from you. Reach out to us via email, phone, or visit us in person.
        </p>
    </div>

    <!-- Contact Information Section -->
    <div class="grid md:grid-cols-2 gap-12 mb-16">
        <!-- Contact Details -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-8 rounded-lg shadow-lg animate-slide-up">
            <h2 class="text-3xl font-semibold text-gray-800 mb-6 transform transition duration-500 hover:scale-105">
                Get in Touch
            </h2>
            <div class="space-y-6">
                <div class="flex items-center space-x-4">
                    <div class="bg-blue-600 p-3 rounded-full text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-lg text-gray-700">Email:</p>
                        <a href="mailto:info@optometrists.com" class="text-blue-600 hover:text-blue-700 transition duration-300">info@optometrists.com</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="bg-blue-600 p-3 rounded-full text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-lg text-gray-700">Phone:</p>
                        <a href="tel:+94771234567" class="text-blue-600 hover:text-blue-700 transition duration-300">+94 77 123 4567</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="bg-blue-600 p-3 rounded-full text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-lg text-gray-700">Address:</p>
                        <p class="text-gray-600">123 Eye Care Street, Colombo, Sri Lanka</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="bg-white p-8 rounded-lg shadow-lg animate-slide-up">
            <h2 class="text-3xl font-semibold text-gray-800 mb-6 transform transition duration-500 hover:scale-105">
                Send Us a Message
            </h2>
            <form action="#" method="POST">
                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-lg font-medium text-gray-700">Name</label>
                        <input type="text" id="name" name="name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label for="email" class="block text-lg font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label for="message" class="block text-lg font-medium text-gray-700">Message</label>
                        <textarea id="message" name="message" rows="5" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required></textarea>
                    </div>
                    <div>
                        <button type="submit" class="w-full bg-blue-600 text-white text-lg font-semibold py-3 px-8 rounded-lg hover:bg-blue-700 transition duration-300 transform hover:scale-105">
                            Send Message
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Map Section -->
    <div class="mb-16 animate-fade-in">
        <h2 class="text-3xl font-semibold text-gray-800 text-center mb-6 transform transition duration-500 hover:scale-105">
            Find Us on the Map
        </h2>
        <div class="rounded-lg overflow-hidden shadow-lg">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.798511757687!2d79.8529754153931!3d6.921682495003858!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2596b5c3b4b0d%3A0x6b7e5f9a9b9b9b9b!2sColombo%2C%20Sri%20Lanka!5e0!3m2!1sen!2sus!4v1621234567890!5m2!1sen!2sus" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>

    <!-- Call to Action Section -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 py-12 text-center animate-fade-in">
        <h2 class="text-3xl font-semibold text-white mb-6 transform transition duration-500 hover:scale-105">
            Ready to Schedule an Appointment?
        </h2>
        <p class="text-lg text-white mb-6 max-w-3xl mx-auto">
            Book your eye care appointment today and experience the best in personalized, professional care.
        </p>
        <a href="/appointment" class="inline-block bg-white text-blue-600 text-lg font-semibold py-3 px-8 rounded-lg hover:bg-gray-100 transition duration-300 transform hover:scale-105">
            Book Now
        </a>
    </div>
</div>
@endsection

<!-- Add Custom Animations -->
<style>
    @keyframes fade-in {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }

    @keyframes slide-up {
        0% { transform: translateY(20px); opacity: 0; }
        100% { transform: translateY(0); opacity: 1; }
    }

    .animate-fade-in {
        animation: fade-in 1s ease-in-out;
    }

    .animate-slide-up {
        animation: slide-up 1s ease-in-out;
    }
</style>