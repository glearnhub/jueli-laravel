<?php

namespace App\Providers;

use App\Models\Service;
use App\Models\User;
use App\Support\SiteSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($proxies = config('app.trusted_proxies')) {
            Request::setTrustedProxies(
                $proxies === '*' ? ['*'] : array_map('trim', explode(',', $proxies)),
                Request::HEADER_X_FORWARDED_FOR | Request::HEADER_X_FORWARDED_HOST | Request::HEADER_X_FORWARDED_PORT | Request::HEADER_X_FORWARDED_PROTO
            );
        }

        // Generate https:// links (assets, redirects, sitemap) whenever the configured site URL is https.
        if (str_starts_with((string) config('app.url'), 'https://')) {
            URL::forceScheme('https');
        }

        Gate::before(function (User $user, string $ability) {
            return $user->hasPermission($ability) ?: null;
        });

        $this->app->singleton(SiteSettings::class);

        View::composer(['partials.footer', 'partials.product-modal', 'contact', 'service-show', 'layouts.app'], function ($view) {
            $view->with('site', app(SiteSettings::class));
        });

        View::composer('partials.footer', function ($view) {
            $view->with('footerServices', Service::published()->take(6)->get(['id', 'title', 'slug']));
        });
    }
}
