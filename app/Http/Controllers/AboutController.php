<?php

namespace App\Http\Controllers;

use App\Models\Leader;
use App\Models\PageHero;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        $leaders = Leader::active()->orderBy('id')->get();
        $hero = PageHero::forPage('about');

        return view('about', compact('leaders', 'hero'));
    }
}
