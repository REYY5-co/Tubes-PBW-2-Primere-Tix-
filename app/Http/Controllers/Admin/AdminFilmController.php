<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminFilmController extends Controller
{
    public function index()
    {
        $films = Film::all();
        return view('admin.films.index', compact('films'));
    }

    public function create()
    {
        return view('admin.films.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'poster' => 'required|image',
            'status' => 'required',
            'year' => 'required|integer',
            'synopsis' => 'nullable',
            'rating' => $request->rating,
            'director' => $request->director,
            'writer' => $request->writer,
            'cast' => $request->cast,


            'trailer_url' => 'nullable',
        ]);

        $data['slug'] = Str::slug($request->title);
        $data['poster'] = $request->file('poster')->store('films', 'public');

        Film::create($data);

        return redirect()->route('admin.films.index')
            ->with('success', 'Film berhasil ditambahkan');
    }


    public function edit(Film $film)
    {
        return view('admin.films.edit', compact('film'));
    }

    public function update(Request $request, Film $film)
    {
        $data = $request->validate([
            'title' => 'required',
            'year' => 'required|integer',
            'status' => 'required|in:coming_soon,now_showing,next_week',
            'synopsis' => 'nullable',
            'trailer_url' => 'nullable',
            'rating' => 'nullable|numeric|max:10',
            'director' => 'nullable|string',
            'writer' => 'nullable|string',
            'cast' => 'nullable|string',

            'poster' => 'nullable|image',
        ]);

        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('films', 'public');
        }

        $film->update($data);

        return redirect()->route('admin.films.index')
            ->with('success', 'Film berhasil diupdate');
    }


    public function destroy(Film $film)
    {
        $film->delete();
        return back()->with('success', 'Film berhasil dihapus');
    }
}
