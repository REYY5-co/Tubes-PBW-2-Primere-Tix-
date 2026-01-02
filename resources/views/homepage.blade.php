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
                class="slider-left absolute -left-10 top-1/2 -translate-y-1/2 bg-white shadow rounded-full w-10 h-10 z-10">
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
                class="slider-right absolute -right-10 top-1/2 -translate-y-1/2 bg-white shadow rounded-full w-10 h-10 z-10">
                ›
            </button>
        </section>
    @endforeach



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


   <footer class="mt-32 bg-gradient-to-b from-[#081B2F] to-[#041423] text-gray-300">
    <div class="max-w-7xl mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-4 gap-12">

        <!-- BRAND -->
        <div>
            <h2 class="text-3xl font-bold text-white mb-4">PrimeTIX</h2>
            <p class="text-sm leading-relaxed">
                PrimeTIX adalah platform informasi dan pemesanan film di Indonesia.
                Temukan film yang sedang tayang, film mendatang, dan rencanakan
                pengalaman menontonmu dengan mudah.
            </p>
        </div>

        <!-- MENU -->
        <div>
            <h3 class="text-white font-semibold mb-4">Jelajahi</h3>
            <ul class="space-y-3 text-sm">
                <li><a href="#" class="hover:text-white transition">Sedang Tayang</a></li>
                <li><a href="#" class="hover:text-white transition">Minggu Depan</a></li>
                <li><a href="#" class="hover:text-white transition">Akan Datang</a></li>
                <li><a href="#" class="hover:text-white transition">Trailer & Cuplikan</a></li>
            </ul>
        </div>

        <!-- INFO -->
        <div>
            <h3 class="text-white font-semibold mb-4">Tentang</h3>
            <ul class="space-y-3 text-sm">
                <li><a href="#" class="hover:text-white transition">Tentang PrimeTIX</a></li>
                <li><a href="#" class="hover:text-white transition">Kontak Kami</a></li>
                <li><a href="#" class="hover:text-white transition">Kebijakan Privasi</a></li>
                <li><a href="#" class="hover:text-white transition">Syarat & Ketentuan</a></li>
            </ul>
        </div>

        <!-- SOSIAL -->
        <div>
            <h3 class="text-white font-semibold mb-4">Ikuti Kami</h3>
            <p class="text-sm mb-4">Tetap terhubung dengan PrimeTIX</p>

            <div class="flex gap-4">
                <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-white" viewBox="0 0 24 24"><path d="M7.75 2h8.5A5.75 5.75 0 0122 7.75v8.5A5.75 5.75 0 0116.25 22h-8.5A5.75 5.75 0 012 16.25v-8.5A5.75 5.75 0 017.75 2zm8.5 1.5h-8.5A4.25 4.25 0 003.5 7.75v8.5A4.25 4.25 0 007.75 20.5h8.5a4.25 4.25 0 004.25-4.25v-8.5A4.25 4.25 0 0016.25 3.5z"/><path d="M12 7a5 5 0 100 10 5 5 0 000-10zm0 1.5a3.5 3.5 0 110 7 3.5 3.5 0 010-7z"/><circle cx="17.5" cy="6.5" r="1"/></svg>
                </a>

                <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-white" viewBox="0 0 24 24"><path d="M23.5 6.2s-.2-1.7-.8-2.5c-.7-.8-1.4-.8-1.8-.9C18.4 2.5 12 2.5 12 2.5h0s-6.4 0-8.9.3c-.4.1-1.1.1-1.8.9-.6.8-.8 2.5-.8 2.5S.2 8.3.2 10.4v1.2c0 2.1.3 4.2.3 4.2s.2 1.7.8 2.5c.7.8 1.6.8 2 .9 1.4.1 8.7.3 8.7.3s6.4 0 8.9-.3c.4-.1 1.1-.1 1.8-.9.6-.8.8-2.5.8-2.5s.3-2.1.3-4.2v-1.2c0-2.1-.3-4.2-.3-4.2zM9.5 14.6V7.4l6.2 3.6-6.2 3.6z"/></svg>
                </a>
            </div>
        </div>

    </div>

    <!-- COPYRIGHT -->
    <div class="border-t border-white/10 py-6 text-center text-sm text-gray-400">
        © 2025 PrimeTIX. Seluruh hak cipta dilindungi.
    </div>
</footer>


</body>

</html>