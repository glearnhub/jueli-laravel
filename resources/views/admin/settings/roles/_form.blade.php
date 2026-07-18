<div class="mb-3">
    <label for="name" class="form-label">Role Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $role->name ?? '') }}"
        {{ isset($role) && $role->slug === 'super-admin' ? 'readonly' : '' }} required>
    @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
</div>

<label class="form-label">Permissions</label>
@foreach ($permissions as $group => $groupPermissions)
    <div class="mb-3">
        <h6 class="text-muted small text-uppercase">{{ $group }}</h6>
        @foreach ($groupPermissions as $permission)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                    id="permission-{{ $permission->id }}"
                    {{ in_array($permission->id, old('permissions', $rolePermissionIds ?? [])) ? 'checked' : '' }}
                    {{ isset($role) && $role->slug === 'super-admin' ? 'disabled' : '' }}>
                <label class="form-check-label" for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
            </div>
        @endforeach
    </div>
@endforeach
@error('permissions') <div class="text-danger small">{{ $message }}</div> @enderror
