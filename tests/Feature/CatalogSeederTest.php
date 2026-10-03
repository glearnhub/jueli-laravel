<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductCategory;
use Database\Seeders\CatalogSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatalogSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_seeder_loads_the_catalog_and_is_safe_to_rerun(): void
    {
        $this->seed(CatalogSeeder::class);

        $products = Product::count();
        $categories = ProductCategory::count();
        $this->assertGreaterThan(1000, $products);
        $this->assertGreaterThan(40, $categories);

        $this->seed(CatalogSeeder::class);

        $this->assertSame($products, Product::count());
        $this->assertSame($categories, ProductCategory::count());
    }

    public function test_every_seeded_photo_exists_in_storage(): void
    {
        $this->seed(CatalogSeeder::class);

        $missing = Product::pluck('product_picture')
            ->merge(ProductCategory::pluck('picture'))
            ->filter()
            ->unique()
            ->reject(fn ($path) => is_file(storage_path('app/public/'.$path)));

        $this->assertSame([], $missing->values()->all());
    }
}
