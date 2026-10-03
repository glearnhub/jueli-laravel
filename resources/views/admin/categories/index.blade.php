@extends('layouts.admin')

@section('title', 'Categories - Admin')

@section('content')
    @include('admin.partials.stat-cards')

    <div class="card mb-3 no-print">
        <div class="card-body">
            <form method="GET" class="row gy-2 gx-2 align-items-end">
                <div class="col-auto">
                    <label class="form-label small mb-1">Search</label>
                    <input type="text" class="form-control form-control-sm" name="search" aria-label="Search" placeholder="Category name..."
                        value="{{ request('search') }}">
                </div>
                @include('admin.partials.status-date-filter')
                <div class="col-auto">
                    <button type="submit" class="btn btn-dark btn-sm"><i class="bi bi-funnel"></i> Apply</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2 bg-dark text-white">
            <strong>Product Categories</strong>
            <div class="d-flex align-items-center gap-2">
                @include('admin.partials.export-buttons', ['exportRouteName' => 'admin.categories.export'])
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm no-print">Add New Category</a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle" data-sortable>
                    <thead>
                        <tr>
                            <th data-sort="number">#</th>
                            <th>Picture</th>
                            <th data-sort="text">Category Name</th>
                            <th>Description</th>
                            <th data-sort="number">Products</th>
                            <th data-sort="text">Status</th>
                            <th data-sort="text">Date Created</th>
                            <th class="no-print">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $index => $category)
                            <tr>
                                <td>{{ $categories->firstItem() + $index }}</td>
                                <td>
                                    @if ($category->picture)
                                        <img src="{{ asset('storage/' . $category->picture) }}" alt="Category" class="img-thumbnail" width="50" height="50">
                                    @endif
                                </td>
                                <td>{{ $category->category_name }}</td>
                                <td>{{ Str::limit($category->description, 60) }}</td>
                                <td><span class="badge bg-info text-dark">{{ $category->products_count }}</span></td>
                                <td>@include('admin.partials.status-badge', ['status' => $category->status])</td>
                                <td>{{ $category->created_at->format('d M Y') }}</td>
                                <td class="no-print">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning btn-sm" title="Edit"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Delete this category? Products in it will be uncategorized.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No categories found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="no-print">
                    {{ $categories->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
