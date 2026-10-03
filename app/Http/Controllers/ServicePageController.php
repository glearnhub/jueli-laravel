<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceHeroSlide;
use Illuminate\View\View;

class ServicePageController extends Controller
{
    public function index(): View
    {
        $slides = ServiceHeroSlide::published()->get();
        $services = Service::published()->get();

        return view('services', compact('slides', 'services'));
    }

    public function show(Service $service): View
    {
        abort_unless($service->status === 'active', 404);

        $pictures = $service->images->pluck('image_url')->filter()->values();

        if ($pictures->isEmpty() && $service->image_url) {
            $pictures = collect([$service->image_url]);
        }

        $others = Service::published()->where('id', '!=', $service->id)->take(3)->get();

        return view('service-show', compact('service', 'pictures', 'others'));
    }
}
