<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <title>@yield('title', 'LUMÉ - Admin Panel')</title>
</head>

<body class="lume-admin-body">

    <div class="lume-layout">

        <aside class="lume-sidebar">
            <div class="lume-brand">
                <a href="{{ route('home.index') }}" class="lume-logo text-decoration-none">
                    lumé
                    <span>SKIN</span>
                </a>
            </div>

            <nav class="lume-nav">
                <div class="lume-nav-group">
                    <div class="lume-nav-header">
                        <span><i class="bi bi-grid-fill me-2"></i>{{ __('admin.sidebarDashboard') }}</span>
                    </div>
                    <ul class="lume-nav-list">
                        <li>
                            <a href="{{ route('admin.user.index') }}" class="lume-nav-item active">
                                <i class="bi bi-people me-2"></i>{{ __('admin.pageTitleUsers') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </aside>


        <div class="lume-main-wrapper">

            <header class="lume-topbar justify-content-end">
                <div class="lume-topbar-actions">
                    <div class="lume-user-menu dropdown">
                        <a href="#" class="d-flex align-items-center gap-2 text-decoration-none text-dark dropdown-toggle" id="adminUserDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle fs-5 text-secondary"></i>
                            <span class="lume-user-name">{{ Auth::user()?->getName() ?? __('admin.adminFallbackName') }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="adminUserDropdown">
                            <li><span class="dropdown-item-text fw-semibold">{{ Auth::user()?->getName() ?? __('admin.adminFallbackName') }}</span></li>
                            <li><span class="dropdown-item-text text-muted small">{{ Auth::user()?->getEmail() ?? 'admin@example.com' }}</span></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('home.index') }}"><i class="bi bi-house me-2"></i>{{ __('admin.storeHome') }}</a></li>
                        </ul>
                    </div>
                </div>
            </header>


            <main class="lume-content-area">
                @yield('content')
            </main>

            <footer class="lume-footer">
                <p>&copy; 2026 LUMÉ. {{ __('layout.footerRights') }}</p>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>
