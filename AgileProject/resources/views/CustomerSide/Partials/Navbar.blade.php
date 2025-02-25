<header class="w-full top-0 z-50 shadow-md">
    <!-- Top Notice Bar -->
    <div class="bg-red-700 text-white text-center text-sm py-1">
        Open from 9:00 AM - 7:00 PM (Mon-Sat) | Call us: +94 77 123 4567
    </div>
    <div class="container mx-auto px-6 py-2 flex items-center justify-between bg-white bg-opacity-90 rounded-b-xl">
        <div class="flex items-center space-x-3">  
            <img src="{{ asset('images/logo.png') }}" alt="A.A. Samarasinghe Logo" class="h-12 w-auto">
            <span class="text-xl font-bold text-gray-900 tracking-wide uppercase">A.A. Samarasinghe</span>  
        </div>  
        <nav>
            <ul class="flex space-x-6 text-gray-800 font-semibold uppercase text-xs tracking-wider">
                <li><a href="{{ url('/') }}" class="hover:text-red-700 transition duration-300">Home</a></li>
                <li><a href="{{ url('/about') }}" class="hover:text-red-700 transition duration-300">About Us</a></li>
                <li><a href="{{ url('/contact') }}" class="hover:text-red-700 transition duration-300">Contact</a></li>
                <li><a href="{{ url('/products') }}" class="hover:text-red-700 transition duration-300">Products</a></li>
                <li>
                    <a href="{{ url('/appointments') }}" class="bg-red-700 text-white px-4 py-1.5 rounded-full shadow-md hover:bg-red-800 transition duration-300">
                        Schedule Appointment
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>
