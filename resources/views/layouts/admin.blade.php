<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Jueli Engineering Ltd')</title>

    <link rel="icon" type="image/png" href="{{ asset('img/logo_2.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>

<body>
    @php
        $productsOpen = request()->routeIs('admin.products.*') || request()->routeIs('admin.categories.*');
        $reportsOpen = request()->boolean('report');
        $settingsOpen = request()->routeIs('admin.settings.*') || request()->routeIs('admin.users.*') || request()->routeIs('admin.roles.*') || request()->routeIs('admin.activity-logs.*');
        $unreadMessages = auth()->user()?->hasPermission('messages.view')
            ? \App\Models\ContactMessage::whereNull('read_at')->latest()->take(5)->get()
            : collect();
        $unreadCount = auth()->user()?->hasPermission('messages.view')
            ? \App\Models\ContactMessage::whereNull('read_at')->count()
            : 0;
    @endphp

    <nav class="navbar navbar-expand-lg fixed-top no-print">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <button class="navbar-toggler me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                @php
                    $pageTitle = \Illuminate\Support\Str::before($__env->yieldContent('title', 'Dashboard - Admin'), ' - Admin');
                @endphp
                <div>
                    <div class="top-page-title">{{ $pageTitle }}</div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb top-breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-white-50 text-decoration-none">Admin</a></li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page">{{ $pageTitle }}</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="d-flex align-items-center gap-1">
                <a href="{{ route('admin.products.index') }}" class="topbar-icon-btn" title="Search products">
                    <i class="bi bi-search"></i>
                </a>

                @can('messages.view')
                    <div class="dropdown">
                        <a href="#" class="topbar-icon-btn" data-bs-toggle="dropdown" title="Notifications">
                            <i class="bi bi-bell"></i>
                            @if ($unreadCount > 0)
                                <span class="badge-dot">{{ $unreadCount > 9 ? '9+' : $unreadCount }}</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" style="min-width: 300px;">
                            <li><h6 class="dropdown-header">Unread Messages</h6></li>
                            @forelse ($unreadMessages as $message)
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.messages.show', $message) }}">
                                        <strong>{{ $message->name }}</strong>
                                        <div class="small text-muted">{{ Str::limit($message->subject ?: $message->message, 40) }}</div>
                                    </a>
                                </li>
                            @empty
                                <li><span class="dropdown-item-text text-muted small">No unread messages</span></li>
                            @endforelse
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-center small" href="{{ route('admin.messages.index') }}">View all messages</a></li>
                        </ul>
                    </div>
                @endcan

                <div class="dropdown">
                    <a href="#" class="topbar-icon-btn" data-bs-toggle="dropdown" title="Account">
                        <i class="bi bi-person-circle"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><span class="dropdown-item-text fw-semibold">{{ auth()->user()->name }}</span></li>
                        <li><span class="dropdown-item-text text-muted small">{{ auth()->user()->role?->name }}</span></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a href="{{ route('admin.password.edit') }}" class="dropdown-item"><i class="bi bi-key me-2"></i>Change Password</a></li>
                        <li>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="admin-shell">
        <div class="offcanvas-lg offcanvas-start text-white sidebar-nav no-print" tabindex="-1" id="sidebar">
            <div class="sidebar-brand">
                <div class="brand-title">JUELI ENGINEERING</div>
                <div class="brand-subtitle">Administration Panel</div>
            </div>
            <div class="offcanvas-body p-0">
                <nav class="navbar-dark">
                    <ul class="navbar-nav">
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="nav-link px-3 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <i class="bi bi-speedometer2 me-2"></i>Dashboard
                            </a>
                        </li>

                        @can('products.view')
                            <li>
                                <a href="#productsSubmenu" class="nav-link px-3 d-flex align-items-center" data-bs-toggle="collapse"
                                    aria-expanded="{{ $productsOpen ? 'true' : 'false' }}">
                                    <i class="bi bi-box-seam me-2"></i>Products
                                    <i class="bi bi-chevron-down ms-auto small"></i>
                                </a>
                                <ul class="collapse list-unstyled ps-4 {{ $productsOpen ? 'show' : '' }}" id="productsSubmenu">
                                    <li>
                                        <a href="{{ route('admin.categories.index') }}" class="nav-link px-3 {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                                            <i class="bi bi-dot me-1"></i>Product Categories
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.products.index', ['featured' => 1]) }}" class="nav-link px-3 {{ request()->routeIs('admin.products.index') && request()->boolean('featured') ? 'active' : '' }}">
                                            <i class="bi bi-dot me-1"></i>Featured Products
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.products.index') }}" class="nav-link px-3 {{ request()->routeIs('admin.products.index') && ! request()->boolean('featured') ? 'active' : '' }}">
                                            <i class="bi bi-dot me-1"></i>All Products
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan

                        @can('leaders.view')
                            <li>
                                <a href="{{ route('admin.leaders.index') }}" class="nav-link px-3 {{ request()->routeIs('admin.leaders.*') ? 'active' : '' }}">
                                    <i class="bi bi-people me-2"></i>Team
                                </a>
                            </li>
                        @endcan

                        @can('messages.view')
                            <li>
                                <a href="{{ route('admin.messages.index') }}" class="nav-link px-3 {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                                    <i class="bi bi-envelope me-2"></i>Messages
                                    @if ($unreadCount > 0)
                                        <span class="badge bg-danger rounded-pill ms-auto">{{ $unreadCount }}</span>
                                    @endif
                                </a>
                            </li>
                        @endcan

                        <li>
                            <a href="#reportsSubmenu" class="nav-link px-3 d-flex align-items-center" data-bs-toggle="collapse"
                                aria-expanded="{{ $reportsOpen ? 'true' : 'false' }}">
                                <i class="bi bi-bar-chart-line me-2"></i>Reports
                                <i class="bi bi-chevron-down ms-auto small"></i>
                            </a>
                            <ul class="collapse list-unstyled ps-4 {{ $reportsOpen ? 'show' : '' }}" id="reportsSubmenu">
                                @can('categories.view')
                                    <li>
                                        <a href="{{ route('admin.categories.index', ['report' => 1]) }}" class="nav-link px-3">
                                            <i class="bi bi-pie-chart me-1"></i>Product Categories Report
                                        </a>
                                    </li>
                                @endcan
                                @can('products.view')
                                    <li>
                                        <a href="{{ route('admin.products.index', ['featured' => 1, 'report' => 1]) }}" class="nav-link px-3">
                                            <i class="bi bi-star me-1"></i>Featured Products Report
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.products.index', ['report' => 1]) }}" class="nav-link px-3">
                                            <i class="bi bi-graph-up me-1"></i>Products Report
                                        </a>
                                    </li>
                                @endcan
                                @can('leaders.view')
                                    <li>
                                        <a href="{{ route('admin.leaders.index', ['report' => 1]) }}" class="nav-link px-3">
                                            <i class="bi bi-people me-1"></i>Team Report
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>

                        @canany(['settings.manage', 'users.manage', 'roles.manage', 'activity_logs.view'])
                            <li>
                                <a href="#settingsSubmenu" class="nav-link px-3 d-flex align-items-center" data-bs-toggle="collapse"
                                    aria-expanded="{{ $settingsOpen ? 'true' : 'false' }}">
                                    <i class="bi bi-gear me-2"></i>Settings
                                    <i class="bi bi-chevron-down ms-auto small"></i>
                                </a>
                                <ul class="collapse list-unstyled ps-4 {{ $settingsOpen ? 'show' : '' }}" id="settingsSubmenu">
                                    @can('settings.manage')
                                        <li>
                                            <a href="{{ route('admin.settings.website.edit') }}" class="nav-link px-3 {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                                                <i class="bi bi-dot me-1"></i>Website Settings
                                            </a>
                                        </li>
                                    @endcan
                                    @can('users.manage')
                                        <li>
                                            <a href="{{ route('admin.users.index') }}" class="nav-link px-3 {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                                                <i class="bi bi-dot me-1"></i>User Management
                                            </a>
                                        </li>
                                    @endcan
                                    @can('roles.manage')
                                        <li>
                                            <a href="{{ route('admin.roles.index') }}" class="nav-link px-3 {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                                                <i class="bi bi-dot me-1"></i>Roles & Permissions
                                            </a>
                                        </li>
                                    @endcan
                                    @can('activity_logs.view')
                                        <li>
                                            <a href="{{ route('admin.activity-logs.index') }}" class="nav-link px-3 {{ request()->routeIs('admin.activity-logs.*') ? 'active' : '' }}">
                                                <i class="bi bi-dot me-1"></i>Activity Logs
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcanany
                    </ul>
                </nav>
            </div>
        </div>

        <main class="pt-3">
            <div class="container-fluid">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
