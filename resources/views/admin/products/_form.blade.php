<div class="mb-3">
    <label for="category_id" class="form-label">Product Category</label>
    <select class="form-select" id="category_id" name="category_id" required>
        <option value="" disabled {{ old('category_id', $product->category_id ?? '') ? '' : 'selected' }}>Select Category</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id ?? '') == $category->id)>
                {{ $category->category_name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="product_name" class="form-label">Product Name</label>
    <input type="text" class="form-control" id="product_name" name="product_name"
        value="{{ old('product_name', $product->product_name ?? '') }}" required>
    @error('product_name')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="product_description" class="form-label">Product Description</label>
    <textarea class="form-control" id="product_description" name="product_description" rows="4">{{ old('product_description', $product->product_description ?? '') }}</textarea>
    @error('product_description')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="price" class="form-label">Price (KES)</label>
    <input type="number" step="0.01" min="0" class="form-control" id="price" name="price"
        value="{{ old('price', $product->price ?? '') }}" placeholder="e.g. 1500.00">
    @error('price')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

@include('admin.partials.status-field', ['model' => $product ?? null])

<div class="mb-3">
    <label for="product_picture" class="form-label">Product Picture</label>
    <input type="file" accept="image/*" class="form-control" id="product_picture" name="product_picture"
        {{ isset($product) ? '' : 'required' }}>
    @error('product_picture')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
    @isset($product)
        @if ($product->product_picture)
            <img src="{{ asset('storage/' . $product->product_picture) }}" alt="" class="mt-2" style="max-height: 80px;">
        @endif
    @endisset
</div>

<div class="form-check mb-3">
    <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" value="1"
        {{ old('is_featured', $product->is_featured ?? false) ? 'checked' : '' }}>
    <label class="form-check-label" for="is_featured">Featured product</label>
</div>
