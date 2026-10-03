<?php

namespace App\Models\Concerns;

use Illuminate\Support\Facades\Storage;

trait HasImage
{
    // Seeded defaults live in public/img; images uploaded from the admin live on the public disk.
    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }

        return str_starts_with($this->image, 'img/') ? asset($this->image) : asset('storage/'.$this->image);
    }

    public function deleteStoredImage(): void
    {
        if ($this->image && ! str_starts_with($this->image, 'img/')) {
            Storage::disk('public')->delete($this->image);
        }
    }
}
