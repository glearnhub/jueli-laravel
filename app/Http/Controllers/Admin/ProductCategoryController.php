<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\ExportsCsv;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductCategoryController extends Controller
{
    use ExportsCsv;

    public function index(): View
    {
        $categories = $this->filteredQuery()->paginate(10)->withQueryString();

        $stats = [
            ['value' => ProductCategory::count(), 'label' => 'Total Categories'],
            ['value' => ProductCategory::has('products')->count(), 'label' => 'With Products'],
        ];

        return view('admin.categories.index', compact('categories', 'stats'));
    }

    public function export()
    {
        $categories = $this->filteredQuery()->get();

        $headings = ['#', 'Category Name', 'Description', 'Products', 'Status', 'Date Created'];
        $rows = [];

        foreach ($categories as $index => $category) {
            $rows[] = [
                $index + 1,
                $category->category_name,
                $category->description,
                $category->products_count,
                ucfirst($category->status),
                $category->created_at->format('Y-m-d'),
            ];
        }

        return $this->respondWithExport($headings, $rows, 'Product Categories Report', 'categories');
    }

    private function filteredQuery(): Builder
    {
        return ProductCategory::withCount('products')
            ->when(request('search'), fn ($query, $search) => $query->where('category_name', 'like', "%{$search}%"))
            ->when(request('status'), fn ($query, $status) => $query->where('status', $status))
            ->when(request('date_from'), fn ($query, $date) => $query->whereDate('created_at', '>=', $date))
            ->when(request('date_to'), fn ($query, $date) => $query->whereDate('created_at', '<=', $date))
            ->latest();
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('categories', 'public');
        }

        ProductCategory::create($data);

        return redirect()->route('admin.categories.index')->with('status', 'Category added successfully.');
    }

    public function edit(ProductCategory $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, ProductCategory $category): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('picture')) {
            if ($category->picture) {
                Storage::disk('public')->delete($category->picture);
            }
            $data['picture'] = $request->file('picture')->store('categories', 'public');
        }

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('status', 'Category updated successfully.');
    }

    public function destroy(ProductCategory $category): RedirectResponse
    {
        if ($category->picture) {
            Storage::disk('public')->delete($category->picture);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('status', 'Category deleted successfully.');
    }
}
