<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function index(): View
    {
        $categories = ProductCategory::orderBy('category_name')->get();

        $currentCategoryId = request('category');

        $products = Product::with('category')
            ->when($currentCategoryId, fn ($query, $categoryId) => $query->where('category_id', $categoryId))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('shop', compact('categories', 'products', 'currentCategoryId'));
    }
}
