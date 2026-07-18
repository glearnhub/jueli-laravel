<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRoleRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index(): View
    {
        $roles = Role::withCount('users')->orderBy('name')->get();

        return view('admin.settings.roles.index', compact('roles'));
    }

    public function create(): View
    {
        $permissions = Permission::orderBy('group')->orderBy('name')->get()->groupBy('group');

        return view('admin.settings.roles.create', compact('permissions'));
    }

    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $role = Role::create([
            'name' => $request->validated('name'),
            'slug' => Str::slug($request->validated('name')),
        ]);

        $role->permissions()->sync($request->validated('permissions', []));

        return redirect()->route('admin.roles.index')->with('status', 'Role created successfully.');
    }

    public function edit(Role $role): View
    {
        $permissions = Permission::orderBy('group')->orderBy('name')->get()->groupBy('group');
        $rolePermissionIds = $role->permissions->pluck('id')->all();

        return view('admin.settings.roles.edit', compact('role', 'permissions', 'rolePermissionIds'));
    }

    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        if ($role->slug === 'super-admin') {
            return back()->with('status', 'The Super Admin role and its permissions cannot be changed.');
        }

        $role->update(['name' => $request->validated('name')]);
        $role->permissions()->sync($request->validated('permissions', []));

        return redirect()->route('admin.roles.index')->with('status', 'Role updated successfully.');
    }

    public function destroy(Role $role): RedirectResponse
    {
        if ($role->slug === 'super-admin') {
            return back()->with('status', 'The Super Admin role cannot be deleted.');
        }

        if ($role->users()->exists()) {
            return back()->with('status', 'Cannot delete a role that is still assigned to users.');
        }

        $role->delete();

        return redirect()->route('admin.roles.index')->with('status', 'Role deleted successfully.');
    }
}
