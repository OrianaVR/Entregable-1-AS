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
                <a href="#" class="nav-icon-link text-decoration-none" title="Account">
                    <i class="bi bi-person fs-4"></i>
                </a>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>

</html>