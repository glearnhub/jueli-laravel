<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\ExportsCsv;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceRequest;
use App\Models\Service;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class ServiceController extends Controller
{
    use ExportsCsv;

    public function index(): View
    {
        $services = $this->filteredQuery()->paginate(10)->withQueryString();

        $stats = [
            ['value' => Service::count(), 'label' => 'Total Services'],
            ['value' => Service::where('status', 'active')->count(), 'label' => 'Shown on Website'],
            ['value' => Service::where('status', '!=', 'active')->count(), 'label' => 'Hidden'],
        ];

        return view('admin.services.index', compact('services', 'stats'));
    }

    public function export()
    {
        $services = $this->filteredQuery()->get();

        $headings = ['#', 'Title', 'Description', 'Display Order', 'Status', 'Date Created'];
        $rows = [];

        foreach ($services as $index => $service) {
            $rows[] = [
                $index + 1,
                $service->title,
                $service->description,
                $service->sort_order,
                ucfirst($service->status),
                $service->created_at->format('Y-m-d'),
            ];
        }

        return $this->respondWithExport($headings, $rows, 'Services Report', 'services');
    }

    private function filteredQuery(): Builder
    {
        return Service::query()
            ->withCount('images')
            ->when(request('search'), fn ($query, $search) => $query->where(fn ($q) => $q
                ->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")))
            ->when(request('status'), fn ($query, $status) => $query->where('status', $status))
            ->when(request('date_from'), fn ($query, $date) => $query->whereDate('created_at', '>=', $date))
            ->when(request('date_to'), fn ($query, $date) => $query->whereDate('created_at', '<=', $date))
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    public function create(): View
    {
        return view('admin.services.create');
    }

    public function store(ServiceRequest $request): RedirectResponse
    {
        $data = Arr::except($request->validated(), ['gallery', 'remove_images']);
        $data['image'] = $request->file('image')->store('services', 'public');
        $data['sort_order'] = $data['sort_order'] ?? (Service::max('sort_order') + 1);

        $service = Service::create($data);
        $this->syncGallery($request, $service);

        return redirect()->route('admin.services.index')->with('status', 'Service added successfully.');
    }

    private function syncGallery(ServiceRequest $request, Service $service): void
    {
        $removeIds = $request->validated('remove_images', []);

        if ($removeIds) {
            $service->images()->whereIn('id', $removeIds)->get()->each(function ($image) {
                $image->deleteStoredImage();
                $image->delete();
            });
        }

        $order = (int) $service->images()->max('sort_order');

        foreach ($request->file('gallery', []) as $file) {
            $service->images()->create([
                'image' => $file->store('services/gallery', 'public'),
                'sort_order' => ++$order,
            ]);
        }
    }

    public function edit(Service $service): View
    {
        $service->load('images');

        return view('admin.services.edit', compact('service'));
    }

    public function update(ServiceRequest $request, Service $service): RedirectResponse
    {
        $data = Arr::except($request->validated(), ['image', 'gallery', 'remove_images']);
        $data['sort_order'] = $data['sort_order'] ?? $service->sort_order;

        if ($request->hasFile('image')) {
            $service->deleteStoredImage();
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        $service->update($data);
        $this->syncGallery($request, $service);

        return redirect()->route('admin.services.index')->with('status', 'Service updated successfully.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->images->each->deleteStoredImage();
        $service->deleteStoredImage();
        $service->delete();

        return redirect()->route('admin.services.index')->with('status', 'Service deleted successfully.');
    }
}
