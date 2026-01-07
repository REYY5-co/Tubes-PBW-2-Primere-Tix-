@extends('admin.layout')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Kelola Film</h1>

    <a href="{{ route('admin.films.create') }}" class="px-4 py-2 bg-black text-white rounded">
        + Tambah Film
    </a>

    <table class="w-full mt-6 border">
        <tr class="bg-gray-100">
            <th class="p-2">Poster</th>
            <th>Judul</th>
            <th>Genre</th>
            <th>Aksi</th>
        </tr>

        @foreach($films as $film)
            <tr class="border-t">
                <td class="p-2">
                    <img src="{{ asset('storage/' . $film->poster) }}" class="w-16">
                </td>
                <td>{{ $film->title }}</td>
                <td>{{ $film->genre }}</td>
                <td>
                    <a href="{{ route('admin.films.edit', $film->id) }}" class="text-blue-600">
                        Edit
                    </a>


                    <form action="{{ route('admin.films.destroy', $film) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection