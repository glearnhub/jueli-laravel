<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $categories = ProductCategory::active()->orderBy('category_name')->get();

        // Only a real, visible category counts as a filter; anything else shows every product.
        $requested = (int) request('category');
        $currentCategoryId = $categories->contains('id', $requested) ? $requested : null;

        $products = Product::active()
            ->with('category')
            ->when($currentCategoryId, fn ($query, $categoryId) => $query->where('category_id', $categoryId))
            // A product can be listed under several categories; the all-products view shows it once.
            ->unless($currentCategoryId, fn ($query) => $query->whereNotExists(
                fn ($dupe) => $dupe->from('products as earlier')
                    ->whereColumn('earlier.product_name', 'products.product_name')
                    ->whereColumn('earlier.id', '<', 'products.id')
                    ->where('earlier.status', 'active')
            ))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        if ($products->currentPage() > $products->lastPage()) {
            return redirect()->route('shop', array_merge(request()->query(), ['page' => $products->lastPage()]));
        }

        return view('shop', compact('categories', 'products', 'currentCategoryId'));
    }
}
