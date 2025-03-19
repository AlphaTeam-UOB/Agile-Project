<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>A.A. Samarasinghe Optometrists</title>
    <!-- Favicon for Browser Tab -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Add Toastify CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

<!-- Add Toastify JS -->
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

</head>
<body class="bg-gray-50 font-[Poppins,sans-serif] flex flex-col min-h-screen">

    @include('CustomerSide.partials.navbar')

    <main class="flex-grow mt-16">
        @yield('content')
    </main>

    @include('CustomerSide.partials.footer')

</body>

</html>
