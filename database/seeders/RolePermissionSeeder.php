<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['slug' => 'products.view', 'name' => 'View Products', 'group' => 'Products'],
            ['slug' => 'products.manage', 'name' => 'Manage Products', 'group' => 'Products'],
            ['slug' => 'categories.view', 'name' => 'View Categories', 'group' => 'Categories'],
            ['slug' => 'categories.manage', 'name' => 'Manage Categories', 'group' => 'Categories'],
            ['slug' => 'leaders.view', 'name' => 'View Team', 'group' => 'Team'],
            ['slug' => 'leaders.manage', 'name' => 'Manage Team', 'group' => 'Team'],
            ['slug' => 'messages.view', 'name' => 'View Messages', 'group' => 'Messages'],
            ['slug' => 'settings.manage', 'name' => 'Manage Website Settings', 'group' => 'Settings'],
            ['slug' => 'users.manage', 'name' => 'Manage Admin Users', 'group' => 'Settings'],
            ['slug' => 'roles.manage', 'name' => 'Manage Roles & Permissions', 'group' => 'Settings'],
            ['slug' => 'activity_logs.view', 'name' => 'View Activity Logs', 'group' => 'Settings'],
        ];

        foreach ($permissions as $permission) {
            Permission::query()->updateOrCreate(['slug' => $permission['slug']], $permission);
        }

        $allSlugs = collect($permissions)->pluck('slug');

        $superAdmin = Role::query()->updateOrCreate(
            ['slug' => 'super-admin'],
            ['name' => 'Super Admin']
        );
        $superAdmin->permissions()->sync(Permission::whereIn('slug', $allSlugs)->pluck('id'));

        $manager = Role::query()->updateOrCreate(
            ['slug' => 'manager'],
            ['name' => 'Manager']
        );
        $manager->permissions()->sync(Permission::whereIn('slug', [
            'products.view', 'products.manage',
            'categories.view', 'categories.manage',
            'leaders.view', 'leaders.manage',
            'messages.view',
        ])->pluck('id'));

        $editor = Role::query()->updateOrCreate(
            ['slug' => 'editor'],
            ['name' => 'Editor']
        );
        $editor->permissions()->sync(Permission::whereIn('slug', [
            'products.view', 'products.manage',
            'categories.view', 'categories.manage',
            'leaders.view', 'leaders.manage',
        ])->pluck('id'));
    }
}
