<div class="mb-3">
    <label for="title" class="form-label">Service Title</label>
    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $service->title ?? '') }}" required>
    @error('title') <div class="text-danger small">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $service->description ?? '') }}</textarea>
    <div class="form-text">Shown on the service card. Keep it to a sentence or two.</div>
    @error('description') <div class="text-danger small">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="details" class="form-label">Full Details <span class="text-muted small">(shown on the "Read More" page)</span></label>
    <textarea class="form-control" id="details" name="details" rows="9">{{ old('details', $service->details ?? '') }}</textarea>
    <div class="form-text">Write as much as you like. Leave a blank line between paragraphs. If empty, the short description is shown instead.</div>
    @error('details') <div class="text-danger small">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="image" class="form-label">Card Image</label>
    <input type="file" accept="image/*" class="form-control" id="image" name="image" {{ isset($service) ? '' : 'required' }}>
    @isset($service)
        @if ($service->image_url)
            <img src="{{ $service->image_url }}" alt="" class="mt-2 rounded" style="max-height: 90px;">
            <div class="form-text">Leave the file field empty to keep the current image.</div>
        @endif
    @endisset
    @error('image') <div class="text-danger small">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="gallery" class="form-label">Pictures for the "Read More" page <span class="text-muted small">(up to {{ \App\Models\Service::MAX_IMAGES }})</span></label>

    @isset($service)
        @if ($service->images->isNotEmpty())
            <div class="row g-2 mb-2">
                @foreach ($service->images as $picture)
                    <div class="col-6 col-sm-3">
                        <div class="border rounded p-1 text-center">
                            <img src="{{ $picture->image_url }}" alt="" class="img-fluid rounded" style="height: 80px; width: 100%; object-fit: cover;">
                            <div class="form-check mt-1 text-start">
                                <input class="form-check-input" type="checkbox" name="remove_images[]" value="{{ $picture->id }}" id="remove_image_{{ $picture->id }}">
                                <label class="form-check-label small" for="remove_image_{{ $picture->id }}">Remove</label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endisset

    <input type="file" accept="image/*" class="form-control" id="gallery" name="gallery[]" multiple>
    <div class="form-text">You can pick several files at once. If the service already has {{ \App\Models\Service::MAX_IMAGES }} pictures, tick "Remove" on one first. If no pictures are added, the card image is shown.</div>
    @error('gallery') <div class="text-danger small">{{ $message }}</div> @enderror
    @error('gallery.*') <div class="text-danger small">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="sort_order" class="form-label">Display Order</label>
    <input type="number" min="0" class="form-control" id="sort_order" name="sort_order" value="{{ old('sort_order', $service->sort_order ?? '') }}" placeholder="Leave empty to add at the end">
    <div class="form-text">Lower numbers appear first.</div>
    @error('sort_order') <div class="text-danger small">{{ $message }}</div> @enderror
</div>

@include('admin.partials.status-field', ['model' => $service ?? null])
<div class="form-text mb-3 mt-n2">Only <strong>Active</strong> services are shown on the website.</div>
