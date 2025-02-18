<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A.A. Samarasinghe Optometrists</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-[Poppins,sans-serif] flex flex-col min-h-screen">

    @include('CustomerSide.partials.navbar')

    <main class="flex-grow mt-16">
        @yield('content')
    </main>

    @include('CustomerSide.partials.footer')

</body>

</html>
