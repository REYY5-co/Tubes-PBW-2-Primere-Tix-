<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PrimeTIX - Pilih Kursi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/seat.css') }}">
</head>
<body>

<header class="navbar">
    <img src="{{ asset('image/PrimeTIX.png') }}" class="logo">
    <div class="profile"></div>
</header>

<main class="container">
   <h2 class="page-title">
    {{ strtoupper(optional($showtime->schedule->cinema)->name) }}
    – {{ optional($showtime->studio)->name }}
   </h2>

   <section class="seat-area">
        <div class="screen">LAYAR</div>
        <div class="seats-wrapper">
            <div class="seat-grid">
                @for ($i = 1; $i <= 3; $i++)
                    <div class="seat">{{ $i }}</div>
                @endfor
            </div>
            <div class="aisle"></div>
            <div class="seat-grid">
                @for ($i = 4; $i <= 6; $i++)
                    <div class="seat">{{ $i }}</div>
                @endfor
            </div>
        </div>
   </section>

   <div class="action-buttons">
       <button id="btn-reset">Hapus</button>
       <button id="btn-save">Simpan</button>
   </div>

   <!-- FORM HIDDEN UNTUK POST KE PAYMENT -->
   <form id="seatForm" action="{{ route('payment') }}" method="POST">
       @csrf
       <input type="hidden" name="selected_seats" id="selectedSeats">
       <input type="hidden" name="showtime_id" value="{{ $showtime->id }}">
   </form>
</main>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const seats = document.querySelectorAll('.seat');
    const btnSave = document.getElementById('btn-save');
    const seatForm = document.getElementById('seatForm');

    // Toggle aktif/inaktif kursi
    seats.forEach(seat => {
        seat.addEventListener('click', () => {
            seat.classList.toggle('active');
        });
    });

    // Reset
    document.getElementById('btn-reset').addEventListener('click', () => {
        seats.forEach(seat => seat.classList.remove('active'));
    });

    // Simpan & submit form ke payment Blade
    btnSave.addEventListener('click', () => {
        const selectedSeats = Array.from(seats)
            .filter(seat => seat.classList.contains('active'))
            .map(seat => seat.textContent.trim());

        if (selectedSeats.length === 0) {
            alert('Pilih minimal 1 kursi!');
            return;
        }

        // Masukkan data ke form hidden
        document.getElementById('selectedSeats').value = JSON.stringify(selectedSeats);

        // Submit form
        seatForm.submit();
    });
});
</script>

</body>
</html>
