<!doctype html>
<html lang="bn">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Roman Electronic & Furnitures @yield('title')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <style>
        :root {
            --bg: #f8fafc;
            --surface: #ffffff;
            --surface-soft: #f1f5f9;
            --text: #111827;
            --text-muted: #475569;
            --border: #cbd5e1;
            --shadow: 0 14px 45px rgba(15, 23, 42, 0.08);

            --bs-primary: #2563eb;
            --bs-primary-hover: #1d4ed8;
            --bs-success: #10b981;
            --bs-success-hover: #0f766e;
            --bs-info: #0ea5e9;
            --bs-info-hover: #0284c7;
            --bs-warning: #f59e0b;
            --bs-warning-hover: #c2410c;
            --bs-danger: #ef4444;
            --bs-danger-hover: #b91c1c;
        }

        body {
            font-family: 'solaimanlipi', sans-serif;
            background-color: var(--bg);
            color: var(--text);
        }

        .navbar,
        footer,
        .scrolling-notices,
        main.container {
            background: var(--surface);
            color: var(--text);
        }

        .navbar {
            border-bottom: 1px solid var(--border);
        }

        .nav-link {
            color: var(--text-muted) !important;
            transition: color 0.2s ease;
        }

        .nav-link.active,
        .nav-link:hover {
            color: var(--bs-primary) !important;
        }

        .btn-primary,
        .bg-primary,
        .text-primary,
        .border-primary {
            color: #fff !important;
            background-color: var(--bs-primary) !important;
            border-color: var(--bs-primary) !important;
        }

        .btn-outline-secondary:hover {
            background: var(--surface-soft);
            border-color: var(--bs-primary);
            color: var(--bs-primary);
        }

        .btn {
            border-radius: 0.75rem;
            transition: all 0.2s ease;
        }

        .btn-outline-secondary {
            color: var(--text);
            border-color: var(--border);
        }

        .btn-outline-secondary:hover {
            background: var(--surface-soft);
            border-color: var(--bs-primary);
            color: var(--bs-primary);
        }

        .scrolling-notices {
            background: linear-gradient(110deg, var(--bs-primary), #f59e0b);
            overflow: hidden;
            white-space: nowrap;
            padding: 0.65rem 0;
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.08);
        }

        .scrolling-notices h4 {
            display: inline-block;
            margin-right: 3rem;
            font-weight: 600;
            animation: scrollText 18s linear infinite;
            color: #fff;
        }

        .scrolling-notices:hover h4 {
            animation-play-state: paused;
        }

        @keyframes scrollText {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }

        footer {
            background-color: var(--surface);
            color: var(--text-muted);
            box-shadow: 0 -2px 8px rgba(15, 23, 42, 0.05);
        }

        .surface-card {
            background: var(--surface);
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            border-radius: 1rem;
        }

        .text-theme-1 { color: var(--theme-1) !important; }
        .text-theme-2 { color: var(--theme-2) !important; }
        .text-theme-3 { color: var(--theme-3) !important; }
        .bg-theme-4 { background-color: var(--theme-4) !important; }
        .bg-theme-5 { background-color: var(--theme-5) !important; }

        .theme-selector.active,
        .theme-selector:focus,
        .theme-selector:hover {
            background-color: rgba(14, 165, 233, 0.1);
            font-weight: 600;
        }

        .theme-swatch {
            display: inline-block;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container-fluid">

       
        <!-- Logo -->
        <a class="navbar-brand fw-bold text-primary" href="{{ route('dashboard') }}">
            Roman Emi
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#mainNavbar" aria-controls="mainNavbar"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                <li class="nav-item d-flex align-items-center me-2">
                    <form method="POST" action="{{ route('locale.switch') }}">
                        @csrf
                        <select name="locale" class="form-select form-select-sm" onchange="this.form.submit()" aria-label="{{ __('ui.language') }}">
                            <option value="en" @selected(app()->getLocale() === 'en')>{{ __('ui.english') }}</option>
                            <option value="bn" @selected(app()->getLocale() === 'bn')>{{ __('ui.bangla') }}</option>
                        </select>
                    </form>
                </li>

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                       class="nav-link {{ request()->routeIs('dashboard') ? 'active fw-semibold text-primary' : '' }}">
                        Dashboard
                    </a>
                </li>

                @can('customer-list')
                <li class="nav-item">
                    <a href="{{ route('customers.index') }}"
                       class="nav-link {{ request()->routeIs('customers.*') ? 'active fw-semibold text-primary' : '' }}">
                        Customers
                    </a>
                </li>
                @endcan

                @can('location-list')
                <li class="nav-item">
                    <a href="{{ route('locations.index') }}"
                       class="nav-link {{ request()->routeIs('locations.*') ? 'active fw-semibold text-primary' : '' }}">
                        Locations
                    </a>
                </li>
                @endcan

                @can('product-list')
                <li class="nav-item">
                    <a href="{{ route('products.index') }}"
                       class="nav-link {{ request()->routeIs('products.*') ? 'active fw-semibold text-primary' : '' }}">
                        Products
                    </a>
                </li>
                @endcan

                @can('product-model-list')
                <li class="nav-item">
                    <a href="{{ route('products.model') }}"
                       class="nav-link {{ request()->routeIs('products.model') ? 'active fw-semibold text-primary' : '' }}">
                        Product Models
                    </a>
                </li>
                @endcan

                @can('user-list')
                <li class="nav-item">
                    <a href="{{ route('users.index') }}"
                       class="nav-link {{ request()->routeIs('users.*') ? 'active fw-semibold text-primary' : '' }}">
                        Users
                    </a>
                </li>
                @endcan

                @can('role-list')
                <li class="nav-item">
                    <a href="{{ route('roles.index') }}"
                       class="nav-link {{ request()->routeIs('roles.*') ? 'active fw-semibold text-primary' : '' }}">
                        User Roles
                    </a>
                </li>
                @endcan

                <li class="nav-item dropdown ms-lg-3">
            </ul>
        </div>
    </div>
</nav>



    <!-- Scrolling Notices -->
    <div class="scrolling-notices">
        <div class="container">
            @foreach ($notices as $notice)

                <h4>{{ $notice->name }}</h4>
            @endforeach
        </div>
    </div>

    <!-- Main Content -->
    <main class="container mt-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-center py-3 mt-5">
        <small>© {{ date('Y') }} রোমান ইলেকট্রনিক্স ও ফার্নিচার</small>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
    @yield('scripts')

</body>
</html>
