<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $categories = ProductCategory::orderBy('category_name')->get();

        return view('home', compact('categories'));
    }
}
