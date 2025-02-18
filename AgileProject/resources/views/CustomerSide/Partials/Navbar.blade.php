<header class="w-full top-0 z-50 shadow-md">
     <!-- Top Notice Bar -->
     <div class="bg-red-700 text-white text-center text-sm py-2">
        Open from 9:00 AM - 7:00 PM (Mon-Sat) | Call us: +94 77 123 4567
    </div>
    <div class="container mx-auto px-6 py-4 flex items-center justify-between bg-white bg-opacity-90 rounded-b-xl">
        
        <div class="flex items-center space-x-3">
            <span class="text-red-700 text-4xl"><i class="fas fa-eye"></i></span>
            <span class="text-2xl font-bold text-gray-900 tracking-wide uppercase">A.A. Samarasinghe</span>
        </div>
        <nav>
            <ul class="flex space-x-8 text-gray-800 font-semibold uppercase text-sm tracking-wider">
                <li><a href="{{ url('/') }}" class="hover:text-red-700 transition duration-300">Home</a></li>
                <li><a href="{{ url('/about') }}" class="hover:text-red-700 transition duration-300">About Us</a></li>
                <li><a href="{{ url('/contact') }}" class="hover:text-red-700 transition duration-300">Contact</a></li>
                <li><a href="{{ url('/products') }}" class="hover:text-red-700 transition duration-300">Products</a></li>
                <li>
                    <a href="{{ url('/appointments') }}" class="bg-red-700 text-white px-5 py-2 rounded-full shadow-md hover:bg-red-800 transition duration-300">
                        Schedule Appointment
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>
