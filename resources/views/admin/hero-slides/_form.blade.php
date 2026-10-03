<div class="mb-3">
    <label for="title" class="form-label">Heading</label>
    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $slide->title ?? '') }}" required>
    @error('title') <div class="text-danger small">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Text under the heading</label>
    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $slide->description ?? '') }}</textarea>
    @error('description') <div class="text-danger small">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="image" class="form-label">Background Image</label>
    <input type="file" accept="image/*" class="form-control" id="image" name="image" {{ isset($slide) ? '' : 'required' }}>
    <div class="form-text">Wide landscape images (about 1600x700) look best.</div>
    @isset($slide)
        @if ($slide->image_url)
            <img src="{{ $slide->image_url }}" alt="" class="mt-2 rounded" style="max-height: 90px;">
            <div class="form-text">Leave the file field empty to keep the current image.</div>
        @endif
    @endisset
    @error('image') <div class="text-danger small">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="sort_order" class="form-label">Display Order</label>
    <input type="number" min="0" class="form-control" id="sort_order" name="sort_order" value="{{ old('sort_order', $slide->sort_order ?? '') }}" placeholder="Leave empty to add at the end">
    <div class="form-text">Lower numbers appear first in the slider.</div>
    @error('sort_order') <div class="text-danger small">{{ $message }}</div> @enderror
</div>

@include('admin.partials.status-field', ['model' => $slide ?? null])
<div class="form-text mb-3 mt-n2">Only <strong>Active</strong> slides are shown on the website.</div>
