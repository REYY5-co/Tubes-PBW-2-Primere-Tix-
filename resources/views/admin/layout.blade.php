<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel - PrimeTIX</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-black text-white px-6 py-4 flex justify-between">
        <span class="font-bold">PrimeTIX Admin</span>
        <a href="{{ route('logout') }}" class="text-sm">Logout</a>
    </nav>

    <!-- Content -->
    <main class="p-8">
        @yield('content')
    </main>

</body>

</html>