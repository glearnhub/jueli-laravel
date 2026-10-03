<?php

namespace App\Support;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

/**
 * Read-only view of the admin "Website Settings" for the public templates,
 * cached so every page view doesn't hit the database for them.
 */
class SiteSettings
{
    public const CACHE_KEY = 'site_settings';

    private const DEFAULTS = [
        'site_name' => 'Jueli Engineering Ltd',
        'contact_email' => 'info@jueliengineeringltd.co.ke',
        'contact_phone' => '+254 704 553 400',
        'contact_address' => '15976-00100, Nairobi Industrial Area, Kenya',
    ];

    public const SOCIAL = [
        'facebook_url' => ['Facebook', 'fab fa-facebook-f'],
        'twitter_url' => ['Twitter', 'fab fa-twitter'],
        'linkedin_url' => ['LinkedIn', 'fab fa-linkedin-in'],
        'instagram_url' => ['Instagram', 'fab fa-instagram'],
    ];

    public static function forget(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    public function get(string $key): ?string
    {
        $all = Cache::rememberForever(self::CACHE_KEY, fn () => Setting::pluck('value', 'key')->all());

        return filled($all[$key] ?? null) ? $all[$key] : (self::DEFAULTS[$key] ?? null);
    }

    public function name(): string
    {
        return $this->get('site_name');
    }

    public function email(): string
    {
        return $this->get('contact_email');
    }

    public function phone(): string
    {
        return $this->get('contact_phone');
    }

    public function address(): string
    {
        return $this->get('contact_address');
    }

    /** Digits-only international number for wa.me links, e.g. "254704553400". */
    public function whatsappNumber(): string
    {
        return preg_replace('/\D+/', '', $this->phone());
    }

    public function whatsappUrl(string $message): string
    {
        return 'https://wa.me/'.$this->whatsappNumber().'?text='.rawurlencode($message);
    }

    /** @return array<int, array{label: string, icon: string, url: string}> only the networks that have a link set */
    public function socialLinks(): array
    {
        $links = [];
        foreach (self::SOCIAL as $key => [$label, $icon]) {
            if ($url = $this->get($key)) {
                $links[] = ['label' => $label, 'icon' => $icon, 'url' => $url];
            }
        }

        return $links;
    }
}
