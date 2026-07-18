@extends('layouts.admin')

@section('title', (request()->boolean('featured') ? 'Featured Products' : 'Products') . ' - Admin')

@section('content')
    @include('admin.partials.stat-cards')

    <div class="card mb-3 no-print">
        <div class="card-body">
            <form method="GET" class="row gy-2 gx-2 align-items-end">
                <div class="col-auto">
                    <label class="form-label small mb-1">Filter by Category</label>
                    <select class="form-select form-select-sm" name="category_id">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <label class="form-label small mb-1">Search</label>
                    <input type="text" class="form-control form-control-sm" name="search" placeholder="Product name..."
                        value="{{ request('search') }}">
                </div>
                @include('admin.partials.status-date-filter')
                <div class="col-auto">
                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="featured" value="1" id="featuredOnly"
                            {{ request()->boolean('featured') ? 'checked' : '' }}>
                        <label class="form-check-label small" for="featuredOnly">Featured only</label>
                    </div>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-dark btn-sm"><i class="bi bi-funnel"></i> Apply</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2 bg-dark text-white">
            <strong>{{ request()->boolean('featured') ? 'Featured Products' : 'All Products' }}</strong>

            <div class="d-flex align-items-center gap-2">
                @include('admin.partials.export-buttons', ['exportRouteName' => 'admin.products.export'])
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm no-print">Add New Product</a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle" data-sortable>
                    <thead>
                        <tr>
                            <th data-sort="number">#</th>
                            <th>Picture</th>
                            <th data-sort="text">Category</th>
                            <th data-sort="text">Name</th>
                            <th data-sort="number">Price</th>
                            <th data-sort="text">Status</th>
                            <th data-sort="text">Featured</th>
                            <th data-sort="text">Date Added</th>
                            <th class="no-print">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $index => $product)
                            <tr>
                                <td>{{ $products->firstItem() + $index }}</td>
                                <td>
                                    @if ($product->product_picture)
                                        <img src="{{ asset('storage/' . $product->product_picture) }}" alt="Product" class="img-thumbnail" width="50" height="50">
                                    @endif
                                </td>
                                <td>{{ $product->category?->category_name }}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->price !== null ? 'KES '.number_format($product->price, 2) : '—' }}</td>
                                <td>@include('admin.partials.status-badge', ['status' => $product->status])</td>
                                <td>
                                    <span class="badge {{ $product->is_featured ? 'badge-featured' : 'badge-inactive' }}">
                                        {{ $product->is_featured ? 'Yes' : 'No' }}
                                    </span>
                                </td>
                                <td>{{ $product->created_at->format('d M Y') }}</td>
                                <td class="no-print">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning btn-sm" title="Edit"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No products found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="no-print">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
