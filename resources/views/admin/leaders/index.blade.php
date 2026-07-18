@extends('layouts.admin')

@section('title', 'Team - Admin')

@section('content')
    @include('admin.partials.stat-cards')

    <div class="card mb-3 no-print">
        <div class="card-body">
            <form method="GET" class="row gy-2 gx-2 align-items-end">
                <div class="col-auto">
                    <label class="form-label small mb-1">Search</label>
                    <input type="text" class="form-control form-control-sm" name="search" placeholder="Name, position, department..."
                        value="{{ request('search') }}">
                </div>
                @include('admin.partials.status-date-filter')
                <div class="col-auto">
                    <button type="submit" class="btn btn-dark btn-sm"><i class="bi bi-funnel"></i> Apply</button>
                    <a href="{{ route('admin.leaders.index') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
            <strong>Company Management Team</strong>
            <div class="d-flex align-items-center gap-2">
                @include('admin.partials.export-buttons', ['exportRouteName' => 'admin.leaders.export'])
                <a href="{{ route('admin.leaders.create') }}" class="btn btn-primary btn-sm no-print">Add New Leader</a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle" data-sortable>
                    <thead>
                        <tr>
                            <th data-sort="number">#</th>
                            <th>Photo</th>
                            <th data-sort="text">Name</th>
                            <th data-sort="text">Position</th>
                            <th data-sort="text">Department</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th data-sort="text">Status</th>
                            <th class="no-print">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($leaders as $index => $leader)
                            <tr>
                                <td>{{ $leaders->firstItem() + $index }}</td>
                                <td>
                                    @if ($leader->profile_picture)
                                        <img src="{{ asset('storage/' . $leader->profile_picture) }}" alt="Leader" class="img-thumbnail" width="50" height="50">
                                    @endif
                                </td>
                                <td>{{ $leader->fullname }}</td>
                                <td><span class="badge bg-primary">{{ $leader->position }}</span></td>
                                <td>{{ $leader->department }}</td>
                                <td>{{ $leader->email }}</td>
                                <td>{{ $leader->phone_number }}</td>
                                <td>@include('admin.partials.status-badge', ['status' => $leader->status])</td>
                                <td class="no-print">
                                    <a href="{{ route('admin.leaders.edit', $leader) }}" class="btn btn-warning btn-sm" title="Edit"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('admin.leaders.destroy', $leader) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Delete this leader?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No team members found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="no-print">
                    {{ $leaders->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
