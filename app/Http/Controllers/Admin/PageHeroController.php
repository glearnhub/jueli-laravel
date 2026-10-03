<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageHeroRequest;
use App\Models\PageHero;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PageHeroController extends Controller
{
    public function index(): View
    {
        $heroes = collect(PageHero::PAGES)
            ->map(fn ($label, $page) => PageHero::firstOrCreate(['page' => $page]))
            ->values();

        return view('admin.page-heroes.index', compact('heroes'));
    }

    public function edit(PageHero $hero): View
    {
        return view('admin.page-heroes.edit', compact('hero'));
    }

    public function update(PageHeroRequest $request, PageHero $hero): RedirectResponse
    {
        $data = $request->safe()->only(['title', 'description']);

        if ($request->hasFile('image')) {
            $hero->deleteStoredImage();
            $data['image'] = $request->file('image')->store('page-heroes', 'public');
        } elseif ($request->boolean('remove_image')) {
            $hero->deleteStoredImage();
            $data['image'] = null;
        }

        $hero->update($data);

        return redirect()->route('admin.page-heroes.index')->with('status', $hero->page_label.' hero updated successfully.');
    }
}
