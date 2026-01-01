<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
class HomeController extends Controller
{


    public function index(Request $request)
    {

        $nowShowing = Film::where('status', 'now_showing')->get();

        $nextWeek = Film::where('status', 'next_week')->get();
        $comingSoon = Film::where('status', 'coming_soon')->get();


        $searchResults = collect(); // default kosong

        if ($request->filled('q')) {
            $searchResults = Film::whereRaw(
                'LOWER(title) LIKE ?',
                [strtolower($request->q) . '%']
            )->get();

        }

        return view('homepage', compact('nowShowing', 'nextWeek', 'comingSoon', 'searchResults'));
    }



}
