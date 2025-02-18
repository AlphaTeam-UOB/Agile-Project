@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <!-- Hero Section -->
    <div class="text-center mb-16 animate-fade-in">
        <h1 class="text-5xl font-extrabold text-gray-800 leading-tight transform transition duration-500 hover:scale-105">
            About Us
        </h1>
        <p class="mt-4 text-xl text-gray-600 max-w-3xl mx-auto animate-slide-up">
            A.A. Samarasinghe Optometrists has been dedicated to providing exceptional eye care services for over 20 years. We are committed to enhancing the quality of life for our patients with personalized, professional care.
        </p>
    </div>

    <!-- Mission & Services Section -->
    <div class="grid md:grid-cols-2 gap-12 mb-16">
        <!-- Image with Animation -->
        <div class="flex items-center justify-center animate-float">
            <img class="rounded-lg shadow-lg transform transition duration-500 hover:scale-105" src="{{ asset('images/image 2.jpg') }}" alt="Optometrists Team">
        </div>
        
        <!-- Mission & Services Content -->
        <div class="animate-slide-up">
            <h2 class="text-3xl font-semibold text-gray-800 mb-6 transform transition duration-500 hover:scale-105">
                Our Mission
            </h2>
            <p class="text-lg text-gray-700 mb-6">
                At A.A. Samarasinghe Optometrists, our mission is to provide the highest standard of eye care using the latest technology and techniques. Our goal is to empower you to achieve optimal vision and maintain eye health throughout your life.
            </p>
            <h2 class="text-3xl font-semibold text-gray-800 mb-6 transform transition duration-500 hover:scale-105">
                Our Services
            </h2>
            <ul class="list-disc pl-6 text-lg text-gray-700">
                <li class="mb-2 transform transition duration-300 hover:translate-x-2">Comprehensive Eye Exams</li>
                <li class="mb-2 transform transition duration-300 hover:translate-x-2">Contact Lens Fitting and Consultation</li>
                <li class="mb-2 transform transition duration-300 hover:translate-x-2">Prescription Glasses and Lenses</li>
                <li class="mb-2 transform transition duration-300 hover:translate-x-2">Emergency Eye Care</li>
                <li class="mb-2 transform transition duration-300 hover:translate-x-2">Management of Eye Conditions (e.g., Glaucoma, Cataracts)</li>
            </ul>
        </div>
    </div>

    <!-- Why Choose Us Section -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 py-16 text-center animate-fade-in">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6 transform transition duration-500 hover:scale-105">
            Why Choose Us?
        </h2>
        <p class="text-lg text-gray-600 mb-6 max-w-3xl mx-auto">
            With over two decades of experience, our team of optometrists is passionate about providing personalized care for all our patients. We use state-of-the-art equipment to ensure accurate diagnoses and offer a wide range of services tailored to meet your unique needs.
        </p>
        <a href="/contact" class="inline-block bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-lg font-semibold py-3 px-8 rounded-lg hover:from-blue-700 hover:to-indigo-700 transition duration-300 transform hover:scale-105">
            Get in Touch
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

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .animate-fade-in {
        animation: fade-in 1s ease-in-out;
    }

    .animate-slide-up {
        animation: slide-up 1s ease-in-out;
    }

    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
</style>