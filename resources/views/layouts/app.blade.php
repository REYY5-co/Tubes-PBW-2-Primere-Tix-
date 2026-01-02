<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'PrimeTIX')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    @stack('styles')
</head>
<body class="bg-white min-h-screen">

    {{-- NAVBAR GLOBAL --}}
    @include('components.navbar')

    {{-- ISI HALAMAN --}}
    <main class="px-6 py-8">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
