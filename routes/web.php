<?php

use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LeaderController;
use App\Http\Controllers\Admin\PageHeroController;
use App\Http\Controllers\Admin\PasswordController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServiceHeroSlideController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\ServicePageController;
use App\Http\Controllers\ShopController;
use App\Http\Middleware\TrackPageView;
use Illuminate\Support\Facades\Route;

// Public site
Route::middleware(TrackPageView::class)->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/about', [AboutController::class, 'index'])->name('about');
    Route::get('/services', [ServicePageController::class, 'index'])->name('services');
    Route::get('/services/{service:slug}', [ServicePageController::class, 'show'])->name('services.show');
    Route::get('/shop', [ShopController::class, 'index'])->name('shop');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:5,1')->name('contact.store');
});

Route::get('/robots.txt', [SeoController::class, 'robots']);
Route::get('/sitemap.xml', [SeoController::class, 'sitemap']);

// Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/', [LoginController::class, 'create'])->name('login');
        Route::post('/', [LoginController::class, 'store'])->middleware('throttle:10,1')->name('login.store');
    });

    Route::middleware('auth')->group(function () {
        Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::middleware('permission:products.view')->group(function () {
            Route::get('products/export', [ProductController::class, 'export'])->name('products.export');
            Route::resource('products', ProductController::class)->except('show');
        });

        Route::middleware('permission:categories.view')->group(function () {
            Route::get('categories/export', [ProductCategoryController::class, 'export'])->name('categories.export');
            Route::resource('categories', ProductCategoryController::class)->except('show');
        });

        Route::middleware('permission:services.view')->group(function () {
            Route::get('services/export', [ServiceController::class, 'export'])->name('services.export');
            Route::resource('services', ServiceController::class)->except('show');
            Route::resource('hero-slides', ServiceHeroSlideController::class)
                ->parameters(['hero-slides' => 'slide'])
                ->except('show');
        });

        Route::middleware('permission:pages.view')->group(function () {
            Route::resource('page-heroes', PageHeroController::class)
                ->parameters(['page-heroes' => 'hero'])
                ->only(['index', 'edit', 'update']);
        });

        Route::middleware('permission:leaders.view')->group(function () {
            Route::get('leaders/export', [LeaderController::class, 'export'])->name('leaders.export');
            Route::resource('leaders', LeaderController::class)->except('show');
        });

        Route::middleware('permission:messages.view')->group(function () {
            Route::get('messages/export', [ContactMessageController::class, 'export'])->name('messages.export');
            Route::get('messages', [ContactMessageController::class, 'index'])->name('messages.index');
            Route::get('messages/{message}', [ContactMessageController::class, 'show'])->name('messages.show');
        });

        Route::middleware('permission:activity_logs.view')->group(function () {
            Route::get('activity-logs/export', [ActivityLogController::class, 'export'])->name('activity-logs.export');
            Route::get('activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
        });

        Route::middleware('permission:settings.manage')->group(function () {
            Route::get('settings/website', [SettingController::class, 'edit'])->name('settings.website.edit');
            Route::put('settings/website', [SettingController::class, 'update'])->name('settings.website.update');
        });

        Route::middleware('permission:users.manage')->group(function () {
            Route::resource('users', UserController::class)->except('show');
        });

        Route::middleware('permission:roles.manage')->group(function () {
            Route::resource('roles', RoleController::class)->except('show');
        });

        Route::get('password', [PasswordController::class, 'edit'])->name('password.edit');
        Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    });
});
