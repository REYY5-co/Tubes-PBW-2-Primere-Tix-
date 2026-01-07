<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran | PrimeTIX</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">

    <!-- Midtrans -->
    <script
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}">
    </script>
</head>

<body class="bg-gray-100 font-[Poppins]">

<header class="flex justify-between items-center px-10 py-6 bg-white shadow-sm">
    <a href="{{ url('/') }}">
        <img src="{{ asset('image/PrimeTIX.png') }}" style="height:18px;">
    </a>

    @auth
        <a href="{{ route('akun') }}" class="flex items-center space-x-3">
            <img
                src="{{ auth()->user()->avatar
                    ? asset('storage/' . auth()->user()->avatar)
                    : asset('images/avatar-default.png') }}"
                class="w-10 h-10 rounded-full object-cover border">
            <span class="text-sm font-semibold">{{ auth()->user()->name }}</span>
        </a>
    @else
        <a href="{{ route('login') }}" class="px-4 py-2 border rounded-full text-sm">
            Login
        </a>
    @endauth
</header>

<div class="container mx-auto mt-6 px-6">

    <a href="{{ url()->previous() }}" class="flex items-center text-gray-600 hover:text-gray-800 mb-6">
        ← Kembali ke Pilih Kursi
    </a>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        <!-- METODE PEMBAYARAN -->
        <div class="md:col-span-2">
            <h2 class="text-lg font-semibold mb-4">Pilih Metode Pembayaran</h2>

            <div class="bg-white rounded-lg p-4 shadow">
                <label class="flex items-center cursor-pointer">
                    <input type="radio" checked class="mr-3">
                    <span class="text-sm font-medium">Midtrans</span>
                </label>
            </div>
        </div>

        <!-- DETAIL PESANAN -->
        <div>
            <h2 class="text-lg font-semibold mb-4">Detail Pesanan</h2>

            <div class="bg-white rounded-lg p-4 shadow">

                <div class="flex mb-4">
                    <div class="w-16 h-24 mr-4">
                        <!-- ✅ FIX POSTER DI SINI -->
                        <img
                            src="{{ $order['poster']
                                ? asset('storage/' . $order['poster'])
                                : asset('images/default.jpg') }}"
                            class="w-full h-full object-cover rounded">
                    </div>

                    <div class="flex-1 text-sm text-gray-700">
                        <p class="font-bold text-base">{{ $order['movie'] }}</p>
                        <p>{{ $order['cinema'] }}</p>
                        <p>{{ $order['date'] }}</p>
                        <p>Jam: {{ $order['time'] }}</p>

                        <p class="mt-2 font-semibold">
                            Kursi: {{ implode(', ', $order['seats']) }}
                        </p>
                    </div>
                </div>

                <div class="border-t border-b py-3 text-sm">
                    <div class="flex justify-between">
                        <span>Tiket</span>
                        <span>
                            {{ $order['ticket_qty'] }} ×
                            Rp{{ number_format($order['price_per_ticket'],0,',','.') }}
                        </span>
                    </div>
                    <div class="flex justify-between font-semibold mt-1">
                        <span>Subtotal</span>
                        <span>
                            Rp{{ number_format($order['total_amount'],0,',','.') }}
                        </span>
                    </div>
                </div>

                <div class="flex justify-between pt-4 font-bold">
                    <span>Total</span>
                    <span>
                        Rp{{ number_format($order['total_amount'],0,',','.') }}
                    </span>
                </div>

                @guest
                    <button
                        onclick="alert('Silakan login terlebih dahulu'); window.location.href='{{ route('login') }}';"
                        class="mt-6 w-full bg-gray-400 text-white py-3 rounded-lg">
                        Bayar
                    </button>
                @else
                    <button id="payBtn"
                        class="mt-6 w-full bg-black text-white py-3 rounded-lg hover:bg-gray-800">
                        Bayar
                    </button>
                @endguest
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('payBtn')?.addEventListener('click', function () {

    fetch("{{ route('payment.process') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        }
    })
    .then(res => res.json())
    .then(data => {
        snap.pay(data.snap_token, {
            onSuccess: () => window.location.href =
                "{{ route('payment.status') }}?transaction_status=settlement",

            onPending: () => window.location.href =
                "{{ route('payment.status') }}?transaction_status=pending",

            onError: () => window.location.href =
                "{{ route('payment.status') }}?transaction_status=error",
        });
    })
    .catch(() => alert('Terjadi kesalahan'));
});
</script>

</body>
</html>
