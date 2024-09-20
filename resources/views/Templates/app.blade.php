<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="{{ asset('asset/img/1.webp') }}">
</head>

@stack('style')

<body>

    {{-- navbar --}}

    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow sticky-top" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand fs-3" href="#">Apotek</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('welcome') ? 'active' : '' }}" aria-current="page"
                            href="home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('landing_page') ? 'active' : '' }}"
                            href="{{ route('landing_page') }}">Landing</a>
                    </li>
                </ul>
                <form class="d-flex position-absolute top-50 start-50 translate-middle" role="search"
                    action="{{ route('medicines') }}" method="GET">
                    {{-- mengaftikan search 
                        1. pastikan <form> ada action dan @method
                            -Get = data di tampilkan di url, ketika form berfunsi sebagai pencarian
                            -post = kebalikanya, ketika form berfungsi sebagai menambah/mengubah/menghapus
                            -action = diisi dari 
                        2. pastikan ada button dngn type submit
                        3. pastikan ada name 
                    --}}
                    <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search"
                        name="search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
            <div class="collapse navbar-collapse position-absolute top-50 end-0 translate-middle-y"
                id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('medicines') ? 'active' : '' }}"
                            href="{{ route('medicines') }}">Data Obat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('medicines') ? 'active' : '' }}"
                            href="{{ route('medicines') }}">Pembelian</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- wadah untuk menampung seluruh view --}}

    @yield('content-dinamis')

    {{-- footer --}}

    <div class="card text-center">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="true" href="#">Active</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                </li>
            </ul>
        </div>
        <div class="row p-3 mx-auto">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    Quote
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p>A well-known quote, contained in a blockquote element.</p>
                        <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source
                                Title</cite></footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>

    {{-- script --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    @stack('script')
</body>


</html>