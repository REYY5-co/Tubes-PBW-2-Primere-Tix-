<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran | PrimeTIX</title>
    <!-- Google Fonts: Poppins -->
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

<body class="bg-gray-100">

<header class="flex justify-between items-center px-10 py-6 bg-white shadow-sm">
    <!-- Logo PrimeTIX -->
    <a href="{{ url('/') }}">
        <img src="{{ asset('image/PrimeTIX.png') }}" class="logo" style="height:18px; width:auto;">
    </a>

    <!-- Profile / Login -->
    @auth
    <a href="{{ route('akun') }}" class="flex items-center space-x-3">
        <img src="{{ auth()->user()?->avatar 
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

<div class="container mx-auto mt-6">
    <a href="{{ url()->previous() }}" class="flex items-center text-gray-600 hover:text-gray-800 mb-6">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Kembali ke Pilih Kursi
    </a>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 checkout-grid">

        <!-- METODE PEMBAYARAN -->
        <div class="md:col-span-2">
            <h2 class="text-lg font-semibold mb-4 text-gray-800">Pilih Metode Pembayaran</h2>
            <div class="card">
                <label class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 mb-2">
                    <input type="radio" name="payment_method" value="midtrans" checked class="form-radio h-4 w-4 text-indigo-600">
                    <span class="ml-3 text-sm font-medium text-gray-700">Midtrans</span>
                </label>
            </div>
        </div>

        <!-- DETAIL PESANAN -->
        <div class="order-summary md:col-span-1">
            <h2 class="text-lg font-semibold mb-4 text-gray-800">Detail Pesanan</h2>
            <div class="card">
                <div class="flex mb-4">
                    <div class="w-16 h-24 mr-4 flex-shrink-0">
                        <img src="{{ asset('image/' . ($order['poster'] ?? 'default.jpg')) }}" 
                             alt="{{ $order['movie'] }}" class="w-full h-full object-cover rounded">
                    </div>

                    <div class="flex-1">
                        <p class="font-bold text-gray-800">{{ $order['movie'] }}</p>
                        <div class="text-sm text-gray-600 mt-1">
                            <p>{{ $order['cinema'] }}</p>
                            <p>{{ $order['date'] }}</p>
                            <p class="mt-1 font-semibold">Kursi: {{ implode(', ', $order['seats']) }}</p>
                        </div>
                    </div>
                </div>

                <div class="py-4 border-t border-b border-gray-200 text-sm">
                    <div class="flex justify-between mb-1">
                        <span class="text-gray-600">Tiket</span>
                        <span class="text-gray-800">
                            {{ $order['ticket_qty'] }} × Rp{{ number_format($order['price_per_ticket'],0,',','.') }}
                        </span>
                    </div>
                    <div class="flex justify-between font-medium">
                        <span>Subtotal</span>
                        <span>Rp{{ number_format($order['total_amount'],0,',','.') }}</span>
                    </div>
                </div>

                <div class="flex justify-between pt-4 text-base font-bold">
                    <span>Total</span>
                    <span>Rp{{ number_format($order['total_amount'],0,',','.') }}</span>
                </div>

                <button id="payBtn" class="mt-6 w-full bg-black text-white py-3 rounded-lg hover:bg-gray-800">
                    Bayar
                </button>
            </div>
        </div>

    </div>
</div>

<script>
document.getElementById('payBtn').onclick = function () {
    const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;

    fetch("{{ route('payment.process') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ payment_method: paymentMethod })
    })
    .then(res => res.json())
    .then(data => {
        if (data.snap_token) {
            snap.pay(data.snap_token, {
                onSuccess: function(result){
                    window.location.href = "{{ route('payment.status') }}?status=success";
                },
                onPending: function(result){
                    window.location.href = "{{ route('payment.status') }}?status=pending";
                },
                onError: function(result){
                    window.location.href = "{{ route('payment.status') }}?status=error";
                },
                onClose: function(){
                    alert("Anda menutup popup pembayaran.");
                }
            });
        }
    })
    .catch(() => alert("Terjadi kesalahan koneksi."));
};
</script>

</body>
</html>
