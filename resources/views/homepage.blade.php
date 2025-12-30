<!DOCTYPE html>
<html lang="en" class="bg-white">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PrimeTIX</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .scrollbar-none::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class="min-h-screen bg-white px-6 py-8">

    <!-- NAV -->
    <nav class="flex justify-between items-center">
        <h1 class="text-2xl font-bold">PrimeTIX</h1>

        @auth
            <a href="{{ route('akun') ?? '#' }}" class="flex items-center space-x-3">
                <img src="{{ auth()->user()?->avatar
            ? asset('storage/' . auth()->user()->avatar)
            : asset('images/avatar-default.png') }}" class="w-10 h-10 rounded-full object-cover border">

                <span class="text-sm font-semibold">
                    {{ auth()->user()->name }}
                </span>
            </a>
        @else
            <a href="{{ route('login') }}" class="px-4 py-2 border rounded-full text-sm">
                Login
            </a>
        @endauth
    </nav>


    <!-- HERO -->
    <div class="text-center mt-12">
        <h2 class="text-4xl font-semibold">Feel The movies beyond</h2>

        <div class="mt-6 flex justify-center">
            <div class="w-full max-w-xl flex items-center gap-3 bg-gray-100 px-4 py-3 rounded-full">
                <input type="text" placeholder="Cari Film atau bioskop"
                    class="w-full bg-transparent focus:outline-none">
            </div>
        </div>
    </div>

    <!-- PROMO SLIDER -->
    <section class="slider mt-16 max-w-[900px] mx-auto relative">
        <button
            class="slider-left absolute left-0 top-1/2 -translate-y-1/2 bg-white shadow rounded-full w-10 h-10 z-10">‹</button>

        <div class="overflow-hidden">
            <div class="slider-track flex gap-6 transition-transform duration-300">

                <a href="https://www.mcdonalds.co.id" target="_blank">
                    <img src="/images/image 8 (1).png"
                        class="w-[260px] h-40 rounded-xl object-cover shrink-0 cursor-pointer">
                </a>

                <a href="https://www.mcdonalds.co.id" target="_blank">
                    <img src="/images/image 8 (1).png"
                        class="w-[260px] h-40 rounded-xl object-cover shrink-0 cursor-pointer">
                </a>

                <a href="https://www.mcdonalds.co.id" target="_blank">
                    <img src="/images/image 8 (1).png"
                        class="w-[260px] h-40 rounded-xl object-cover shrink-0 cursor-pointer">
                </a>

                <a href="https://www.mcdonalds.co.id" target="_blank">
                    <img src="/images/image 8 (1).png"
                        class="w-[260px] h-40 rounded-xl object-cover shrink-0 cursor-pointer">
                </a>

            </div>
        </div>

        <button
            class="slider-right absolute right-0 top-1/2 -translate-y-1/2 bg-white shadow rounded-full w-10 h-10 z-10">›</button>
    </section>

    <section class="slider mt-20 text-center relative max-w-[900px] mx-auto">
        <h2 class="text-3xl font-bold mb-6">NOW SHOWING IN CINEMAS</h2>

        <button
            class="slider-left absolute left-0 top-1/2 -translate-y-1/2 bg-white shadow rounded-full w-10 h-10 z-10">
            ‹
        </button>

        <div class="overflow-hidden">
            <div class="slider-track flex gap-6 transition-transform duration-500">
                @foreach ($nowShowing as $film)
                    <a href="{{ url('/detail-film/' . $film->slug) }}" class="w-[200px] shrink-0 text-left block">

                        <img src="{{ asset('storage/' . $film->poster) }}" class="h-[300px] w-full rounded-xl object-cover">


                        <p class="mt-2 font-semibold uppercase">
                            {{ $film->title }}
                        </p>
                    </a>
                @endforeach

            </div>
        </div>

        <button
            class="slider-right absolute right-0 top-1/2 -translate-y-1/2 bg-white shadow rounded-full w-10 h-10 z-10">
            ›
        </button>
    </section>



    <section class="slider mt-20 text-center relative max-w-[900px] mx-auto">
        <h2 class="text-3xl font-bold mb-6">FOR NEXT WEEK</h2>

        <button
            class="slider-left absolute left-0 top-1/2 -translate-y-1/2 bg-white shadow rounded-full w-10 h-10 z-10">‹</button>

        <div class="overflow-hidden">
            <div class="slider-track flex gap-6 transition-transform duration-500">
                <a href="{{ url('/detail-film?film=avatar') }}" class="w-[200px] shrink-0 text-left block">
                    <img src="{{ asset('images/avatar.webp') }}" class="h-[300px] w-full rounded-xl object-cover">
                    <p class="mt-2 font-semibold">THE LEGEND OF AANG : THE LAS AIR BENDER</p>
                </a>
                <a href="{{ url('/detail-film?film=jimmy') }}" class="w-[200px] shrink-0 text-left block">
                    <img src="{{ asset('images/jimmy.jpg') }}" class="h-[300px] w-full rounded-xl object-cover">
                    <p class="mt-2 font-semibold">18X2 BEYOND YOUTHFUL DAYS</p>
                </a>
                <a href="{{ url('/detail-film?film=agak laen') }}" class="w-[200px] shrink-0 text-left block">
                    <img src="{{ asset('images/agaklaen.jpg') }}" class="h-[300px] w-full rounded-xl object-cover">
                    <p class="mt-2 font-semibold">AGAK LAEN: MENYALA PANTIKU!</p>
                </a>
                <a href="{{ url('/detail-film?film=qorin') }}" class="w-[200px] shrink-0 text-left block">
                    <img src="{{ asset('images/qorin.jpg') }}" class="h-[300px] w-full rounded-xl object-cover">
                    <p class="mt-2 font-semibold">QORIN</p>
                </a>
                <a href="{{ url('/detail-film?film=avatar2') }}" class="w-[200px] shrink-0 text-left block">
                    <img src="{{ asset('images/avatar2.jpg') }}" class="h-[300px] w-full rounded-xl object-cover">
                    <p class="mt-2 font-semibold">AVATAR : FIRE AND ASH</p>
                </a>
            </div>
        </div>

        <button
            class="slider-right absolute right-0 top-1/2 -translate-y-1/2 bg-white shadow rounded-full w-10 h-10 z-10">›</button>
    </section>


    <section class="slider mt-20 text-center relative max-w-[900px] mx-auto">
        <h2 class="text-3xl font-bold mb-6">COMING SOON 2026</h2>

        <button
            class="slider-left absolute left-0 top-1/2 -translate-y-1/2 bg-white shadow rounded-full w-10 h-10 z-10">‹</button>

        <div class="overflow-hidden">
            <div class="slider-track flex gap-6 transition-transform duration-500">
                <a href="{{ url('/detail-film?film=avenger') }}" class="w-[200px] shrink-0 text-left block">
                    <img src="{{ asset('images/avenger.webp') }}" class="h-[300px] w-full rounded-xl object-cover">
                    <p class="mt-2 font-semibold">AVENGERS : DOOMSDAY</p>
                </a>
                <a href="{{ url('/detail-film?film=centurygirl') }}" class="w-[200px] shrink-0 text-left block">
                    <img src="{{ asset('images/centurygirl.jpg') }}" class="h-[300px] w-full rounded-xl object-cover">
                    <p class="mt-2 font-semibold">20TH CENTURY GIRL</p>
                </a>
                <a href="{{ url('/detail-film?film=mummy') }}" class="w-[200px] shrink-0 text-left block">
                    <img src="{{ asset('images/mummy.jpg') }}" class="h-[300px] w-full rounded-xl object-cover">
                    <p class="mt-2 font-semibold">LEE CRONIN'S THE MUMMY</p>
                </a>
                <a href="{{ url('/detail-film?film=remindersofhim') }}" class="w-[200px] shrink-0 text-left block">
                    <img src="{{ asset('images/remindersofhim.jpg') }}"
                        class="h-[300px] w-full rounded-xl object-cover">
                    <p class="mt-2 font-semibold">REMINDERS OF HIM</p>
                </a>
                <a href="{{ url('/detail-film?film=minions') }}" class="w-[200px] shrink-0 text-left block">
                    <img src="{{ asset('images/minions3.jpg') }}" class="h-[300px] w-full rounded-xl object-cover">
                    <p class="mt-2 font-semibold">MINIONS 3</p>
                </a>

            </div>
        </div>
        </div>

        <button
            class="slider-right absolute right-0 top-1/2 -translate-y-1/2 bg-white shadow rounded-full w-10 h-10 z-10">›</button>
    </section>


    <section class="max-w-[900px] mx-auto mt-24">
        <article class="bg-gray-50 p-8 rounded-2xl shadow-sm hover:shadow-md transition
               flex flex-col md:flex-row gap-8">

            <!-- POSTER -->
            <img src="{{ asset('images/jimmy.jpg') }}" alt="18x2 Beyond Youthful Days"
                class="w-full md:w-[220px] h-[330px] object-cover rounded-xl shadow">

            <!-- KONTEN ARTIKEL -->
            <div class="flex-1 text-left">

                <h2 class="text-3xl font-bold mb-3">
                    18×2 Beyond Youthful Days: Tentang Cinta, Waktu, dan Kenangan
                </h2>

                <p class="text-sm text-gray-500 mb-6">
                    Dipublikasikan • 2025
                </p>

                <p class="text-gray-700 leading-relaxed mb-4">
                    Film <strong>18×2 Beyond Youthful Days</strong> menyajikan kisah
                    romantis yang lembut tentang dua orang yang dipertemukan oleh
                    waktu, lalu dipisahkan oleh keadaan. Cerita ini mengalir pelan,
                    penuh makna, dan membawa penonton menyusuri kenangan masa muda
                    yang tak sepenuhnya usai.
                </p>

                <p class="text-gray-700 leading-relaxed mb-4">
                    Dengan visual yang tenang dan atmosfer emosional yang kuat,
                    film ini menyoroti bagaimana perasaan yang tertinggal dapat
                    membentuk seseorang di masa depan. Dialog yang sederhana namun
                    dalam membuat ceritanya terasa dekat dan realistis.
                </p>

                <p class="text-gray-700 leading-relaxed">
                    <em>18×2 Beyond Youthful Days</em> cocok untuk kamu yang menyukai
                    drama romantis bernuansa reflektif, tentang cinta yang tumbuh,
                    pergi, dan tetap hidup dalam ingatan.
                </p>

                <a href="{{ url('/detail-film?film=18x2') }}"
                    class="inline-block mt-6 text-blue-600 font-semibold hover:underline">
                    Baca detail film →
                </a>

            </div>
        </article>
    </section>

    <section class="max-w-[900px] mx-auto mt-24">
        <article class="bg-gray-50 p-8 rounded-2xl shadow-sm hover:shadow-md transition
               flex flex-col md:flex-row gap-8">

            <!-- POSTER -->
            <img src="{{ asset('images/agaklaen.jpg') }}" alt="Agak Laen 2"
                class="w-full md:w-[220px] h-[330px] object-cover rounded-xl shadow">

            <!-- KONTEN ARTIKEL -->
            <div class="flex-1 text-left">

                <h2 class="text-3xl font-bold mb-3">
                    Agak Laen 2: Komedi Segar dengan Cerita yang Lebih Gila
                </h2>

                <p class="text-sm text-gray-500 mb-6">
                    Dipublikasikan • 2025
                </p>

                <p class="text-gray-700 leading-relaxed mb-4">
                    <strong>Agak Laen 2</strong> kembali menghadirkan kekonyolan khas
                    dengan gaya humor yang ringan, absurd, dan dekat dengan
                    kehidupan sehari-hari. Film ini melanjutkan keseruan para
                    karakter dengan konflik baru yang lebih tidak terduga.
                </p>

                <p class="text-gray-700 leading-relaxed mb-4">
                    Tidak hanya mengandalkan lelucon, film ini juga menyisipkan
                    pesan tentang persahabatan, kerja sama, dan bagaimana menghadapi
                    masalah dengan cara yang tidak biasa. Interaksi antarkarakter
                    menjadi kekuatan utama yang membuat penonton terus tertawa.
                </p>

                <p class="text-gray-700 leading-relaxed">
                    Dengan alur yang lebih cepat dan humor yang lebih berani,
                    <em>Agak Laen 2</em> cocok menjadi tontonan hiburan untuk melepas
                    penat bersama teman atau keluarga.
                </p>

                <a href="{{ url('/detail-film?film=agak-laen-2') }}"
                    class="inline-block mt-6 text-blue-600 font-semibold hover:underline">
                    Baca detail film →
                </a>

            </div>
        </article>
    </section>



    <!-- JS -->
    <script>
        document.querySelectorAll(".slider").forEach(slider => {
            const track = slider.querySelector(".slider-track");
            const left = slider.querySelector(".slider-left");
            const right = slider.querySelector(".slider-right");

            const itemWidth = track.children[0].offsetWidth + 24;
            const visibleCount = Math.floor(slider.offsetWidth / itemWidth);

            let index = 0;

            left.onclick = () => slide(-1);
            right.onclick = () => slide(1);

            function slide(dir) {
                const maxIndex = track.children.length - visibleCount;
                index = Math.max(0, Math.min(index + dir, maxIndex));
                track.style.transform = `translateX(-${index * itemWidth}px)`;
            }
        });
    </script>

</body>

</html>