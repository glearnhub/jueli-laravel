<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceHeroSlideRequest;
use App\Models\ServiceHeroSlide;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServiceHeroSlideController extends Controller
{
    public function index(): View
    {
        $slides = ServiceHeroSlide::orderBy('sort_order')->orderBy('id')->paginate(10);

        $stats = [
            ['value' => ServiceHeroSlide::count(), 'label' => 'Total Slides'],
            ['value' => ServiceHeroSlide::where('status', 'active')->count(), 'label' => 'Shown on Website'],
        ];

        return view('admin.hero-slides.index', compact('slides', 'stats'));
    }

    public function create(): View
    {
        return view('admin.hero-slides.create');
    }

    public function store(ServiceHeroSlideRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['image'] = $request->file('image')->store('service-heroes', 'public');
        $data['sort_order'] = $data['sort_order'] ?? (ServiceHeroSlide::max('sort_order') + 1);

        ServiceHeroSlide::create($data);

        return redirect()->route('admin.hero-slides.index')->with('status', 'Hero slide added successfully.');
    }

    public function edit(ServiceHeroSlide $slide): View
    {
        return view('admin.hero-slides.edit', compact('slide'));
    }

    public function update(ServiceHeroSlideRequest $request, ServiceHeroSlide $slide): RedirectResponse
    {
        $data = $request->validated();
        unset($data['image']);
        $data['sort_order'] = $data['sort_order'] ?? $slide->sort_order;

        if ($request->hasFile('image')) {
            $slide->deleteStoredImage();
            $data['image'] = $request->file('image')->store('service-heroes', 'public');
        }

        $slide->update($data);

        return redirect()->route('admin.hero-slides.index')->with('status', 'Hero slide updated successfully.');
    }

    public function destroy(ServiceHeroSlide $slide): RedirectResponse
    {
        $slide->deleteStoredImage();
        $slide->delete();

        return redirect()->route('admin.hero-slides.index')->with('status', 'Hero slide deleted successfully.');
    }
}
