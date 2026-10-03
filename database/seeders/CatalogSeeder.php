<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

/**
 * Loads the imported product catalog (database/data/catalog.json).
 *
 * Safe to re-run: categories are matched by name and products by
 * (category, name), so existing rows are left untouched. The matching photos
 * live in storage/app/public/{products,categories}.
 */
class CatalogSeeder extends Seeder
{
    public function run(): void
    {
        $catalog = json_decode(file_get_contents(database_path('data/catalog.json')), true, flags: JSON_THROW_ON_ERROR);
        $now = now();

        foreach ($catalog as $entry) {
            $category = ProductCategory::firstOrCreate(
                ['category_name' => $entry['category_name']],
                [
                    'description' => $entry['description'],
                    'picture' => $entry['picture'],
                    'status' => $entry['status'],
                ],
            );

            $existing = $category->products()->pluck('product_name')->map(fn ($name) => mb_strtolower($name))->flip();

            $rows = collect($entry['products'])
                ->reject(fn ($product) => $existing->has(mb_strtolower($product['product_name'])))
                ->map(fn ($product) => $product + ['category_id' => $category->id, 'created_at' => $now, 'updated_at' => $now])
                ->all();

            // Bulk insert: ~1,000 rows through Eloquent events/activity logging would be needlessly slow.
            Product::insert($rows);
        }
    }
}
