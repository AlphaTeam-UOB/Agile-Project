@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <h1 class="text-4xl font-bold text-gray-900 text-center">Our Products</h1>
    <p class="mt-4 text-lg text-gray-700 text-center">
        Explore our wide range of eyewear and contact lenses.
    </p>

    <!-- Filter Options -->
    <div class="mt-8 flex justify-center space-x-4">
        <button class="filter-btn bg-blue-500 text-white px-4 py-2 rounded" data-filter="all">All</button>
        <button class="filter-btn bg-blue-500 text-white px-4 py-2 rounded" data-filter="eyeglasses-men">Men's Glasses</button>
        <button class="filter-btn bg-blue-500 text-white px-4 py-2 rounded" data-filter="eyeglasses-women">Women's Glasses</button>
        <button class="filter-btn bg-blue-500 text-white px-4 py-2 rounded" data-filter="eyeglasses-kids">Kids' Glasses</button>
        <button class="filter-btn bg-blue-500 text-white px-4 py-2 rounded" data-filter="lenses">Lenses</button>
        <button class="filter-btn bg-blue-500 text-white px-4 py-2 rounded" data-filter="contact-lenses">Contact Lenses</button>
    </div>

    <!-- Product Grid -->
    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <!-- Men's Glasses -->
        @foreach(['mens1.jpg', 'mens2.jpg', 'mens3.jpg', 'mens4.jpg', 'mens5.jpg', 'mens6.jpg', 'mens7.jpg', 'mens8.jpg'] as $image)
        <div class="product-item eyeglasses-men bg-white p-4 rounded shadow">
            <img src="{{ asset('images/men/' . $image) }}" alt="Men's Glasses" class="w-full h-40 object-cover rounded">
            <h2 class="mt-2 text-lg font-semibold">Men's Eyeglasses</h2>
            <p class="text-gray-600">$99.99</p>
        </div>
        @endforeach

        <!-- Women's Glasses -->
        @foreach(['w1.jpg', 'w2.jpg', 'w3.jpg', 'w4.jpg', 'w5.jpg', 'w6.jpg', 'w7.jpg', 'w8.jpg'] as $image)
        <div class="product-item eyeglasses-women bg-white p-4 rounded shadow">
            <img src="{{ asset('images/women/' . $image) }}" alt="Women's Glasses" class="w-full h-40 object-cover rounded">
            <h2 class="mt-2 text-lg font-semibold">Women's Eyeglasses</h2>
            <p class="text-gray-600">$89.99</p>
        </div>
        @endforeach

        <!-- Kids' Glasses -->
        @foreach(['c1.jpg', 'c2.jpg', 'c3.jpg', 'c4.jpg', 'c5.jpg', 'c6.jpg', 'c7.jpg', 'c8.jpg'] as $image)
        <div class="product-item eyeglasses-kids bg-white p-4 rounded shadow">
            <img src="{{ asset('images/kids/' . $image) }}" alt="Kids' Glasses" class="w-full h-40 object-cover rounded">
            <h2 class="mt-2 text-lg font-semibold">Kids' Eyeglasses</h2>
            <p class="text-gray-600">$79.99</p>
        </div>
        @endforeach

        <!-- Lenses -->
        @foreach(['l1.jpg', 'l2.jpg', 'l3.jpg', 'l4.jpg'] as $image)
        <div class="product-item lenses bg-white p-4 rounded shadow">
            <img src="{{ asset('images/Lenses/' . $image) }}" alt="Lenses" class="w-full h-40 object-cover rounded">
            <h2 class="mt-2 text-lg font-semibold">Lenses</h2>
            <p class="text-gray-600">$49.99</p>
        </div>
        @endforeach

        <!-- Contact Lenses -->
        @foreach(['a1.jpg', 'a2.jpg', 'a3.jpg', 'a4.jpg', 'a5.jpg', 'a6.jpg', 'a7.jpg', 'a8.jpg'] as $image)
        <div class="product-item contact-lenses bg-white p-4 rounded shadow">
            <img src="{{ asset('images/contact_lenses/' . $image) }}" alt="Contact Lenses" class="w-full h-40 object-cover rounded">
            <h2 class="mt-2 text-lg font-semibold">Contact Lenses</h2>
            <p class="text-gray-600">$59.99</p>
        </div>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const buttons = document.querySelectorAll(".filter-btn");
        const products = document.querySelectorAll(".product-item");

        buttons.forEach(button => {
            button.addEventListener("click", () => {
                const filter = button.getAttribute("data-filter");

                // Update button styles
                buttons.forEach(btn => btn.classList.remove("bg-blue-500", "text-white"));
                button.classList.add("bg-blue-500", "text-white");

                // Filter products
                products.forEach(product => {
                    if (filter === "all" || product.classList.contains(filter)) {
                        product.style.display = "block";
                    } else {
                        product.style.display = "none";
                    }
                });
            });
        });
    });
</script>
@endsection
