<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\ExportsCsv;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLeaderRequest;
use App\Http\Requests\Admin\UpdateLeaderRequest;
use App\Models\Leader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class LeaderController extends Controller
{
    use ExportsCsv;

    public function index(): View
    {
        $leaders = $this->filteredQuery()->paginate(10)->withQueryString();

        $stats = [
            ['value' => Leader::count(), 'label' => 'Total Leaders'],
        ];

        return view('admin.leaders.index', compact('leaders', 'stats'));
    }

    public function export()
    {
        $leaders = $this->filteredQuery()->get();

        $headings = ['#', 'Full Name', 'Position', 'Department', 'Email', 'Phone', 'Status'];
        $rows = [];

        foreach ($leaders as $index => $leader) {
            $rows[] = [
                $index + 1,
                $leader->fullname,
                $leader->position,
                $leader->department,
                $leader->email,
                $leader->phone_number,
                ucfirst($leader->status),
            ];
        }

        return $this->respondWithExport($headings, $rows, 'Team Report', 'leaders');
    }

    private function filteredQuery(): Builder
    {
        return Leader::query()
            ->when(request('search'), fn ($query, $search) => $query->where(fn ($q) => $q
                ->where('fullname', 'like', "%{$search}%")
                ->orWhere('position', 'like', "%{$search}%")
                ->orWhere('department', 'like', "%{$search}%")))
            ->when(request('status'), fn ($query, $status) => $query->where('status', $status))
            ->when(request('date_from'), fn ($query, $date) => $query->whereDate('created_at', '>=', $date))
            ->when(request('date_to'), fn ($query, $date) => $query->whereDate('created_at', '<=', $date))
            ->latest();
    }

    public function create(): View
    {
        return view('admin.leaders.create');
    }

    public function store(StoreLeaderRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['profile_picture'] = $request->file('profile_picture')->store('leaders', 'public');

        Leader::create($data);

        return redirect()->route('admin.leaders.index')->with('status', 'Leader added successfully.');
    }

    public function edit(Leader $leader): View
    {
        return view('admin.leaders.edit', compact('leader'));
    }

    public function update(UpdateLeaderRequest $request, Leader $leader): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('profile_picture')) {
            if ($leader->profile_picture) {
                Storage::disk('public')->delete($leader->profile_picture);
            }
            $data['profile_picture'] = $request->file('profile_picture')->store('leaders', 'public');
        }

        $leader->update($data);

        return redirect()->route('admin.leaders.index')->with('status', 'Leader updated successfully.');
    }

    public function destroy(Leader $leader): RedirectResponse
    {
        if ($leader->profile_picture) {
            Storage::disk('public')->delete($leader->profile_picture);
        }

        $leader->delete();

        return redirect()->route('admin.leaders.index')->with('status', 'Leader deleted successfully.');
    }
}
