@extends('layouts.admin')

@section('title', 'Services - Admin')

@section('content')
    @include('admin.partials.stat-cards')

    <div class="card mb-3 no-print">
        <div class="card-body">
            <form method="GET" class="row gy-2 gx-2 align-items-end">
                <div class="col-auto">
                    <label class="form-label small mb-1">Search</label>
                    <input type="text" class="form-control form-control-sm" name="search" aria-label="Search" placeholder="Title or description..."
                        value="{{ request('search') }}">
                </div>
                @include('admin.partials.status-date-filter')
                <div class="col-auto">
                    <button type="submit" class="btn btn-dark btn-sm"><i class="bi bi-funnel"></i> Apply</button>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2 bg-dark text-white">
            <strong>Services</strong>
            <div class="d-flex align-items-center gap-2">
                @include('admin.partials.export-buttons', ['exportRouteName' => 'admin.services.export'])
                <a href="{{ route('admin.services.create') }}" class="btn btn-primary btn-sm no-print">Add New Service</a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle" data-sortable>
                    <thead>
                        <tr>
                            <th data-sort="number">#</th>
                            <th>Image</th>
                            <th data-sort="text">Title</th>
                            <th>Description</th>
                            <th data-sort="number">Pictures</th>
                            <th data-sort="number">Order</th>
                            <th data-sort="text">Status</th>
                            <th class="no-print">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($services as $index => $service)
                            <tr>
                                <td>{{ $services->firstItem() + $index }}</td>
                                <td>
                                    @if ($service->image_url)
                                        <img src="{{ $service->image_url }}" alt="{{ $service->title }}" class="img-thumbnail" width="60" height="50" style="object-fit: cover;">
                                    @endif
                                </td>
                                <td>{{ $service->title }}</td>
                                <td>{{ Str::limit($service->description, 70) }}</td>
                                <td><span class="badge bg-info text-dark">{{ $service->images_count }}/{{ \App\Models\Service::MAX_IMAGES }}</span></td>
                                <td>{{ $service->sort_order }}</td>
                                <td>@include('admin.partials.status-badge', ['status' => $service->status])</td>
                                <td class="no-print">
                                    <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-warning btn-sm" title="Edit"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Delete this service?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No services found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="no-print">
                    {{ $services->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
