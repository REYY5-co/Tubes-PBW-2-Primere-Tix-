<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Film - PrimeTIX</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

@php
    use App\Models\Film;

    // DATA DUMMY
    $films = [
        'dilan-1990' => [
            'judul' => 'Dilan 1990',
            'genre' => 'Romance, Drama',
            'durasi' => '1h 58m',
            'rating' => '7.5/10',
            'sinopsis' => 'Milea bertemu Dilan di SMA Bandung tahun 1990.',
            'director' => 'Pidi Baiq',
            'writer' => 'Pidi Baiq',
            'actors' => 'Iqbaal Ramadhan, Vanesha Prescilla'
        ],
        'jumbo' => [
            'judul' => 'Jumbo',
            'genre' => 'Animation',
            'durasi' => '1h 45m',
            'rating' => '8.5/10',
            'sinopsis' => 'Jumbo berkisah tentang Don, seorang anak laki-laki yang sering diejek karena tubuhnya yang gempal dan dijuluki “Jumbo”. Ia sangat kreatif dan penuh imajinasi — terutama terinspirasi dari buku dongeng peninggalan orang tuanya. Don bercita-cita membuat pertunjukan dari buku itu, tetapi menghadapi tantangan besar ketika buku tersebut dicuri oleh teman yang membulinya. Dalam perjalanannya, Don dan sahabatnya bertemu dengan Meri, seorang roh gadis kecil yang ingin mencari orang tuanya, dan bersama mereka menjalani petualangan penuh arti tentang persahabatan, keberanian, dan mimpi.',
            'director' => 'Ryan Adriandhy',
            'writer' => 'Ryan Adriandhy',
            'actors' => 'Prince Poetiray, Quinn Salman'
        ],
          'superman' => [
            'judul' => 'Superman (2025)',
            'genre' => 'Aksi, Petualangan, Superhero, Fantasi',
            'durasi' => '2h 9m',
            'rating' => '9/10',
            'sinopsis' => 'Clark Kent menghadapi tantangan besar dalam menyeimbangkan dua kehidupan: sebagai Superman, pahlawan super berkemampuan luar biasa dari Planet Krypton, dan sebagai manusia biasa yang bekerja sebagai jurnalis di Daily Planet. Di tengah perjuangannya mempertahankan nilai kebenaran dan keadilan, ia harus berhadapan dengan musuh bebuyutan, Lex Luthor, seorang miliarder jenius yang menganggap Superman sebagai ancaman bagi umat manusia. Film ini juga mengeksplorasi konflik batin Clark tentang identitasnya dan sisi kemanusiaannya.',
            'director' => 'James Gunn',
            'writer' => 'James Gunn',
            'actors' => 'David Corenswet, Rachel Brosnahan, Nicholas Hoult'
        ],
        'avatar' => [
            'judul' => 'Avatar: Fire and Ash(2025)',
            'genre' => 'Fantasi, Sci-fi',
            'durasi' => '3h 17m',
            'rating' => '7/10',
            'sinopsis' => 'Avatar: Fire and Ash adalah film ketiga dalam saga Avatar yang disutradarai oleh James Cameron. Ceritanya melanjutkan konflik setelah kejadian di Avatar: The Way of Water, di mana Jake Sully dan Neytiri harus menghadapi ancaman baru dari suku Navi yang disebut Ash People — kelompok yang hidup di lingkungan panas dan penuh api. Tantangan ini membuat keluarga Sully berjuang bukan hanya melindungi diri mereka sendiri, tetapi juga mempertahankan masa depan bangsa Navi di planet Pandora',
            'director' => 'James Cameron',
            'writer' => 'James Cameron, Rick Jaffa & Amanda Silver',
            'actors' => 'Sam Worthington, Zoe Saldana, Oona Chaplin'
        ],
          'zootopia' => [
            'judul' => 'Zootopia 2 (2025)',
            'genre' => 'Animation, Adventure, Comedy, Family',
            'durasi' => '1h 48m',
            'rating' => '9.1/10',
            'sinopsis' => 'Setelah beberapa tahun sejak kejadian di film pertama, duo polisi Judy Hopps dan Nick Wilde kembali menghadapi sebuah misteri besar di kota Zootopia. Ketika seekor ular bernama Gary DeSnake muncul dan mencuri objek penting di acara perayaan kota, Judy dan Nick harus bekerja sama lagi untuk mengungkap kasus ini. Petualangan ini membawa mereka menyusuri berbagai wilayah baru kota sambil menguji kekompakan dan persahabatan mereka.',
            'director' => 'Jared Brush',
            'writer' => 'Jared Brush',
            'actors' => 'Ginnifer Goodwin, Jason Bateman, Ke Hyu Qquan'
        ],
        'agakLaen' => [
            'judul' => 'Agak Laen 2: Menyala Pantiku! (2025)',
            'genre' => 'Komedi, Misteri',
            'durasi' => '1h 59m',
            'rating' => '8.3/10',
            'sinopsis' => 'Agak Laen 2: Menyala Pantiku! mengikuti petualangan empat detektif gagal — Bene, Boris, Jegel, dan Oki — yang diberi kesempatan terakhir untuk membuktikan kemampuan mereka. Mereka ditugaskan menyamar menjadi perawat dan menyusup ke sebuah panti jompo untuk menangkap buronan yang diduga terlibat pembunuhan anak wali kota. Situasi ini memicu berbagai kejadian lucu, kekacauan, dan kejutan sepanjang penyelidikan mereka.',
            'director' => 'Muhadkly Acho',
            'writer' => 'Muhadkly Acho',
            'actors' => 'Bene Dion, Boris Bokir, Indra Jegel, Oki Rengga'
        ],
        '18x2' => [
            'judul' => '18x2 Beyond Youthful Days (2024)',
            'genre' => 'Drama, Romance',
            'durasi' => '2h 4m',
            'rating' => '10/10',
            'sinopsis' => 'Film ini mengikuti Jimmy, seorang pengembang video game asal Taiwan yang kehilangan pekerjaannya dan memutuskan pergi solo trip ke Jepang untuk mencari arti hidup dan kenangan masa mudanya. Ia teringat kembali pada Ami, cinta pertamanya, yang ia temui 18 tahun lalu saat musim panas di Taiwan. Kenangan akan cinta yang tak sempat terwujud itu membawanya berkeliling Jepang sambil merenungkan masa lalu dan perasaannya yang belum terselesaikan.',
            'director' => 'Michihito Fujii',
            'writer' => 'Michihito Fujii, Hirokawa Hayashida',
            'actors' => 'Greg Hsu, Kaya Kiyohara,'
        ],
        
        
        
        
        

    ];

    $film = $films[$slug] ?? null;

    // POSTER DARI DATABASE
    $filmDb = Film::where('slug', $slug)->first();
