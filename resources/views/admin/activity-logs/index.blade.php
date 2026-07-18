@extends('layouts.admin')

@section('title', 'Activity Logs - Admin')

@section('content')
    @include('admin.partials.stat-cards')

    <div class="card mb-3 no-print">
        <div class="card-body">
            <form method="GET" class="row gy-2 gx-2 align-items-end">
                <div class="col-auto">
                    <label class="form-label small mb-1">User</label>
                    <select class="form-select form-select-sm" name="user_id">
                        <option value="">All Users</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" @selected(request('user_id') == $user->id)>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <label class="form-label small mb-1">Action</label>
                    <select class="form-select form-select-sm" name="action">
                        <option value="">All Actions</option>
                        <option value="created" @selected(request('action') === 'created')>Created</option>
                        <option value="updated" @selected(request('action') === 'updated')>Updated</option>
                        <option value="deleted" @selected(request('action') === 'deleted')>Deleted</option>
                    </select>
                </div>
                <div class="col-auto">
                    <label class="form-label small mb-1">From</label>
                    <input type="date" class="form-control form-control-sm" name="date_from" value="{{ request('date_from') }}">
                </div>
                <div class="col-auto">
                    <label class="form-label small mb-1">To</label>
                    <input type="date" class="form-control form-control-sm" name="date_to" value="{{ request('date_to') }}">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-dark btn-sm"><i class="bi bi-funnel"></i> Apply</button>
                    <a href="{{ route('admin.activity-logs.index') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
            <strong>Activity Logs</strong>
            @include('admin.partials.export-buttons', ['exportRouteName' => 'admin.activity-logs.export'])
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Action</th>
                            <th>Description</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($logs as $index => $log)
                            <tr>
                                <td>{{ $logs->firstItem() + $index }}</td>
                                <td>{{ $log->user?->name ?? 'System' }}</td>
                                <td>
                                    <span class="badge {{ match($log->action) {
                                        'created' => 'badge-active',
                                        'updated' => 'badge-draft',
                                        'deleted' => 'badge-archived',
                                        default => 'badge-inactive',
                                    } }}">{{ ucfirst($log->action) }}</span>
                                </td>
                                <td>{{ $log->description }}</td>
                                <td>{{ $log->created_at->format('d M Y, H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No activity recorded yet</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="no-print">
                    {{ $logs->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
