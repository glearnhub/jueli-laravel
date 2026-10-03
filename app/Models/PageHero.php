<?php

namespace App\Models;

use App\Models\Concerns\HasImage;
use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class PageHero extends Model
{
    use HasImage, LogsActivity;

    public const PAGES = [
        'about' => 'About Us',
        'contact' => 'Contact Us',
    ];

    public const DEFAULT_IMAGE = 'img/bg_4.jpg';

    protected $fillable = [
        'page',
        'title',
        'description',
        'image',
    ];

    public static function forPage(string $page): self
    {
        return static::firstOrNew(['page' => $page]);
    }

    public function getPageLabelAttribute(): string
    {
        return self::PAGES[$this->page] ?? ucfirst($this->page);
    }

    public function activityLogLabel(): string
    {
        return $this->page_label.' page hero';
    }
}
