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
</header>

<main class="container">
    <h2 class="page-title">
        {{ strtoupper(optional($showtime->schedule->cinema)->name) }}
        – {{ optional($showtime->studio)->name ?? 'Studio' }}
        ({{ \Carbon\Carbon::parse($showtime->time)->format('H.i') }} WIB)
    </h2>

    <!-- AREA KURSI -->
    <section class="seat-area">
    <div class="screen">LAYAR</div>

    <div class="seats-wrapper">

        {{-- KIRI --}}
        <div class="seat-grid">
            @for ($i = 1; $i <= 3; $i++)
                @php
                    $seatCode = 'A'.$i;
                    $isBooked = in_array($seatCode, $bookedSeats ?? []);
                @endphp

                <div
                    class="seat {{ $isBooked ? 'booked' : '' }}"
                    data-seat="{{ $seatCode }}"
                    {{ $isBooked ? 'data-booked=true' : '' }}
                >
                    {{ $seatCode }}
                </div>
            @endfor
        </div>

        {{-- JALUR TENGAH --}}
        <div class="aisle"></div>

        {{-- KANAN --}}
        <div class="seat-grid">
            @for ($i = 4; $i <= 6; $i++)
                @php
                    $seatCode = 'A'.$i;
                    $isBooked = in_array($seatCode, $bookedSeats ?? []);
                @endphp

                <div
                    class="seat {{ $isBooked ? 'booked' : '' }}"
                    data-seat="{{ $seatCode }}"
                    {{ $isBooked ? 'data-booked=true' : '' }}
                >
                    {{ $seatCode }}
                </div>
            @endfor
        </div>

    </div>
</section>


    <div class="action-buttons">
        <button id="btn-reset" type="button">Hapus</button>
        <button id="btn-save" type="button">Simpan</button>
    </div>

    <form id="paymentForm" action="{{ route('payment') }}" method="POST">
        @csrf
        <input type="hidden" name="showtime_id" value="{{ $showtime->id }}">
        <input type="hidden" name="selected_seats" id="selectedSeatsInput">
    </form>
</main>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const seats = document.querySelectorAll('.seat');
    const btnSave = document.getElementById('btn-save');
    const btnReset = document.getElementById('btn-reset');
    const selectedSeatsInput = document.getElementById('selectedSeatsInput');

    let selectedSeats = [];

    seats.forEach(seat => {
        if (seat.dataset.booked) return;

        seat.addEventListener('click', () => {
            const code = seat.dataset.seat;

            if (selectedSeats.includes(code)) {
                selectedSeats = selectedSeats.filter(s => s !== code);
                seat.classList.remove('active');
            } else {
                selectedSeats.push(code);
                seat.classList.add('active');
            }
        });
    });

    btnReset.addEventListener('click', () => {
        selectedSeats = [];
        seats.forEach(seat => seat.classList.remove('active'));
    });

    btnSave.addEventListener('click', () => {
        if (selectedSeats.length === 0) {
            alert('Pilih minimal 1 kursi');
            return;
        }

        selectedSeatsInput.value = JSON.stringify(selectedSeats);
        document.getElementById('paymentForm').submit();
    });
});
</script>

</body>
</html>
