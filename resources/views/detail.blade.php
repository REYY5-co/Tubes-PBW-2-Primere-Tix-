<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Film - PrimeTIX</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

@php
    // Ambil slug dari URL: /film/{slug}
   

    // Data film (dummy)
    $films = [
        'dilan' => [
            'judul' => 'Dilan 1990',
            'poster' => 'image 15.png',
            'genre' => 'Romance, Drama',
            'durasi' => '1h 58m',
            'rating' => '7.5/10',
            'sinopsis' => 'Milea bertemu Dilan di SMA Bandung tahun 1990. Perkenalan unik membawa kisah cinta sederhana namun berkesan.',
            'director' => 'Pidi Baiq, Fajar Bustomi',
            'writer' => 'Pidi Baiq, Titien Wattimena',
            'actors' => 'Iqbaal Ramadhan, Vanesha Prescilla'
        ],
        'jumbo' => [
            'judul' => 'Jumbo',
            'poster' => 'image 14.png',
            'genre' => 'Animation',
            'durasi' => '1h 45m',
            'rating' => '8.5/10',
            'sinopsis' => 'Don, anak bertubuh besar yang sering dibully, memulai petualangan untuk membuktikan dirinya dan menemukan keberanian sejati.',
            'director' => 'Ryan Adriandhy',
            'writer' => 'Ryan Adriandhy',
            'actors' => 'Prince Poetiray, Quinn Salman'
        ],
        'zootopia' => [
            'judul' => 'Zootopia',
            'poster' => 'image 55.jpeg',
            'genre' => 'Animation',
            'durasi' => '1h 48m',
            'rating' => '8.7/10',
            'sinopsis' => 'Kota modern berisi berbagai hewan dengan misteri besar yang harus dipecahkan.',
            'director' => 'Byron Howard',
            'writer' => 'Jared Bush',
            'actors' => 'Ginnifer Goodwin, Jason Bateman'
        ],
        'superman' => [
            'judul' => 'Superman',
            'poster' => 'image 13.png',
            'genre' => 'Action, Adventure',
            'durasi' => '1h 45m',
            'rating' => '7.8/10',
            'sinopsis' => 'Superman berjuang menyatukan warisan Krypton dengan nilai-nilai kemanusiaan di dunia modern.',
            'director' => 'James Gunn',
            'writer' => 'James Gunn',
            'actors' => 'David Corenswet, Rachel Brosnahan'
        ],
    ];

    $film = $films[$slug] ?? null;
@endphp

<body class="bg-white min-h-screen px-6 py-10">

    <!-- BACK -->
    <a href="{{ route('homepage') }}" class="text-sm text-gray-600 hover:underline">
        ← Kembali ke Home
    </a>

    @if ($film)
        <div class="max-w-5xl mx-auto mt-10 grid grid-cols-1 md:grid-cols-2 gap-10">

            <!-- POSTER -->
            <div class="flex justify-center">
                <img
                    src="{{ asset('images/' . $film['poster']) }}"
                    alt="{{ $film['judul'] }}"
                    class="w-[280px] h-[420px] object-cover rounded-xl shadow-lg"
                >
            </div>

            <!-- DETAIL -->
            <div>
                <h1 class="text-4xl font-bold mb-4">
                    {{ $film['judul'] }}
                </h1>

                <div class="flex flex-wrap gap-4 text-sm text-gray-600 mb-6">
                    <span>🎬 {{ $film['genre'] }}</span>
                    <span>⏱ {{ $film['durasi'] }}</span>
                    <span>⭐ {{ $film['rating'] }}</span>
                </div>

                <p class="text-gray-700 leading-relaxed mb-6">
                    {{ $film['sinopsis'] }}
                </p>

                <!-- CREW -->
                <div class="space-y-2 text-sm text-gray-700">
                    <p><span class="font-semibold">Director:</span> {{ $film['director'] }}</p>
                    <p><span class="font-semibold">Writer:</span> {{ $film['writer'] }}</p>
                    <p><span class="font-semibold">Actors:</span> {{ $film['actors'] }}</p>
                </div>

                <!-- ACTION -->
                <div class="mt-10">
                    <a href="{{ route('jadwal') }}"
   class="inline-block px-8 py-3 bg-black text-white rounded-full text-lg hover:bg-gray-800 transition">
    🎟 Book Ticket
</a>

                </div>
            </div>
        </div>
    @else
        <div class="text-center mt-32">
            <h2 class="text-2xl font-semibold text-gray-700 mb-2">
                Film tidak ditemukan
            </h2>
            <p class="text-gray-500">
                URL film tidak valid atau data belum tersedia.
            </p>
        </div>
    @endif

</body>
</html>
