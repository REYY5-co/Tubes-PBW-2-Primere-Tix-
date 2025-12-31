<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Akun Saya | PrimeTIX</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/akun.css') }}">
</head>
<body>

<!-- HEADER -->
<div class="header">
    <div class="flex items-center space-x-3">
        <a href="{{ route('homepage') }}">
            <img src="{{ asset('image/PrimeTIX.png') }}" class="logo" alt="PrimeTIX">
        </a>
    </div>

    <div class="flex items-center space-x-5">
        <div class="flex items-center space-x-3 bg-white/80 px-4 py-2 rounded-full shadow">
            <img src="{{ auth()->user()->avatar
                ? asset('storage/' . auth()->user()->avatar)
                : asset('images/avatar-default.png') }}"
                class="w-10 h-10 rounded-full object-cover border" alt="Avatar">
            <div class="leading-tight">
                <p class="font-bold text-sm text-gray-800">{{ auth()->user()->name }}</p>
                <p class="text-xs text-gray-600">{{ auth()->user()->email }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</div>

<!-- PROFIL CARD -->
<div class="container mt-10">
    <div class="card">
        <h2 class="text-xl font-bold mb-1">{{ auth()->user()->name }}</h2>
        <p class="text-gray-600 mb-5">{{ auth()->user()->email }}</p>
        <a href="{{ route('akun.edit') }}" class="btn">Edit Akun</a>
    </div>
</div>

<!-- RIWAYAT TRANSAKSI -->
<div class="container mt-10">
    <h2 class="text-2xl font-bold mb-6">Riwayat Transaksi</h2>

    @if($transactions->isEmpty())
        <p class="text-gray-500">Belum ada tiket yang dibeli.</p>
    @else
        @foreach($transactions as $t)
        <div class="card ticket-card">
            <img src="{{ asset('image/JUMBO.jpg') }}" alt="JUMBO">

            <div class="ticket-details">
                <p class="font-bold text-lg">JUMBO</p>
                <p class="text-sm text-gray-600">
                    {{ $t->showtime->schedule->cinema->name ?? '-' }} - Studio {{ $t->showtime->studio->name ?? '-' }}
                </p>
                <p class="text-sm text-gray-600">
                    {{ \Carbon\Carbon::parse($t->showtime->schedule->date)->format('d M Y') }} • {{ $t->showtime->time }}
                </p>

                @php
                    $seats = is_array($t->selected_seats) ? $t->selected_seats : json_decode($t->selected_seats, true);
                @endphp
                @if(!empty($seats))
                    <p class="text-sm text-gray-600">Kursi: {{ implode(', ', $seats) }}</p>
                @endif

                <div class="border-top mt-2">
                    <div class="flex justify-between text-sm">
                        <span>Total Tiket</span>
                        <span>Rp{{ number_format($t->total_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between font-bold mt-2">
                        <span>Status</span>
                        <span class="ticket-status">{{ ucfirst($t->status) }}</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @endif
</div>

<footer class="mt-16 text-center text-sm text-gray-500">
    © 2025 PrimeTIX.
</footer>

</body>
</html>
