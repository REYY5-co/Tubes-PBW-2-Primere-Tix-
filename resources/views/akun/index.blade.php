<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Akun Saya</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            margin: 0;
            font-family: poppins, sans-serif;
            background: #f1f5f9;
            cursor: url("{{ asset('images/cursor-popcorn.png') }}") 16 16, auto;
        }

        .header {
            height: 220px;
            padding: 20px 40px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 0.6)),
                url("{{ asset('images/cinema-images.jpg') }}");
            background-size: cover;
            background-position: center;
        }

        .logout-btn {
            background: #dc2626;
            color: white;
            padding: 8px 18px;
            border-radius: 999px;
            border: none;
            font-weight: bold;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: #b91c1c;
        }

        .container {
            max-width: 900px;
            margin: -40px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 999px;
            background: #4b5563;
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>

<!-- ================= HEADER ================= -->
<div class="header">

    <!-- KIRI: LOGO -->
    <div class="flex items-center space-x-3">
        <img src="{{ asset('images/primetix-logo.png') }}"
             alt="PrimeTIX"
             class="h-9">
    </div>

    <!-- KANAN: PROFIL + LOGOUT -->
    <div class="flex items-center space-x-5">

        <!-- PROFIL -->
        <div class="flex items-center space-x-3 bg-white/80 px-4 py-2 rounded-full shadow">
            <img
                src="{{ auth()->user()->avatar
                    ? asset('storage/' . auth()->user()->avatar)
                    : asset('images/avatar-default.png') }}"
                class="w-10 h-10 rounded-full object-cover border"
                alt="Avatar">

            <div class="leading-tight">
                <p class="font-bold text-sm text-gray-800">
                    {{ auth()->user()->name }}
                </p>
                <p class="text-xs text-gray-600">
                    {{ auth()->user()->email }}
                </p>
            </div>
        </div>

        <!-- LOGOUT -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                Logout
            </button>
        </form>

    </div>
</div>

<!-- ================= AKUN CARD ================= -->
<div class="container">
    <div class="card">
        <h2 class="text-xl font-bold mb-1">
            {{ auth()->user()->name }}
        </h2>
        <p class="text-gray-600 mb-5">
            {{ auth()->user()->email }}
        </p>

        <a href="{{ route('akun.edit') }}" class="btn">
            Edit Akun
        </a>
    </div>
</div>

<!-- ================= TRANSAKSI & TIKET ================= -->
<main class="max-w-7xl mx-auto px-6 mt-16">

    <!-- Container fleksibel, Tiket Aktif di tengah -->
    <div class="flex flex-col lg:flex-row lg:space-x-6 space-y-10 lg:space-y-0 justify-center">

        {{-- 
        <!-- TRANSAKSI -->
        <div class="lg:w-1/2">
            <h2 class="text-xl font-bold mb-4 border-b pb-2">Daftar Transaksi</h2>

            <div class="bg-white p-4 rounded-xl shadow-lg">
                <div class="flex space-x-4 mb-4">
                    <img src="{{ asset('images/jumbo-film.jpg') }}"
                         class="rounded-lg w-20 h-28 object-cover shadow">

                    <div>
                        <p class="font-bold text-lg">Jumbo</p>
                        <p class="text-sm text-gray-600">BDG XXI – Studio 3</p>
                        <p class="text-sm text-gray-600">Rabu, 20 Okt 2025 • 14.30</p>
                    </div>
                </div>

                <div class="border-t pt-3">
                    <div class="flex justify-between text-sm">
                        <span>Tiket E6</span>
                        <span>Rp40.000</span>
                    </div>
                    <div class="flex justify-between font-bold mt-2">
                        <span>Total</span>
                        <span class="text-red-600">Rp40.000</span>
                    </div>
                </div>

                <button class="w-full mt-4 py-2 bg-gray-800 text-white rounded-lg">
                    Selesai
                </button>
            </div>
        </div>
        --}}

        <!-- RIWAYAT TRANSAKSI -->
        <div class="lg:w-1/2">
            <h2 class="text-xl font-bold mb-4 border-b pb-2">Riwayat Transaksi</h2>

            <div class="bg-white p-4 rounded-xl shadow-lg border border-green-400">
                <div class="flex space-x-4 mb-4">
                    <img src="{{ asset('images/jumbo-film.jpg') }}"
                         class="rounded-lg w-20 h-28 object-cover shadow">

                    <div>
                        <p class="font-bold text-lg">Jumbo</p>
                        <p class="text-sm text-gray-600">BDG XXI – Studio 3</p>
                        <p class="text-sm text-gray-600">Rabu, 20 Okt 2025 • 14.30</p>
                    </div>
                </div>

                <div class="border-t pt-3">
                    <div class="flex justify-between text-sm">
                        <span>Tiket E6</span>
                        <span>Rp40.000</span>
                    </div>
                    <div class="flex justify-between font-bold mt-2">
                        <span>Total</span>
                        <span class="text-red-600">Rp40.000</span>
                    </div>
                </div>

               <a href="{{ route('homepage') }}"
                  class="block text-center w-full mt-4 py-2 bg-green-600 text-white rounded-lg">
                    KEMBALI KE HOME
                </a>

            </div>
        </div>

    </div>
</main>

<footer class="mt-16 text-center text-sm text-gray-500">
    © 2025 PrimeTIX. Hak Cipta Dilindungi.
</footer>

</body>
</html>
