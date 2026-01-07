<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $film->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white px-6 py-10">

<div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-10">

    <!-- POSTER -->
    <div>
        <img src="{{ asset('storage/'.$film->poster) }}"
             class="rounded-xl shadow-lg w-full">
    </div>

    <!-- INFO -->
    <div class="md:col-span-2">
        <h1 class="text-4xl font-bold mb-4">
            {{ $film->title }}
        </h1>

        <div class="flex items-center gap-4 mb-6">
            <span class="px-4 py-1 bg-gray-200 rounded-full text-sm font-semibold">
                {{ strtoupper(str_replace('_',' ', $film->status)) }}
            </span>

            <span class="text-gray-500">
                {{ $film->year }}
            </span>
        </div>

        <!-- SINOPSIS -->
        <h2 class="text-xl font-semibold mb-2">Sinopsis</h2>
        <p class="text-gray-700 leading-relaxed mb-6">
            {{ $film->synopsis ?? 'Sinopsis belum tersedia.' }}
        </p>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6 text-sm">

    @if($film->rating)
    <div>
        <p class="text-gray-500">Rating</p>
        <p class="font-bold text-lg">⭐ {{ $film->rating }}/10</p>
    </div>
    @endif

    @if($film->director)
    <div>
        <p class="text-gray-500">Sutradara</p>
        <p class="font-semibold">{{ $film->director }}</p>
    </div>
    @endif

    @if($film->writer)
    <div>
        <p class="text-gray-500">Penulis</p>
        <p class="font-semibold">{{ $film->writer }}</p>
    </div>
    @endif

    @if($film->cast)
    <div class="col-span-2 md:col-span-4">
        <p class="text-gray-500">Aktor</p>
        <p class="font-semibold">{{ $film->cast }}</p>
    </div>
    @endif

</div>


        <!-- TRAILER -->
      @if($film->trailer_url)
    <div class="mt-8">
        <iframe
            class="w-full aspect-video rounded-2xl shadow-lg"
            src="{{ str_replace('watch?v=', 'embed/', $film->trailer_url) }}"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
        </iframe>
    </div>
@endif


        <!-- ACTION -->
        <div class="mt-8">
            @if($film->status === 'now_showing')
                <a href="{{ route('jadwal') }}"
               class="inline-block px-8 py-3 bg-black text-white rounded-full text-lg hover:bg-gray-800 transition">
                🎟 Book Ticket
            </a>
            @else
                <span class="bg-gray-400 text-white px-8 py-3 rounded-xl inline-block">
                    Belum Tayang
                </span>
            @endif
        </div>
    </div>
</div>

</body>
</html>
