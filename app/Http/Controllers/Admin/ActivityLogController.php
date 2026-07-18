<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\ExportsCsv;
use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ActivityLogController extends Controller
{
    use ExportsCsv;

    public function index(): View
    {
        $logs = $this->filteredQuery()->with('user')->paginate(20)->withQueryString();

        $stats = [
            ['value' => ActivityLog::count(), 'label' => 'Total Records'],
            ['value' => ActivityLog::whereDate('created_at', today())->count(), 'label' => "Today's Activity"],
            ['value' => ActivityLog::where('action', 'deleted')->count(), 'label' => 'Deletions'],
        ];

        $users = User::orderBy('name')->get();

        return view('admin.activity-logs.index', compact('logs', 'stats', 'users'));
    }

    public function export()
    {
        $logs = $this->filteredQuery()->with('user')->get();

        $headings = ['#', 'User', 'Action', 'Description', 'Date'];
        $rows = [];

        foreach ($logs as $index => $log) {
            $rows[] = [
                $index + 1,
                $log->user?->name ?? 'System',
                ucfirst($log->action),
                $log->description,
                $log->created_at->format('Y-m-d H:i'),
            ];
        }

        return $this->respondWithExport($headings, $rows, 'Activity Logs Report', 'activity-logs');
    }

    private function filteredQuery(): Builder
    {
        return ActivityLog::query()
            ->when(request('user_id'), fn ($query, $userId) => $query->where('user_id', $userId))
            ->when(request('action'), fn ($query, $action) => $query->where('action', $action))
            ->when(request('date_from'), fn ($query, $date) => $query->whereDate('created_at', '>=', $date))
            ->when(request('date_to'), fn ($query, $date) => $query->whereDate('created_at', '<=', $date))
            ->latest();
    }
}
