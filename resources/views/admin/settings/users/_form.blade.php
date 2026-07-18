<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name ?? '') }}" required>
    @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
    @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="role_id" class="form-label">Role</label>
    <select class="form-select" id="role_id" name="role_id" required>
        <option value="" disabled {{ old('role_id', $user->role_id ?? '') ? '' : 'selected' }}>Select Role</option>
        @foreach ($roles as $role)
            <option value="{{ $role->id }}" @selected(old('role_id', $user->role_id ?? '') == $role->id)>{{ $role->name }}</option>
        @endforeach
    </select>
    @error('role_id') <div class="text-danger small">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="password" class="form-label">Password @isset($user) <span class="text-muted small">(leave blank to keep current)</span> @endisset</label>
    <input type="password" class="form-control" id="password" name="password" {{ isset($user) ? '' : 'required' }}>
    @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="password_confirmation" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" {{ isset($user) ? '' : 'required' }}>
</div>
