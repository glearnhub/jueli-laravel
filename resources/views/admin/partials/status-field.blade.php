@php
    $current = old('status', $model?->status ?? 'active');
@endphp
<div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select class="form-select" id="status" name="status" required>
        <option value="active" @selected($current === 'active')>Active</option>
        <option value="inactive" @selected($current === 'inactive')>Inactive</option>
        <option value="draft" @selected($current === 'draft')>Draft</option>
        <option value="archived" @selected($current === 'archived')>Archived</option>
    </select>
    @error('status')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>
