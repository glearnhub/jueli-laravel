@extends('layouts.admin')

@section('title', 'Edit '.$hero->page_label.' Hero - Admin')

@section('content')
    <div class="card" style="max-width: 700px;">
        <div class="card-header"><strong>{{ $hero->page_label }} Page Hero</strong></div>
        <div class="card-body">
            <form action="{{ route('admin.page-heroes.update', $hero) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Heading</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $hero->title) }}">
                    @error('title') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Text under the heading</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $hero->description) }}</textarea>
                    @error('description') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Background Image</label>
                    <input type="file" accept="image/*" class="form-control" id="image" name="image">
                    <div class="form-text">Wide landscape images (about 1600x700) look best. Leave empty to keep the current background.</div>
                    @error('image') <div class="text-danger small">{{ $message }}</div> @enderror

                    <img src="{{ $hero->image_url ?? asset(\App\Models\PageHero::DEFAULT_IMAGE) }}" alt="" class="mt-2 rounded d-block" style="max-height: 110px;">
                    <div class="small text-muted">{{ $hero->image ? 'Current: custom image' : 'Current: default background' }}</div>

                    @if ($hero->image)
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" name="remove_image" value="1" id="remove_image">
                            <label class="form-check-label" for="remove_image">Remove custom image and use the default background</label>
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('admin.page-heroes.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
