<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PrimeTIX - Jadwal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header class="navbar">
    <img src="{{ asset('image/PrimeTIX.png') }}" class="logo">

    <div class="navbar-right">
        <div class="location-wrapper">
            <div class="location-toggle" id="locationToggle">
                <span class="location-text">
                    {{ session('lokasi', 'Bandung') }}
                </span>
                <img src="{{ asset('image/lokasi.svg') }}" class="location-icon">
            </div>

            <div class="location-dropdown" id="locationDropdown">
                <a href="/set-lokasi/Bandung">Bandung</a>
                <a href="/set-lokasi/Jakarta">Jakarta</a>
                <a href="/set-lokasi/Surabaya">Surabaya</a>
            </div>
        </div>

        <div class="profile"></div>
    </div>
</header>

<main class="container">

    <!-- MOVIE INFO -->
    <section class="movie-info">
        <div class="movie-left">
            <h1 class="page-title small">Jadwal Tayang</h1>
            <img src="{{ asset('image/JUMBO.jpg') }}" class="poster">
        </div>

        <div class="movie-detail">
            <h2>JUMBO</h2>
            <p class="genre">FANTASI</p>
            <span class="duration">1 jam 42 menit</span>
        </div>
    </section>

    <!-- SCHEDULE -->
    <section class="schedule-section">
        <h3 class="schedule-title">Jadwal</h3>
        <hr>

        <!-- DAYS -->
        <div class="days">
@foreach ($dates as $schedule)
    <div class="day" data-schedule-id="{{ $schedule->id }}">
        {{ \Carbon\Carbon::parse($schedule->date)->translatedFormat('D') }}
        <br>
        <span>{{ \Carbon\Carbon::parse($schedule->date)->format('d') }}</span>
    </div>
@endforeach
</div>

        <!-- CINEMA -->
        <div class="cinema open">
            <div class="cinema-header">
                <span>
                    @php
                        $lokasi = session('lokasi', 'Bandung');
                        $bioskop = [
                            'Bandung' => 'PARIS VAN JAVA PRIME TIX',
                            'Jakarta' => 'PLAZA INDONESIA PRIME TIX',
                            'Surabaya' => 'TUNJUNGAN PLAZA PRIME TIX'
                        ];
                    @endphp
                    {{ $bioskop[$lokasi] }}
                </span>
                <span class="arrow">⌄</span>
            </div>

            <div class="cinema-divider"></div>

            <!-- TIME LIST -->
            <div class="time-list" id="timeList">
                <p class="hint">Pilih tanggal terlebih dahulu</p>
            </div>
        </div>

        <!-- ACTION -->
        <div class="action-buttons">
            <button id="btn-reset">Hapus</button>
            <button id="btn-next">Lanjutkan</button>
        </div>
    </section>
</main>


<script>
/* LOCATION */
const locToggle = document.getElementById('locationToggle');
const locMenu = document.getElementById('locationDropdown');

locToggle.onclick = () => {
    locMenu.style.display = locMenu.style.display === 'block' ? 'none' : 'block';
};



let selectedScheduleId = null;
let selectedShowtimeId = null;

/* DAY CLICK */
document.querySelectorAll('.day').forEach(day => {
    day.addEventListener('click', () => {

        const scheduleId = day.dataset.scheduleId;
        if (!scheduleId) return;

        selectedScheduleId = scheduleId;
        selectedShowtimeId = null;

        // active day
        document.querySelectorAll('.day')
            .forEach(d => d.classList.remove('active'));
        day.classList.add('active');

        const timeList = document.getElementById('timeList');
        timeList.innerHTML = '<p>Memuat jadwal...</p>';

        fetch(`/ajax/showtimes/${scheduleId}`)
            .then(res => res.json())
            .then(showtimes => {

                timeList.innerHTML = '';

                if (!showtimes.length) {
                    timeList.innerHTML = '<p>Tidak ada jadwal</p>';
                    return;
                }

                showtimes.forEach(showtime => {
                    const btn = document.createElement('button');
                    const jam = showtime.time.slice(0, 5).replace(':', '.');
                    btn.textContent = `${jam} WIB`;

                    if (showtime.is_locked) {
                        btn.classList.add('disabled-time');
                        btn.disabled = true;
                    } else {
                        btn.onclick = () => {
                            document.querySelectorAll('#timeList button')
                                .forEach(b => b.classList.remove('active-time'));
                            btn.classList.add('active-time');
                            selectedShowtimeId = showtime.id;
                        };
                    }

                    timeList.appendChild(btn);
                });
            });
    });
});

/* RESET */
document.getElementById('btn-reset').onclick = () => {
    selectedScheduleId = null;
    selectedShowtimeId = null;

    document.querySelectorAll('.day')
        .forEach(d => d.classList.remove('active'));

    document.getElementById('timeList').innerHTML =
        '<p class="hint">Pilih tanggal terlebih dahulu</p>';
};

/* NEXT */
document.getElementById('btn-next').onclick = () => {

    if (!selectedScheduleId) {
        alert('Silakan pilih tanggal nonton terlebih dahulu');
        return;
    }

    if (!selectedShowtimeId) {
        alert('Silakan pilih jam tayang terlebih dahulu');
        return;
    }

    window.location.href = `/seats/${selectedShowtimeId}`;
};
</script>

</body>
</html>
