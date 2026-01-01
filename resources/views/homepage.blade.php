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
            <a href="{{ route('akun') }}" class="flex items-center space-x-3">
                <img src="{{ auth()->user()->avatar
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

        <form action="{{ url('/') }}" method="GET" class="mt-6 flex justify-center">
            <div class="w-full max-w-xl flex items-center gap-3 bg-gray-100 px-4 py-3 rounded-full">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari Film"
                    class="w-full bg-transparent focus:outline-none">
            </div>
        </form>
    </div>

    <!-- SEARCH RESULT -->
    @if(request('q'))
        <section class="max-w-7xl mx-auto px-6 mt-10">
            <h2 class="text-2xl font-semibold mb-6">
                Hasil pencarian untuk: "{{ request('q') }}"
            </h2>

            @if($searchResults->isEmpty())
                <p class="text-gray-400">Film tidak ditemukan.</p>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                    @foreach($searchResults as $film)
                        <div>
                            <img src="{{ asset('storage/' . $film->poster) }}" class="rounded-xl aspect-[2/3] object-cover">
                            <p class="mt-2 text-center font-medium">
                                {{ $film->title }}
                            </p>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    @endif

    <!-- SLIDER COMPONENT -->
    @php
        $sections = [
            'NOW SHOWING IN CINEMAS' => $nowShowing,
            'NEXT WEEK' => $nextWeek,
            'COMING SOON' => $comingSoon,
        ];
    @endphp

    @foreach($sections as $title => $films)
        <section class="slider mt-20 relative max-w-[900px] mx-auto">
            <h2 class="text-3xl font-bold mb-6 text-center">{{ $title }}</h2>

            <button
                class="slider-left absolute left-0 top-1/2 -translate-y-1/2 bg-white shadow rounded-full w-10 h-10 z-10">
                ‹
            </button>

            <div class="slider-wrapper overflow-x-auto scrollbar-none">
                <div class="slider-track flex gap-6">
                    @foreach ($films as $film)
                        <a href="{{ route('film.detail', $film->slug) }}" class="w-[200px] shrink-0 block">
                            <img src="{{ asset('storage/' . $film->poster) }}" class="h-[300px] w-full rounded-xl object-cover">
                            <p class="mt-2 font-semibold uppercase text-sm">
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
    @endforeach

    <section class="max-w-[900px] mx-auto mt-24">
        <article
            class="bg-gray-50 p-8 rounded-2xl shadow-sm hover:shadow-md transition flex flex-col md:flex-row gap-8">
            <!-- POSTER --> <img src="{{ asset('storage/films/jimmy.jpg') }}" alt="18x2 Beyond Youthful Days"
                class="w-full md:w-[220px] h-[330px] object-cover rounded-xl shadow"> <!-- KONTEN ARTIKEL -->
            <div class="flex-1 text-left">
                <h2 class="text-3xl font-bold mb-3"> 18×2 Beyond Youthful Days: Tentang Cinta, Waktu, dan Kenangan </h2>
                <p class="text-sm text-gray-500 mb-6"> Dipublikasikan • 2025 </p>
                <p class="text-gray-700 leading-relaxed mb-4"> Film <strong>18×2 Beyond Youthful Days</strong>
                    menyajikan kisah romantis yang lembut tentang dua orang yang dipertemukan oleh waktu, lalu
                    dipisahkan oleh keadaan. Cerita ini mengalir pelan, penuh makna, dan membawa penonton menyusuri
                    kenangan masa muda yang tak sepenuhnya usai. </p>
                <p class="text-gray-700 leading-relaxed mb-4"> Dengan visual yang tenang dan atmosfer emosional yang
                    kuat, film ini menyoroti bagaimana perasaan yang tertinggal dapat membentuk seseorang di masa depan.
                    Dialog yang sederhana namun dalam membuat ceritanya terasa dekat dan realistis. </p>
                <p class="text-gray-700 leading-relaxed"> <em>18×2 Beyond Youthful Days</em> cocok untuk kamu yang
                    menyukai drama romantis bernuansa reflektif, tentang cinta yang tumbuh, pergi, dan tetap hidup dalam
                    ingatan. </p> <a href="{{ url('/detail-film?film=18x2') }}"
                    class="inline-block mt-6 text-blue-600 font-semibold hover:underline"> Baca detail film → </a>
            </div>
        </article>
    </section>  
    <section class="max-w-[900px] mx-auto mt-24">
        <article
            class="bg-gray-50 p-8 rounded-2xl shadow-sm hover:shadow-md transition flex flex-col md:flex-row gap-8">
            <!-- POSTER --> <img src="{{ asset('/storage/films/agaklaen.jpg') }}" alt="Agak Laen 2"
                class="w-full md:w-[220px] h-[330px] object-cover rounded-xl shadow"> <!-- KONTEN ARTIKEL -->
            <div class="flex-1 text-left">
                <h2 class="text-3xl font-bold mb-3"> Agak Laen 2: Komedi Segar dengan Cerita yang Lebih Gila </h2>
                <p class="text-sm text-gray-500 mb-6"> Dipublikasikan • 2025 </p>
                <p class="text-gray-700 leading-relaxed mb-4"> <strong>Agak Laen 2</strong> kembali menghadirkan
                    kekonyolan khas dengan gaya humor yang ringan, absurd, dan dekat dengan kehidupan sehari-hari. Film
                    ini melanjutkan keseruan para karakter dengan konflik baru yang lebih tidak terduga. </p>
                <p class="text-gray-700 leading-relaxed mb-4"> Tidak hanya mengandalkan lelucon, film ini juga
                    menyisipkan pesan tentang persahabatan, kerja sama, dan bagaimana menghadapi masalah dengan cara
                    yang tidak biasa. Interaksi antarkarakter menjadi kekuatan utama yang membuat penonton terus
                    tertawa. </p>
                <p class="text-gray-700 leading-relaxed"> Dengan alur yang lebih cepat dan humor yang lebih berani,
                    <em>Agak Laen 2</em> cocok menjadi tontonan hiburan untuk melepas penat bersama teman atau keluarga.
                </p> <a href="{{ url('/detail-film?film=agak-laen-2') }}"
                    class="inline-block mt-6 text-blue-600 font-semibold hover:underline"> Baca detail film → </a>
            </div>
        </article>
    </section>

    <!-- JS -->
    <script>
        window.addEventListener("load", () => {
            document.querySelectorAll(".slider").forEach(slider => {
                const wrapper = slider.querySelector(".slider-wrapper");
                const prev = slider.querySelector(".slider-left");
                const next = slider.querySelector(".slider-right");

                if (!wrapper) return;

                const item = wrapper.querySelector(".slider-track > *");
                if (!item) return;

                const gap = 24;
                const slideWidth = item.offsetWidth + gap;
                let auto;

                function nextSlide() {
                    if (wrapper.scrollLeft + wrapper.clientWidth >= wrapper.scrollWidth - 5) {
                        wrapper.scrollTo({ left: 0, behavior: "smooth" });
                    } else {
                        wrapper.scrollBy({ left: slideWidth, behavior: "smooth" });
                    }
                }

                function prevSlide() {
                    if (wrapper.scrollLeft <= 0) {
                        wrapper.scrollTo({ left: wrapper.scrollWidth, behavior: "smooth" });
                    } else {
                        wrapper.scrollBy({ left: -slideWidth, behavior: "smooth" });
                    }
                }

                next.addEventListener("click", nextSlide);
                prev.addEventListener("click", prevSlide);

                auto = setInterval(nextSlide, 3000);

                slider.addEventListener("mouseenter", () => clearInterval(auto));
                slider.addEventListener("mouseleave", () => {
                    auto = setInterval(nextSlide, 3000);
                });
            });
        });
    </script>

</body>

</html>