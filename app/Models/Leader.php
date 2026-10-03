<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Leader extends Model
{
    use LogsActivity;

    protected $fillable = [
        'fullname',
        'position',
        'department',
        'phone_number',
        'email',
        'profile_picture',
        'status',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'active');
    }
}
