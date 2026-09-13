<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <title>@yield('title', 'LUMÉ STORE')</title>
</head>

<body>

    <nav class="lume-navbar">
        <div class="lume-nav-container">
            <a href="{{ route('home.index') }}" class="lume-logo">
                lumé
                <span>SKIN</span>
            </a>

            <div class="lume-menu">
                <a class="nav-link active" href="{{ route('home.index') }}">HOME</a>
                <a class="nav-link" href="{{ route('home.about') }}">ABOUT</a>
                <a class="nav-link" href="{{ route('home.contact') }}">CONTACT</a>
            </div>

            <div class="lume-nav-actions d-flex align-items-center gap-3">
                <div class="dropdown">
                    <a href="#" class="nav-icon-link text-decoration-none" id="userMenuDropdown" data-bs-toggle="dropdown" aria-expanded="false" title="Account">
                        <i class="bi bi-person fs-4"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="userMenuDropdown">
                        <li><h6 class="dropdown-header text-uppercase small">Navigation / Views</h6></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('client.profile', ['id' => 2]) }}">
                                <i class="bi bi-person-circle me-2 text-warning"></i>Client Profile (My Account)
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.client.index') }}">
                                <i class="bi bi-shield-lock me-2 text-primary"></i>Admin Panel (LUME)
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li><span class="dropdown-item-text text-muted small">Dev Quick Logins:</span></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('dev.login.client') }}">
                                <i class="bi bi-box-arrow-in-right me-2 text-success"></i>Login as Client (Lila)
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('dev.login.admin') }}">
                                <i class="bi bi-box-arrow-in-right me-2 text-info"></i>Login as Admin
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="lume-content">
        @yield('content')
    </div>

    <footer class="lume-footer">
        <div class="container">
            <small>
                &copy; 2026 LUMÉ. All rights reserved.
            </small>
        </div>
    </footer>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous">
    </script>

</body>

</html>