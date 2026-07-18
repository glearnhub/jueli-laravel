<?php

namespace App\Http\Controllers;

use App\Models\Leader;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        $leaders = Leader::orderBy('id')->get();

        return view('about', compact('leaders'));
    }
}
