@extends('layouts.admin')

@section('title', 'Services Hero Slides - Admin')

@section('content')
    @include('admin.partials.stat-cards')

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2 bg-dark text-white">
            <strong>Services Page Hero Slides</strong>
            <a href="{{ route('admin.hero-slides.create') }}" class="btn btn-primary btn-sm no-print">Add New Slide</a>
        </div>

        <div class="card-body">
            <p class="text-muted small mb-3">These slides rotate in the banner at the top of the public Services page, in the order shown below.</p>
            <div class="table-responsive">
                <table class="table table-striped align-middle" data-sortable>
                    <thead>
                        <tr>
                            <th data-sort="number">#</th>
                            <th>Preview</th>
                            <th data-sort="text">Heading</th>
                            <th>Text</th>
                            <th data-sort="number">Order</th>
                            <th data-sort="text">Status</th>
                            <th class="no-print">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($slides as $index => $slide)
                            <tr>
                                <td>{{ $slides->firstItem() + $index }}</td>
                                <td>
                                    @if ($slide->image_url)
                                        <img src="{{ $slide->image_url }}" alt="{{ $slide->title }}" class="img-thumbnail" width="90" height="50" style="object-fit: cover;">
                                    @endif
                                </td>
                                <td>{{ $slide->title }}</td>
                                <td>{{ Str::limit($slide->description, 70) }}</td>
                                <td>{{ $slide->sort_order }}</td>
                                <td>@include('admin.partials.status-badge', ['status' => $slide->status])</td>
                                <td class="no-print">
                                    <a href="{{ route('admin.hero-slides.edit', $slide) }}" class="btn btn-warning btn-sm" title="Edit"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('admin.hero-slides.destroy', $slide) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Delete this slide?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No hero slides yet</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="no-print">
                    {{ $slides->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
