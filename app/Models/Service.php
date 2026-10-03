<?php

namespace App\Models;

use App\Models\Concerns\HasImage;
use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasImage, LogsActivity;

    public const MAX_IMAGES = 4;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'details',
        'image',
        'sort_order',
        'status',
    ];

    protected static function booted(): void
    {
        // The slug is set once and never changed, so shared links keep working after a title edit.
        static::creating(function (Service $service) {
            if (empty($service->slug)) {
                $service->slug = static::uniqueSlug($service->title);
            }
        });
    }

    public static function uniqueSlug(string $title): string
    {
        $base = Str::slug($title) ?: 'service';
        $slug = $base;
        $suffix = 2;

        while (static::where('slug', $slug)->exists()) {
            $slug = $base.'-'.$suffix++;
        }

        return $slug;
    }

    public function images(): HasMany
    {
        return $this->hasMany(ServiceImage::class)->orderBy('sort_order')->orderBy('id');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'active')->orderBy('sort_order')->orderBy('id');
    }
}
