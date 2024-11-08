<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="{{ asset('asset/img/1.webp') }}">
    <link rel="stylesheet" href="asset/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>

@stack('style')

<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow sticky-top p-3" data-bs-theme="dark">
        <div class="container-fluid">
            @if (Auth::check())
                <a class="navbar-brand fs-3" href="#">Apotek</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" aria-current="page"
                                href="{{ route('home') }}">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('medicines') ? 'active' : '' }}"
                                href="{{ route('medicines') }}">Medicine</a>
                        </li>

                        @if (Auth::user()->role === 'Apoteker')
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('orders') ? 'active' : '' }}"
                                    href="{{ route('orders') }}">Orders</a>
                            </li>
                        @endif
                        @if (Auth::user()->role === 'Admin')
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('orders') ? 'active' : '' }}"
                                    href="{{ route('orders.admin') }}">Data Pembelian</a>
                            </li>
                        @endif
            @endif
            </ul>

            @if (Auth::check())
                {{-- Search Bar --}}
                <form class="d-flex me-auto" role="search"
                    action="{{ request()->routeIs('medicines') ? route('medicines') : route('users') }}"
                    method="GET">
                    <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search"
                        name="search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            @endif

            @guest

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('login') ? 'active' : '' }}" href="{{ route('login') }}">Sign
                            In</a>
                    </li>
                    <li class="nav-item">
                        <a style="cursor: pointer;"
                            class="nav-link {{ Route::is('register.show') ? 'active' : '' }}"href="{{ route('register.show') }}">Sign
                            Up</a>
                    </li>

                @endguest

                @auth

                    <div class="btn-group dropstart">
                        <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>

                            @if (Auth::user()->role === 'Admin')
                                <li><a class="dropdown-item" href="{{ route('users') }}">Data User</a></li>
                            @endif

                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="/Logout"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            </li>
                        </ul>
                        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                            @csrf
                        </form>
                    </div>

                @endauth
            </ul>
        </div>
        </div>
    </nav>

    {{-- Wadah untuk konten dinamis --}}
    @yield('content-dinamis')

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('script')
</body>

</html>
