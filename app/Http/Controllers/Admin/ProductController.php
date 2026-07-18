<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\ExportsCsv;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    use ExportsCsv;

    public function index(): View
    {
        $products = $this->filteredQuery()->paginate(10)->withQueryString();

        $categories = ProductCategory::orderBy('category_name')->get();

        $stats = [
            ['value' => Product::count(), 'label' => 'Total Products'],
            ['value' => Product::where('is_featured', true)->count(), 'label' => 'Featured'],
            ['value' => ProductCategory::count(), 'label' => 'Categories'],
        ];

        return view('admin.products.index', compact('products', 'categories', 'stats'));
    }

    public function export()
    {
        $products = $this->filteredQuery()->get();

        $headings = ['#', 'Product Name', 'Category', 'Description', 'Price', 'Status', 'Featured', 'Date Added'];
        $rows = [];

        foreach ($products as $index => $product) {
            $rows[] = [
                $index + 1,
                $product->product_name,
                $product->category?->category_name,
                $product->product_description,
                $product->price,
                ucfirst($product->status),
                $product->is_featured ? 'Yes' : 'No',
                $product->created_at->format('Y-m-d'),
            ];
        }

        return $this->respondWithExport($headings, $rows, 'Products Report', 'products');
    }

    private function filteredQuery(): Builder
    {
        return Product::with('category')
            ->when(request()->boolean('featured'), fn ($query) => $query->where('is_featured', true))
            ->when(request('category_id'), fn ($query, $categoryId) => $query->where('category_id', $categoryId))
            ->when(request('status'), fn ($query, $status) => $query->where('status', $status))
            ->when(request('date_from'), fn ($query, $date) => $query->whereDate('created_at', '>=', $date))
            ->when(request('date_to'), fn ($query, $date) => $query->whereDate('created_at', '<=', $date))
            ->when(request('search'), fn ($query, $search) => $query->where('product_name', 'like', "%{$search}%"))
            ->latest();
    }

    public function create(): View
    {
        $categories = ProductCategory::orderBy('category_name')->get();

        return view('admin.products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['product_picture'] = $request->file('product_picture')->store('products', 'public');
        $data['is_featured'] = $request->boolean('is_featured');

        Product::create($data);

        return redirect()->route('admin.products.index')->with('status', 'Product added successfully.');
    }

    public function edit(Product $product): View
    {
        $categories = ProductCategory::orderBy('category_name')->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('product_picture')) {
            if ($product->product_picture) {
                Storage::disk('public')->delete($product->product_picture);
            }
            $data['product_picture'] = $request->file('product_picture')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('status', 'Product updated successfully.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        if ($product->product_picture) {
            Storage::disk('public')->delete($product->product_picture);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('status', 'Product deleted successfully.');
    }
}
