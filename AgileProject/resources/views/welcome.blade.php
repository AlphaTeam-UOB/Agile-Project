<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A.A. Samarasinghe Optometrists</title>
<!-- Favicon for Browser Tab -->
<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Swiper.js (For Image Slider) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">

    <style>
        .swiper-slide {
    position: relative; /* Ensures images don't overlap text */
    z-index: 0;
}

.text-container {
    position: relative;
    z-index: 10;
}

        @keyframes fade-in {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fade-in 1s ease-in-out; }
        .delay-200 { animation-delay: 0.2s; }
        .slider-container { height: 70vh; }
        .swiper-slide {
            background-size: cover;
            background-position: center;
            height: 70vh;
        }
    </style>
</head>
<body class="bg-gray-50 font-[Poppins,sans-serif]">

    <!-- Include Navbar -->
    @include('CustomerSide.partials.navbar')

    <!-- Hero Section with Image Slider -->
    <div class="relative w-full slider-container">
        <div class="swiper mySwiper w-full h-full">
            <div class="swiper-wrapper">
                <!-- Image Slides -->
                <div class="swiper-slide" style="background-image: url('{{ asset('images/image 1.jpg') }}');"></div>
                <div class="swiper-slide" style="background-image: url('{{ asset('images/image 2.jpg') }}');"></div>
                <div class="swiper-slide" style="background-image: url('{{ asset('images/image 3.jpg') }}');"></div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        <div class="absolute inset-0 flex items-center justify-center text-center bg-black/40 z-10">

            <div class="text-white px-6 max-w-2xl">
                <h1 class="text-5xl font-extrabold mb-4 animate-fade-in tracking-widest uppercase">Your Vision, Our Priority</h1>
                <p class="text-lg mb-6 animate-fade-in delay-200 tracking-wide">Providing expert eye care solutions with precision and care.</p>
                <a href="{{ url('/services') }}" class="bg-white text-red-700 px-6 py-3 rounded-full text-lg font-semibold shadow-lg hover:bg-gray-200 transition">Discover More</a>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <section class="py-12 px-6 text-center">
        <h2 class="text-3xl font-bold text-gray-900">Why Choose Us?</h2>
        <p class="text-gray-700 mt-4">We offer expert eye care services with the latest technology and a dedicated team.</p>
        <div class="mt-8 grid md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-900">Comprehensive Eye Exams</h3>
                <p class="text-gray-700 mt-2">Thorough vision and eye health assessments to ensure optimal vision.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-900">Stylish Eyewear Collection</h3>
                <p class="text-gray-700 mt-2">Trendy and comfortable glasses suited for all ages.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-900">Advanced Contact Lens Fitting</h3>
                <p class="text-gray-700 mt-2">Custom contact lenses to fit your unique needs.</p>
            </div>
        </div>
    </section>

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

    <!-- Include Footer -->
    @include('CustomerSide.partials.footer')

    <!-- Swiper.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            loop: true,
            autoplay: { delay: 3000, disableOnInteraction: false },
            pagination: { el: ".swiper-pagination", clickable: true },
            navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" }
        });
    </script>
</body>
</html>
