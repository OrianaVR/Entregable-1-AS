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
                <a class="nav-link active" href="{{ route('home.index') }}">{{ __('layout.navHome') }}</a>
                <a class="nav-link" href="{{ route('product.index') }}">{{ __('layout.navProducts') }}</a>
                <a class="nav-link" href="{{ route('home.about') }}">{{ __('layout.navAbout') }}</a>
                <a class="nav-link" href="{{ route('home.contact') }}">{{ __('layout.navContact') }}</a>
            </div>

            <div class="lume-nav-actions d-flex align-items-center gap-3">
                @guest
                    <a class="nav-link" href="{{ route('login') }}">{{ __('auth.navLogin') }}</a>
                    <a class="nav-link" href="{{ route('register') }}">{{ __('auth.navRegister') }}</a>
                @endguest

                @auth
                    <a href="{{ route('order.checkout') }}" class="nav-icon-link text-decoration-none position-relative" title="{{ __('layout.navCart') }}">
                        <i class="bi bi-bag fs-4"></i>
                        @if (count(session('cart', [])) > 0)
                            <span class="badge rounded-pill bg-danger position-absolute top-0 start-100 translate-middle" style="font-size: 10px;">{{ count(session('cart', [])) }}</span>
                        @endif
                    </a>

                    <div class="dropdown">
                        <a href="#" class="nav-icon-link text-decoration-none" id="userMenuDropdown" data-bs-toggle="dropdown" aria-expanded="false" title="Account">
                            <i class="bi bi-person fs-4"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="userMenuDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('user.profile', ['id' => auth()->user()->getId()]) }}">
                                    <i class="bi bi-person-circle me-2 text-warning"></i>{{ __('auth.navMyAccount') }}
                                </a>
                            </li>
                            @if (auth()->user()->getRole() === 'admin')
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.user.index') }}">
                                        <i class="bi bi-shield-lock me-2 text-primary"></i>{{ __('auth.navAdminPanel') }}
                                    </a>
                                </li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="px-3">
                                    @csrf
                                    <button type="submit" class="dropdown-item ps-0">
                                        <i class="bi bi-box-arrow-right me-2"></i>{{ __('auth.navLogout') }}
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <div class="lume-content">
        @yield('content')
    </div>

    <footer class="lume-footer">
        <div class="container">
            <small>
                &copy; 2026 LUMÉ. {{ __('layout.footerRights') }}
            </small>
        </div>
    </footer>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous">
    </script>

</body>

</html>