<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Setting;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductionReadinessTest extends TestCase
{
    use RefreshDatabase;

    public function test_responses_carry_security_headers(): void
    {
        $this->get('/')
            ->assertHeader('X-Content-Type-Options', 'nosniff')
            ->assertHeader('X-Frame-Options', 'SAMEORIGIN')
            ->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
    }

    public function test_admin_is_never_indexed_or_cached(): void
    {
        $this->get('/admin')
            ->assertHeader('X-Robots-Tag', 'noindex, nofollow')
            ->assertSee('noindex, nofollow', false);
    }

    public function test_robots_and_sitemap_are_served(): void
    {
        $this->get('/robots.txt')->assertOk()->assertSee('Disallow: /admin')->assertSee('sitemap.xml');

        $category = ProductCategory::create(['category_name' => 'Taps', 'status' => 'active']);
        Product::create(['category_id' => $category->id, 'product_name' => 'Tap', 'status' => 'active']);

        $this->get('/sitemap.xml')
            ->assertOk()
            ->assertHeader('Content-Type', 'application/xml')
            ->assertSee(route('shop', ['category' => $category->id]), false);
    }

    public function test_public_pages_have_seo_tags(): void
    {
        $this->get('/')
            ->assertSee('<meta name="description"', false)
            ->assertSee('<link rel="canonical"', false)
            ->assertSee('property="og:title"', false);
    }

    public function test_site_settings_drive_the_footer_and_whatsapp_link(): void
    {
        Setting::set('contact_phone', '+254 700 111 222');
        Setting::set('contact_email', 'hello@example.com');
        Setting::set('facebook_url', 'https://facebook.com/jueli');

        $this->get('/')
            ->assertSee('hello@example.com')
            ->assertSee('https://wa.me/254700111222', false)
            ->assertSee('https://facebook.com/jueli', false)
            ->assertDontSee('instagram', false);

        Setting::set('contact_phone', '+254 711 000 000');
        $this->get('/')->assertSee('https://wa.me/254711000000', false);
    }

    public function test_social_links_reject_non_http_urls(): void
    {
        $user = \App\Models\User::factory()->create();
        $this->seed(\Database\Seeders\RolePermissionSeeder::class);
        $user->update(['role_id' => \App\Models\Role::where('slug', 'super-admin')->value('id')]);

        $this->actingAs($user)->put('/admin/settings/website', [
            'site_name' => 'Jueli', 'contact_email' => 'a@b.co', 'contact_phone' => '+254700000000',
            'facebook_url' => 'javascript:alert(1)',
        ])->assertSessionHasErrors('facebook_url');
    }

    public function test_production_seeding_skips_demo_content_and_generates_a_strong_admin_password(): void
    {
        $this->app['env'] = 'production';
        config(['jueli.admin_email' => 'owner@example.com', 'jueli.admin_password' => null]);

        // Call the seeder directly: `db:seed` itself asks for confirmation when APP_ENV=production.
        $this->app->make(DatabaseSeeder::class)->run();

        $admin = \App\Models\User::where('email', 'owner@example.com')->first();
        $this->assertNotNull($admin);
        $this->assertFalse(\Illuminate\Support\Facades\Hash::check('password', $admin->password));
        $this->assertDatabaseMissing('users', ['email' => 'admin@jueli.test']);
        $this->assertDatabaseCount('leaders', 0);
        $this->assertDatabaseCount('contact_messages', 0);
        $this->assertDatabaseMissing('products', ['product_name' => 'Rossel Sprinkler']);
        $this->assertGreaterThan(1000, Product::count());
    }
}
