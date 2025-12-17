<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Detail Film - PrimeTIX</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

@php
    $film = request('film');

    $films = [

        'dilan' => [
            'judul' => 'Dilan 1990',
            'poster' => 'image 15.png',
            'genre' => 'Romance, Drama',
            'durasi' => '1h 58m',
            'rating' => '7.5/10',
            'sinopsis' => 'Milea (Vanesha Prescilla) bertemu dengan Dilan (Iqbaal Ramadhan) di sebuah SMA di Bandung pada tahun 1990. Sebuah perkenalan yang tidak biasa membuat Milea mengenal keunikan Dilan yang menurutnya cerdas, baik hati, dan romantis.

                                                                                        Milea (Vanesha Prescilla) bertemu dengan Dilan (Iqbaal Ramadhan) di sebuah SMA di Bandung pada tahun 1990, ketika Milea pindah dari Jakarta ke Bandung. Perkenalan yang tidak biasa itu membuat Milea mengenal keunikan Dilan yang cerdas, baik, dan romantis. Cara Dilan mendekati Milea tidak sama dengan teman-teman pria lainnya, bahkan tidak seperti Beni (Brandon Salim), pacar Milea di Jakarta. Perjalanan hubungan mereka tidak selalu mulus. Beni, Anhar (Giulio Perangkan), dan Kang Adi (Refal Hadi) mewarnai perjalanan tersebut. Dilan membuat Milea percaya bahwa ia bisa sampai ke tujuan dengan selamat.',
            'director' => 'Pidi Baiq, Fajar Bustomi',
            'writer' => 'Pidi Baiq, Titien Wattimena, Dani Rahman Fauzi',
            'actors' => 'Iqbaal Ramadhan, Vanesha Prescilla, Sissy Priscillia'
        ],
        'jumbo' => [
            'judul' => 'Jumbo',
            'poster' => 'image 14.png',
            'genre' => 'Animation',
            'durasi' => '1h 45m',
            'rating' => '8.5/10',
            'sinopsis' => 'Don, anak yatim piatu bertubuh besar yang sering dibully dan dijuluki "Jumbo", yang ingin membuktikan dirinya dengan mementaskan dongeng dari buku warisan orang tuanya, tapi buku itu dicuri oleh Atta, sehingga ia harus berpetualang dengan sahabatnya, Mae dan Nurman, serta Meri, arwah gadis kecil, untuk mengambilnya kembali dan membantu Meri menemukan orang tuanya, mengajarkan makna keberanian, persahabatan, dan kepercayaan dir',
            'director' => 'Ryan Adriandhy',
            'writer' => 'Ryan Adriandhy',
            'actors' => 'Prince Poetiray, Quinn Salman, Yusuf Özkan'
        ],
        'zootopia' => [
            'judul' => 'Zootopia',
            'poster' => 'image 55.jpeg',
            'genre' => 'Animation',
            'durasi' => '1h 48m',
            'rating' => '8.7/10',
            'sinopsis' => 'Kisah kota modern yang dihuni oleh berbagai hewan dengan misteri besar di dalamnya.',
            'director' => 'Ryan Adriandhy',
            'writer' => 'Ryan Adriandhy',
            'actors' => 'Prince Poetiray, Quinn Salman, Yusuf Özkan'
        ],
        'patahhatiyangkupilih' => [
            'judul' => 'Patah Hati Yang Ku Pilih',
            'poster' => 'image 77.jpg',
            'genre' => 'Action • Fantasy',
            'durasi' => '2h 0m',
            'rating' => '8.9/10',
            'sinopsis' => 'Pertarungan penyihir jujutsu melawan kutukan berbahaya yang mengancam manusia.',
            'director' => 'Ryan Adriandhy',
            'writer' => 'Ryan Adriandhy',
            'actors' => 'Prince Poetiray, Quinn Salman, Yusuf Özkan'
        ],
        'superman' => [
            'judul' => 'Superman ',
            'poster' => 'image 13.png',
            'genre' => 'Action, Adventure',
            'durasi' => '1h 45m',
            'rating' => '7.8/10',
            'sinopsis' => 'Superman harus mendamaikan warisan alien Kryptonian miliknya dengan didikan manusianya sebagai reporter Clark Kent. Sebagai perwujudan kebenaran, keadilan, dan cara hidup manusia, ia segera mendapati dirinya berada di dunia yang menganggap nilai-nilai tersebut sudah ketinggalan zaman.

                                                                                                                            Berlatar di semesta DC yang baru, beberapa tahun setelah memulai aksinya sebagai pahlawan, Superman memulai perjalanan pribadi untuk memahami warisan Kryptoniannya dan memadukannya dengan kehidupannya sebagai Clark Kent yang sederhana. Namun, keadaan menjadi rumit ketika industrialis kejam Lex Luthor menjebak Superman dalam sebuah insiden internasional dan merencanakan untuk mengangkat dirinya ke puncak dengan menjatuhkan Superman. Dengan bantuan Lois Lane, Jimmy Olsen, dan Justice Gang, Superman harus merangkul asal-usulnya dan sepenuhnya menjadi pahlawan yang kita butuhkan demi menghentikan rencana Luthor dan menyelamatkan dunia.',
            'director' => 'James Gunn',
            'writer' => 'James Gunn, Jerry Siegel, Joe Shuster',
            'actors' => 'David Corensweet, Rachel Brosnahan, Nicholas Hoult'
        ],

    ];

    $data = $films[$film] ?? null;
@endphp

<body class="bg-white min-h-screen px-8 py-10">

    <a href="{{ url('/') }}" class="text-sm text-gray-600 hover:underline">
        ← Kembali ke Home
    </a>

    @if($data)
        <div class="max-w-5xl mx-auto mt-10 grid grid-cols-1 md:grid-cols-2 gap-10">

            <!-- POSTER -->
            <div class="w-[280px] h-[420px] mx-auto">
                <img src="{{ asset('images/' . $data['poster']) }}" class="w-full h-full object-cover rounded-xl shadow-lg">
            </div>

            <!-- DETAIL -->
            <div>
                <h1 class="text-4xl font-bold mb-4">
                    {{ $data['judul'] }}
                </h1>

                <div class="flex gap-4 text-sm text-gray-600 mb-4">
                    <span>🎬 {{ $data['genre'] }}</span>
                    <span>⏱ {{ $data['durasi'] }}</span>
                    <span>⭐ {{ $data['rating'] }}</span>
                </div>

                <p class="text-gray-700 leading-relaxed mb-6">
                    {{ $data['sinopsis'] }}
                </p>

                <!-- CREW INFO -->
                <div class="mt-6 space-y-2 text-sm text-gray-700">
                    <p><span class="font-semibold">Director:</span> {{ $data['director'] }}</p>
                    <p><span class="font-semibold">Writer:</span> {{ $data['writer'] }}</p>
                    <p><span class="font-semibold">Actors:</span> {{ $data['actors'] }}</p>
                </div>


                <!-- BOOKING BUTTON (DUMMY) -->
                <div class="mt-10">
                    <button class="px-6 py-3 bg-black text-white rounded-full text-lg hover:bg-gray-800 transition">
                        🎟 Book Ticket
                    </button>


                </div>

            </div>
    @else
            <p class="text-center mt-20 text-gray-500">
                Film tidak ditemukan
            </p>
        @endif

</body>

</html>