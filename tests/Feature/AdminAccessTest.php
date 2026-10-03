<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    private function userWithRole(string $slug): User
    {
        $this->seed(RolePermissionSeeder::class);

        return User::factory()->create(['role_id' => Role::where('slug', $slug)->value('id')]);
    }

    public function test_guests_are_sent_to_the_admin_login(): void
    {
        $this->get('/admin/dashboard')->assertRedirect('/admin');
        $this->get('/admin')->assertOk()->assertSee('Administration Panel');
    }

    public function test_login_is_throttled(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $this->post('/admin', ['email' => 'x@example.com', 'password' => 'wrong']);
        }

        $this->post('/admin', ['email' => 'x@example.com', 'password' => 'wrong'])->assertStatus(429);
    }

    public function test_super_admin_can_open_every_admin_area(): void
    {
        $user = $this->userWithRole('super-admin');

        foreach (['dashboard', 'products', 'categories', 'services', 'hero-slides', 'page-heroes', 'leaders', 'messages', 'activity-logs', 'settings', 'users', 'roles'] as $page) {
            $uri = match ($page) {
                'dashboard' => '/admin/dashboard',
                'settings' => '/admin/settings/website',
                'users' => '/admin/users',
                'roles' => '/admin/roles',
                default => "/admin/{$page}",
            };
            $this->actingAs($user)->get($uri)->assertOk();
        }
    }

    public function test_editor_cannot_reach_settings_users_or_messages(): void
    {
        $editor = $this->userWithRole('editor');

        $this->actingAs($editor)->get('/admin/products')->assertOk();
        $this->actingAs($editor)->get('/admin/messages')->assertForbidden();
        $this->actingAs($editor)->get('/admin/users')->assertForbidden();
        $this->actingAs($editor)->get('/admin/roles')->assertForbidden();
    }

    public function test_exports_neutralise_spreadsheet_formulas(): void
    {
        $user = $this->userWithRole('super-admin');
        ContactMessage::create(['name' => 'Eve', 'email' => 'eve@example.com', 'subject' => 'Hi', 'message' => '=HYPERLINK("http://evil.test")']);

        $csv = $this->actingAs($user)->get('/admin/messages/export?format=csv')->assertOk()->getContent();

        $this->assertStringContainsString("'=HYPERLINK", $csv);
        $this->assertStringNotContainsString(',"=HYPERLINK', $csv);
    }
}
