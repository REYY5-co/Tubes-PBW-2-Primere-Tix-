<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pembayaran | PrimeTIX</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/payment_status.css') }}">
</head>

<body>

    <div class="container">
        <div class="card">
            <h2>Status Pembayaran</h2>
            <div class="line"></div>

            <p><strong>Order ID:</strong> {{ $orderId }}</p>
            <p><strong>Status:</strong> {{ strtoupper($status) }}</p>

            @if($order)
                <hr>

                <p><strong>Film:</strong> {{ $order['movie'] }}</p>
                <p><strong>Bioskop:</strong> {{ $order['cinema'] }}</p>
                <p><strong>Tanggal:</strong> {{ $order['date'] }}</p>
                <p><strong>Jam:</strong> {{ $order['time'] }}</p>
                <p><strong>Kursi:</strong> {{ implode(', ', $order['seats']) }}</p>
                <p><strong>Total:</strong>
                    Rp{{ number_format($order['total_amount'],0,',','.') }}
                </p>
            @endif

            <a href="{{ route('homepage') }}" class="btn">
                Kembali ke Beranda
            </a>
        </div>
    </div>

</body>
</html>
