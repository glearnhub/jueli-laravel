@extends('layouts.admin')

@section('title', 'Dashboard - Admin')

@php
    $palette = ['#102A54', '#F4B400', '#DC3545', '#28A745', '#17A2B8', '#1F4E79', '#6c757d'];
@endphp

@section('content')
    <div class="row row-cols-2 row-cols-md-4 g-3 mb-4">
        <div class="col">
            <a href="{{ route('admin.products.index') }}" class="card stat-card text-center p-3 text-decoration-none text-dark h-100" style="border-top: 4px solid {{ $palette[0] }};">
                <h2 class="mb-1">{{ $counts['products'] }}</h2>
                <div class="text-muted">Total Products</div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('admin.categories.index') }}" class="card stat-card text-center p-3 text-decoration-none text-dark h-100" style="border-top: 4px solid {{ $palette[1] }};">
                <h2 class="mb-1">{{ $counts['categories'] }}</h2>
                <div class="text-muted">Product Categories</div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('admin.products.index', ['featured' => 1]) }}" class="card stat-card text-center p-3 text-decoration-none text-dark h-100" style="border-top: 4px solid {{ $palette[2] }};">
                <h2 class="mb-1">{{ $counts['featured'] }}</h2>
                <div class="text-muted">Featured Products</div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('admin.leaders.index') }}" class="card stat-card text-center p-3 text-decoration-none text-dark h-100" style="border-top: 4px solid {{ $palette[3] }};">
                <h2 class="mb-1">{{ $counts['leaders'] }}</h2>
                <div class="text-muted">Team Members</div>
            </a>
        </div>
        <div class="col">
            <div class="card stat-card text-center p-3 h-100" style="border-top: 4px solid {{ $palette[4] }};">
                <h2 class="mb-1">{{ $counts['visitors_today'] }}</h2>
                <div class="text-muted">Website Visitors (Today)</div>
            </div>
        </div>
        @can('messages.view')
            <div class="col">
                <a href="{{ route('admin.messages.index') }}" class="card stat-card text-center p-3 text-decoration-none text-dark h-100" style="border-top: 4px solid {{ $palette[5] }};">
                    <h2 class="mb-1">{{ $counts['messages'] }}</h2>
                    <div class="text-muted">Unread Messages</div>
                </a>
            </div>
        @endcan
        @can('activity_logs.view')
            <div class="col">
                <a href="{{ route('admin.activity-logs.index') }}" class="card stat-card text-center p-3 text-decoration-none text-dark h-100" style="border-top: 4px solid {{ $palette[6] }};">
                    <h2 class="mb-1">{{ $counts['reports'] }}</h2>
                    <div class="text-muted">Recent Reports (Today)</div>
                </a>
            </div>
        @endcan
    </div>

    @can('messages.view')
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <strong>Latest Contact Messages</strong>
                <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-primary">View all</a>
            </div>
            <div class="card-body">
                @forelse ($latestMessages as $message)
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <div>
                            <a href="{{ route('admin.messages.show', $message) }}" class="fw-bold text-decoration-none">{{ $message->name }}</a>
                            <div class="text-muted small">{{ $message->email }}</div>
                        </div>
                        <div class="text-muted small">{{ $message->created_at->diffForHumans() }}</div>
                    </div>
                @empty
                    <p class="text-muted mb-0">No messages yet.</p>
                @endforelse
            </div>
        </div>
    @endcan
@endsection
