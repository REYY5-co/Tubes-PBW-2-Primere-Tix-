@extends('admin.layout')

@section('content')
<div class="p-6 max-w-xl">
    <h1 class="text-2xl font-bold mb-6">Edit Film</h1>

    <form action="{{ route('admin.films.update', $film->id) }}"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-4">

        @csrf
        @method('PUT')

        <!-- TITLE -->
        <div>
            <label class="block mb-1">Judul</label>
            <input type="text" name="title"
                   value="{{ old('title', $film->title) }}"
                   class="w-full border px-3 py-2 rounded">
        </div>

        <!-- YEAR -->
        <div>
            <label class="block mb-1">Tahun</label>
            <input type="number" name="year"
                   value="{{ old('year', $film->year) }}"
                   class="w-full border px-3 py-2 rounded">
        </div>

        <!-- STATUS -->
        <div>
            <label class="block mb-1">Status</label>
            <select name="status" class="w-full border px-3 py-2 rounded">
                <option value="coming_soon"
                    {{ old('status', $film->status) == 'coming_soon' ? 'selected' : '' }}>
                    Coming Soon
                </option>
                <option value="now_showing"
                    {{ old('status', $film->status) == 'now_showing' ? 'selected' : '' }}>
                    Now Showing
                </option>
                <option value="next_week"
                    {{ old('status', $film->status) == 'next_week' ? 'selected' : '' }}>
                    Next Week
                </option>
            </select>
        </div>

        <!-- POSTER -->
        <div>
            <label class="block mb-1">Poster</label>
            @if($film->poster)
                <img src="{{ asset('storage/'.$film->poster) }}" class="w-32 mb-2">
            @endif
            <input type="file" name="poster">
        </div>

        <div>
    <label class="block font-semibold mb-1">Sinopsis</label>
    <textarea name="synopsis"
        class="w-full border rounded px-3 py-2"
        rows="5">{{ old('synopsis', $film->synopsis) }}</textarea>
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
    <label class="block font-semibold mb-1">Trailer </label>
    <input type="text"
        name="trailer_url"
        value="{{ old('trailer_url', $film->trailer_url) }}"
        class="w-full border rounded px-3 py-2">
</div>


        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Update
        </button>
    </form>
</div>
@endsection
