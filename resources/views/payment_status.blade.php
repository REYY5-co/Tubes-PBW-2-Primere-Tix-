<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pembayaran</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/payment_status.css') }}">
</head>

<body>

    <div class="navbar">PrimeTIX</div>
    <div class="circle"></div>

    <div class="container">
        <div class="card">
            <h2>Status Pembayaran</h2>
            <div class="line"></div>

            <p>Order ID: {{ $orderId }}</p>
            <p>Status: {{ strtoupper($status) }}</p>

            @if(!empty($order))
                <p>Film: {{ $order['movie'] }}</p>
                <p>Bioskop: {{ $order['cinema'] }}</p>
                <p>Tanggal: {{ $order['date'] }}</p>
                <p>Kursi: {{ implode(', ', $order['seats']) }}</p>
                <p>Total: Rp{{ number_format($order['total_amount'],0,',','.') }}</p>
            @endif

            <a href="{{ route('homepage') }}" class="btn">Kembali ke Beranda</a>
        </div>
    </div>

</body>
</html>
