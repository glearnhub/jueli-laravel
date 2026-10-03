<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $categories = ProductCategory::active()->orderBy('category_name')->get();

        $featuredProducts = Product::active()->where('is_featured', true)
            ->whereHas('category', fn ($q) => $q->active())
            ->with('category')->latest()->limit(8)->get();

        return view('home', compact('categories', 'featuredProducts'));
    }
}
