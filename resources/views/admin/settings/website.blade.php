@extends('layouts.admin')

@section('title', 'Website Settings - Admin')

@section('content')
    <div class="card" style="max-width: 700px;">
        <div class="card-header"><strong>Website Settings</strong></div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.settings.website.update') }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="site_name" class="form-label">Site Name</label>
                    <input type="text" class="form-control" id="site_name" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? '') }}" required>
                    @error('site_name') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="contact_email" class="form-label">Contact Email</label>
                    <input type="email" class="form-control" id="contact_email" name="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}" required>
                    @error('contact_email') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="contact_phone" class="form-label">Contact Phone</label>
                    <input type="text" class="form-control" id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}" required>
                    @error('contact_phone') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="contact_address" class="form-label">Address</label>
                    <textarea class="form-control" id="contact_address" name="contact_address" rows="2">{{ old('contact_address', $settings['contact_address'] ?? '') }}</textarea>
                    @error('contact_address') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <hr>
                <h6 class="mb-3">Social Links</h6>

                <div class="mb-3">
                    <label for="facebook_url" class="form-label">Facebook URL</label>
                    <input type="url" class="form-control" id="facebook_url" name="facebook_url" value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}">
                    @error('facebook_url') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="twitter_url" class="form-label">Twitter / X URL</label>
                    <input type="url" class="form-control" id="twitter_url" name="twitter_url" value="{{ old('twitter_url', $settings['twitter_url'] ?? '') }}">
                    @error('twitter_url') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="linkedin_url" class="form-label">LinkedIn URL</label>
                    <input type="url" class="form-control" id="linkedin_url" name="linkedin_url" value="{{ old('linkedin_url', $settings['linkedin_url'] ?? '') }}">
                    @error('linkedin_url') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="instagram_url" class="form-label">Instagram URL</label>
                    <input type="url" class="form-control" id="instagram_url" name="instagram_url" value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}">
                    @error('instagram_url') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Save Settings</button>
            </form>
        </div>
    </div>
@endsection
