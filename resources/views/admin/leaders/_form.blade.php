<div class="mb-3">
    <label for="fullname" class="form-label">Name</label>
    <input type="text" class="form-control" id="fullname" name="fullname"
        value="{{ old('fullname', $leader->fullname ?? '') }}" required>
    @error('fullname')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="position" class="form-label">Position</label>
    <input type="text" class="form-control" id="position" name="position"
        value="{{ old('position', $leader->position ?? '') }}" required>
    @error('position')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="department" class="form-label">Department</label>
    <input type="text" class="form-control" id="department" name="department"
        value="{{ old('department', $leader->department ?? '') }}">
    @error('department')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="phone_number" class="form-label">Phone Number</label>
    <input type="text" class="form-control" id="phone_number" name="phone_number"
        value="{{ old('phone_number', $leader->phone_number ?? '') }}" required>
    @error('phone_number')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email"
        value="{{ old('email', $leader->email ?? '') }}">
    @error('email')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

@include('admin.partials.status-field', ['model' => $leader ?? null])

<div class="mb-3">
    <label for="profile_picture" class="form-label">Profile Picture</label>
    <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*"
        {{ isset($leader) ? '' : 'required' }}>
    @error('profile_picture')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
    @isset($leader)
        @if ($leader->profile_picture)
            <img src="{{ asset('storage/' . $leader->profile_picture) }}" alt="" class="mt-2" style="max-height: 80px;">
        @endif
    @endisset
</div>
