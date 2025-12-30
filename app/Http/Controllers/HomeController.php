<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
class HomeController extends Controller
{
    public function index()
    {
        $nowShowing = Film::where('status', 'now_showing')->get();

        return view('homepage', compact('nowShowing'));
    }

}
