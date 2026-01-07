@extends('admin.layout')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Tambah Film</h1>

    <form action="{{ route('admin.film.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 max-w-xl">
        @csrf

        <!-- TITLE -->
        <div>
            <label class="block font-semibold">Judul Film</label>
            <input type="text" name="title" class="w-full border rounded px-3 py-2" required>
        </div>

        <!-- SLUG -->
        <div>
            <label class="block font-semibold">Slug</label>
            <input type="text" name="slug" class="w-full border rounded px-3 py-2" placeholder="contoh: agak-laen-2"
                required>
        </div>

        <!-- POSTER -->
        <div>
            <label class="block font-semibold">Poster</label>
            <input type="file" name="poster" class="w-full border rounded px-3 py-2" accept="image/*" required>
        </div>

        <!-- STATUS -->
        <div>
            <label class="block font-semibold">Status</label>
           <select name="status">
    <option value="coming_soon">Coming Soon</option>
    <option value="now_showing">Now Showing</option>
    <option value="next_week">Next Week</option>
</select>

        </div>

        <!-- TAHUN -->
        <div>
            <label class="block font-semibold">Tahun</label>
            <input type="number" name="year" value="{{ old('year', $film->year ?? '') }}">

        </div>
        <div>
    <label class="block font-semibold mb-1">Sinopsis</label>
    <textarea name="synopsis"
        class="w-full border rounded px-3 py-2"
        rows="5">{{ old('synopsis') }}</textarea>
</div>
<!-- RATING -->
<div>
    <label class="block font-semibold">Rating</label>
    <input type="number" step="0.1" max="10" name="rating"
           value="{{ old('rating', $film->rating ?? '') }}"
           class="w-full border rounded px-3 py-2">
</div>

<!-- SUTRADARA -->
<div>
    <label class="block font-semibold">Sutradara</label>
    <input type="text" name="director"
           value="{{ old('director', $film->director ?? '') }}"
           class="w-full border rounded px-3 py-2">
</div>

<!-- PENULIS -->
<div>
    <label class="block font-semibold">Penulis</label>
    <input type="text" name="writer"
           value="{{ old('writer', $film->writer ?? '') }}"
           class="w-full border rounded px-3 py-2">
</div>

<!-- AKTOR -->
<div>
    <label class="block font-semibold">Aktor (pisahkan dengan koma)</label>
    <textarea name="cast"
        class="w-full border rounded px-3 py-2"
        rows="3">{{ old('cast', $film->cast ?? '') }}</textarea>
</div>


<div>
    <label class="block font-semibold mb-1">Trailer</label>
    <input type="text"
        name="trailer_url"
        class="w-full border rounded px-3 py-2"
        placeholder="https://www.youtube.com/watch?v=xxxx">
</div>


        <button type="submit" class="px-6 py-2 bg-black text-white rounded">
            Simpan
        </button>
    </form>
@endsection