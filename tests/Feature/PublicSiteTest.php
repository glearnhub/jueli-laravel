<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicSiteTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_pages_load(): void
    {
        foreach (['/', '/about', '/services', '/shop', '/contact'] as $path) {
            $this->get($path)->assertOk()->assertSee('<h1', false);
        }
    }

    public function test_unknown_page_shows_branded_404(): void
    {
        $this->get('/does-not-exist')->assertNotFound()->assertSee('Page not found');
    }

    public function test_shop_hides_draft_products_and_inactive_categories(): void
    {
        $live = ProductCategory::create(['category_name' => 'Live Cat', 'status' => 'active']);
        $hidden = ProductCategory::create(['category_name' => 'Hidden Cat', 'status' => 'draft']);
        Product::create(['category_id' => $live->id, 'product_name' => 'Visible Item', 'status' => 'active']);
        Product::create(['category_id' => $live->id, 'product_name' => 'Draft Item', 'status' => 'draft']);

        $this->get('/shop')
            ->assertSee('Visible Item')
            ->assertDontSee('Draft Item')
            ->assertSee('Live Cat')
            ->assertDontSee('Hidden Cat');
    }

    public function test_shop_out_of_range_page_redirects_to_last_page(): void
    {
        $this->get('/shop?page=99')->assertRedirect();
    }

    public function test_contact_form_stores_message_and_validates(): void
    {
        $this->post('/contact', [])->assertSessionHasErrors();

        $this->post('/contact', [
            'name' => 'Jane', 'email' => 'jane@example.com', 'subject' => 'Hi', 'message' => 'Hello there',
        ])->assertSessionHas('status');

        $this->assertDatabaseCount('contact_messages', 1);
    }

    public function test_contact_form_is_rate_limited(): void
    {
        $payload = ['name' => 'Jane', 'email' => 'jane@example.com', 'subject' => 'Hi', 'message' => 'Hello there'];

        for ($i = 0; $i < 5; $i++) {
            $this->post('/contact', $payload);
        }

        $this->post('/contact', $payload)->assertStatus(429);
        $this->assertSame(5, ContactMessage::count());
    }
}
