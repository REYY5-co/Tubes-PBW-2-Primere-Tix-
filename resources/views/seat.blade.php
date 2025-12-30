<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PrimeTIX - Pilih Kursi</title>
    <link rel="stylesheet" href="{{ asset('css/seat.css') }}">
</head>
<body>

<!-- NAVBAR -->
<header class="navbar">
    <img src="{{ asset('image/PrimeTIX.png') }}" class="logo">
    <div class="profile"></div>
</header>

<main class="container">

    <!-- TITLE (DI LUAR BACKGROUND ABU) -->
   <h2 class="page-title">
    {{ strtoupper(optional($showtime->schedule->cinema)->name) }}
    – {{ optional($showtime->studio)->name }}
</h2>



    <!-- BACKGROUND ABU (HANYA LAYAR & KURSI) -->
    <section class="seat-area">

        <!-- SCREEN -->
        <div class="screen">LAYAR</div>
  

        <!-- SEATS -->
<div class="seats-wrapper">

    <!-- LEFT (3 KURSI) -->
    <div class="seat-grid">
        @for ($i = 1; $i <= 3; $i++)
            <div class="seat">{{ $i }}</div>
        @endfor
    </div>

    <!-- JARAK -->
    <div class="aisle"></div>

    <!-- RIGHT (3 KURSI) -->
    <div class="seat-grid">
        @for ($i = 4; $i <= 6; $i++)
            <div class="seat">{{ $i }}</div>
        @endfor
    </div>

</div>

    </section>

    <!-- BUTTONS (DI LUAR BACKGROUND) -->
    <div class="action-buttons">
        <button id="btn-reset">Hapus</button>
        <button id="btn-save">Simpan</button>
    </div>

</main>
 

<script>

/* PILIH KURSI */
document.querySelectorAll('.seat').forEach(seat => {
    seat.addEventListener('click', () => {
        seat.classList.toggle('active');
    });
});

/* RESET */
document.getElementById('btn-reset').addEventListener('click', () => {
    document.querySelectorAll('.seat').forEach(seat => {
        seat.classList.remove('active');
    });
});
</script>

</body>
</html>
