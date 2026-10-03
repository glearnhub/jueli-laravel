<?php

namespace Database\Seeders;

use App\Models\PageHero;
use Illuminate\Database\Seeder;

class PageHeroSeeder extends Seeder
{
    public function run(): void
    {
        // firstOrCreate so re-seeding never overwrites banners edited in the admin panel.
        PageHero::firstOrCreate(['page' => 'about'], [
            'title' => 'Quality Engineering Products',
            'description' => 'Premium engineering supplies and equipment for all your project needs',
        ]);

        PageHero::firstOrCreate(['page' => 'contact'], [
            'title' => null,
            'description' => null,
        ]);
    }
}