@endphp

<body class="bg-white min-h-screen px-6 py-10">

    <!-- BACK -->
    <a href="{{ route('homepage') }}" class="text-sm text-gray-600 hover:underline">
        ← Kembali ke Home
    </a>

@if ($film)
<div class="max-w-5xl mx-auto mt-10 grid grid-cols-1 md:grid-cols-2 gap-10">

    <!-- POSTER (DATABASE) -->
    <div class="flex justify-center">
        @if ($filmDb && $filmDb->poster)
            <img
                src="{{ asset('storage/' . $filmDb->poster) }}"
                alt="{{ $film['judul'] }}"
                class="w-[280px] h-[420px] object-cover rounded-xl shadow-lg"
            >
        @else
            <div class="w-[280px] h-[420px] bg-gray-200 flex items-center justify-center rounded-xl">
                Poster tidak tersedia
            </div>
        @endif
    </div>

    <!-- DETAIL (DUMMY) -->
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
            <p><b>Director:</b> {{ $film['director'] }}</p>
            <p><b>Writer:</b> {{ $film['writer'] }}</p>
            <p><b>Actors:</b> {{ $film['actors'] }}</p>
        </div>

        <!-- 🔥 BOOKING BUTTON (TETAP ADA) -->
        <div class="mt-10">
            <a href="{{ route('jadwal') }}"
               class="inline-block px-8 py-3 bg-black text-white rounded-full text-lg hover:bg-gray-800 transition">
                🎟 Book Ticket
            </a>
        </div>
    </div>

</div>
@else
    <p class="text-center mt-20">Film tidak ditemukan.</p>
@endif

</body>
</html>
