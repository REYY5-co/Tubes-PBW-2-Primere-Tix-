<!DOCTYPE html>
<html lang="en" class="bg-white" style="background-color:white;">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PrimeTIX</title>

    <!-- KONFIGURASI TAILWIND HARUS SEBELUM CDN -->
    <script>
        tailwind = {
            config: {
                darkMode: 'class'
            }
        }
    </script>

    <!-- LOAD TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .scrollbar-none::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>


<body class="min-h-screen bg-white px-6 py-8 bg-white">
    <!-- NAV -->
    <nav class="flex justify-between items-center">
        <h1 class="text-2xl font-bold">PrimeTIX</h1>
        <div class="w-10 h-10 bg-black rounded-full"></div>
    </nav>

    <!-- HERO TEXT -->
    <div class="text-center mt-12">
        <h2 class="text-4xl font-semibold">Feel The movies beyond</h2>

        <!-- Search -->
        <div class="mt-6 flex justify-center">
            <div class="w-full max-w-xl flex items-center gap-3 bg-gray-100 px-4 py-3 rounded-full">
                <svg width="22" height="22" fill="none" stroke="#666" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-search">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" placeholder="Cari Film atau bioskop"
                    class="w-full bg-transparent focus:outline-none">
            </div>
        </div>
    </div>


    <!-- PROMO CAROUSEL -->
<div class="relative w-full flex justify-center mt-12">

    <!-- Tombol kiri (diluar overflow-hidden) -->
    <button id="prevBtn"
        class="absolute left-[calc(50%-470px)] top-1/2 -translate-y-1/2 
        bg-white shadow rounded-full w-10 h-10 flex items-center justify-center z-30">
        ‹
    </button>

    <!-- Wrapper utama -->
    <div class="max-w-[900px] w-full overflow-hidden relative">

        <!-- Track -->
        <div id="carousel" class="flex gap-6 transition-transform duration-300">
            <img src="/images/image 8 (1).png" class="w-[260px] h-40 rounded-xl shadow object-cover">
            <img src="/images/image 8 (1).png" class="w-[260px] h-40 rounded-xl shadow object-cover">
            <img src="/images/image 8 (1).png" class="w-[260px] h-40 rounded-xl shadow object-cover">
            <img src="/images/image 8 (1).png" class="w-[260px] h-40 rounded-xl shadow object-cover">
            <img src="/images/image 8 (1).png" class="w-[260px] h-40 rounded-xl shadow object-cover">
        </div>

    </div>

    <!-- Tombol kanan (diluar overflow-hidden) -->
    <button id="nextBtn"
        class="absolute right-[calc(50%-470px)] top-1/2 -translate-y-1/2 
        bg-white shadow rounded-full w-10 h-10 flex items-center justify-center z-30">
        ›
    </button>

</div>


    <!-- NOW SHOWING SECTION -->
    <div class="mt-16 w-full flex flex-col items-center">

        <h2 class="text-3xl font-bold mb-6">NOW SHOWING IN CINEMAS</h2>

        <div class="relative w-[900px]">

            <!-- Tombol kiri -->
            <button id="nowLeft" class="absolute left-0 top-1/2 -translate-y-1/2 bg-white rounded-full shadow p-2 z-10">
                ‹
            </button>

            <!-- Container slider -->
            <div id="nowSlider" class="overflow-hidden">
                <div class="flex gap-6 transition-transform duration-500" id="nowTrack">
                    <img src="/images/image 15.png" class="w-[200px] rounded-xl shadow" />
                    <img src="/images/image 15.png" class="w-[200px] rounded-xl shadow" />
                    <img src="/images/image 15.png" class="w-[200px] rounded-xl shadow" />
                    <img src="/images/image 15.png" class="w-[200px] rounded-xl shadow" />
                    <img src="/images/image 15.png" class="w-[200px] rounded-xl shadow" />
                    <img src="/images/image 15.png" class="w-[200px] rounded-xl shadow" />
                </div>
            </div>

            <!-- Tombol kanan -->
            <button id="nowRight"
                class="absolute right-0 top-1/2 -translate-y-1/2 bg-white rounded-full shadow p-2 z-10">
                ›
            </button>
        </div>
    </div>




    <!-- JS -->
    <script>
        /* ================================
    SLIDER PROMOSI (fix lengkap)
================================ */
        const promoTrack = document.getElementById("carousel");
        const promoLeft = document.getElementById("prevBtn");
        const promoRight = document.getElementById("nextBtn");

        let promoIndex = 0;

        // ukuran item (260px) + gap (24px)
        const promoItemWidth = 260 + 24;

        // total container hanya muat 3 item → hitungan benar
        const maxIndex = promoTrack.children.length - 3;

        function slidePromo(dir) {
            promoIndex += dir;

            if (promoIndex < 0) promoIndex = 0;
            if (promoIndex > maxIndex) promoIndex = maxIndex;

            promoTrack.style.transform =
                `translateX(-${promoIndex * promoItemWidth}px)`;
        }

        promoLeft.addEventListener("click", () => slidePromo(-1));
        promoRight.addEventListener("click", () => slidePromo(1));

        let promoAuto = setInterval(() => slidePromo(1), 3000);

        promoTrack.addEventListener("mouseenter", () => clearInterval(promoAuto));
        promoTrack.addEventListener("mouseleave", () => {
            promoAuto = setInterval(() => slidePromo(1), 3000);
        });





        /* ======================================
            SLIDER NOW SHOWING (sesuai HTML)
        ====================================== */
        const nowTrack = document.getElementById("nowTrack");
        const nowLeft = document.getElementById("nowLeft");
        const nowRight = document.getElementById("nowRight");

        let nowIndex = 0;
        const nowItemWidth = 200 + 24;

        function slideNow(dir) {
            nowIndex += dir;

            // tampil 4 item
            const maxNow = nowTrack.children.length - 4;

            if (nowIndex < 0) nowIndex = 0;
            if (nowIndex > maxNow) nowIndex = maxNow;

            nowTrack.style.transform =
                `translateX(-${nowIndex * nowItemWidth}px)`;
        }

        nowLeft.addEventListener("click", () => slideNow(-1));
        nowRight.addEventListener("click", () => slideNow(1));

        let nowAuto = setInterval(() => slideNow(1), 3200);

        nowTrack.addEventListener("mouseenter", () => clearInterval(nowAuto));
        nowTrack.addEventListener("mouseleave", () => {
            nowAuto = setInterval(() => slideNow(1), 3200);
        });
    </script>

<script>
    document.documentElement.classList.remove('dark');
</script>

<script>
  tailwind.config = {
    darkMode: 'class'
  }
</script>


</body>

</html>/*