<?php

namespace App\Models;

use App\Models\Concerns\HasImage;
use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ServiceHeroSlide extends Model
{
    use HasImage, LogsActivity;

    protected $fillable = [
        'title',
        'description',
        'image',
        'sort_order',
        'status',
    ];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'active')->orderBy('sort_order')->orderBy('id');
    }
}
