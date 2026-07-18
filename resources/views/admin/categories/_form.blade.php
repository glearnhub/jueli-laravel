<div class="mb-3">
    <label for="category_name" class="form-label">Category Name</label>
    <input type="text" class="form-control" id="category_name" name="category_name"
        value="{{ old('category_name', $category->category_name ?? '') }}" required>
    @error('category_name')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $category->description ?? '') }}</textarea>
    @error('description')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

@include('admin.partials.status-field', ['model' => $category ?? null])

<div class="mb-3">
    <label for="picture" class="form-label">Picture</label>
    <input type="file" accept="image/*" class="form-control" id="picture" name="picture">
    @error('picture')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
    @isset($category)
        @if ($category->picture)
            <img src="{{ asset('storage/' . $category->picture) }}" alt="" class="mt-2" style="max-height: 80px;">
        @endif
    @endisset
</div>
