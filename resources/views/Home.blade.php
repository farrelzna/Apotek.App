@extends('Templates.app', ['title' => 'Home || Apotek'])

{{--  
    extends = memanggil file bladenya
    biasanya untuk Templates;
    pemanggilnya = folder.file
--}}



@section('content-dinamis')
    <!-- Hero Section -->
    @if (Session::get('success'))
        <div class="alert alert-success mb-0">{{ Session::get('success') }}</div>
    @endif
    @if (Session::get('error'))
        <div class="alert alert-danger mb-0">{{ Session::get('error') }}</div>
    @endif
    
    <section class="hero">
        <div class="container">
            <h1>Aplikasi Apotek Modern</h1>
            <p class="lead">Kelola apotek Anda dengan mudah dan efisien, dari stok obat hingga transaksi harian.</p>
            <a href="{{ route('medicines') }}"
                class="btn btn-primary btn-lg {{ Route::is('medicines') ? 'active' : '' }} ">Mulai Sekarang</a>
            <!-- Tombol Sign Up dan Sign In -->
        </div>
    </section>

    <!-- About Us Section -->

    <section class="about-section py-5 bg-ligh mt-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="asset/img/2.jpg" alt="About Us Image">
                </div>
                <div class="col-md-6">
                    <h2 class="text-nowrap bg-body-secondary border" style="width: 4rem;">Tentang Kami</h2>
                    <p>Kami adalah penyedia solusi manajemen apotek modern yang dirancang untuk meningkatkan efisiensi dan
                        produktivitas operasional apotek Anda. Dengan pengalaman bertahun-tahun di industri, kami
                        menyediakan platform yang aman, cepat, dan mudah digunakan.</p>
                    <p>Visi kami adalah untuk mendigitalisasi layanan kesehatan melalui inovasi teknologi, memberikan
                        aksesibilitas dan kenyamanan bagi para apoteker dan pasien mereka.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni Section -->

    <section class="py-5">
        <div class="container text-center rounded">
            <h2 class="mb-5">Testimoni Pengguna</h2>
            <div class="row mt-5 d-flex justify-content-around">
                <div class="card col-md-4 p-4 mb-2" style="width: 22rem;">
                    <blockquote class="blockquote">
                        <p>"ApotekApp telah sangat membantu kami dalam mengelola stok dan pelanggan. Sangat user-friendly
                            dan cepat!"</p>
                        <footer class="blockquote-footer mt-2 rounded text-light">Andi, Apotek Sejahtera</footer>
                    </blockquote>
                </div>
                <div class="card col-md-4 p-4 mb-2" style="width: 22rem;">
                    <blockquote class="blockquote">
                        <p>"Dengan ApotekApp, pengelolaan transaksi menjadi jauh lebih cepat, efisien, dan aman. Sangat
                            direkomendasikan!"</p>
                        <footer class="blockquote-footer mt-3 rounded text-light">Rina, Apotek Keluarga</footer>
                    </blockquote>
                </div>
                <div class="card col-md-4 p-4 mb-2" style="width: 22rem;">
                    <blockquote class="blockquote">
                        <p>"Aplikasi ApotekApp ini sangat membantu bisnis kami menjadi lebih efisien dan terorganisir. Kami
                            sangat senang!"</p>
                        <footer class="blockquote-footer mt-3 rounded text-light">Budi, Apotek Maju</footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->

    <section class="py-5" style="background: #E9ECEF">
        <div class="container">
            <h2 class="text-center">Pertanyaan yang Sering Diajukan (FAQ)</h2>
            <div class="accordion mt-4" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Bagaimana cara mendaftar di ApotekApp?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Anda dapat mendaftar dengan mengklik tombol "Mulai Sekarang" di halaman ini dan mengisi
                            informasi yang dibutuhkan.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Apakah data saya aman?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Ya, kami menggunakan enkripsi tingkat tinggi untuk memastikan keamanan data apotek dan pelanggan
                            Anda.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Bagaimana cara menghubungi layanan pelanggan?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Anda bisa menghubungi kami melalui formulir kontak di bawah ini atau langsung melalui email
                            kami.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->

    <section class="py-5">
        <div class="container text-center">
            <h2>Fitur Utama</h2>
            <div class="row mt-5">
                <div class="col-md-4">
                    <i class="bi bi-bag-check-fill features-icon"></i>
                    <h4 class="mt-3">Kelola Stok Obat</h4>
                    <p>Memudahkan pemantauan stok obat dengan sistem otomatis yang terintegrasi.</p>
                </div>
                <div class="col-md-4">
                    <i class="bi bi-people-fill features-icon"></i>
                    <h4 class="mt-3">Manajemen Pelanggan</h4>
                    <p>Mengelola data pelanggan dengan mudah dan memberikan layanan yang lebih personal.</p>
                </div>
                <div class="col-md-4">
                    <i class="bi bi-cash-stack features-icon"></i>
                    <h4 class="mt-3">Transaksi Cepat</h4>
                    <p>Sistem pembayaran dan transaksi yang cepat serta aman untuk kemudahan Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->

    <footer>
        <div class="container">
            <p>&copy; 2024 ApotekApp. All rights reserved.</p>
            <a href="#" class="text-decoration-none">Kebijakan Privasi</a> | <a href="#"
                class="text-decoration-none">Syarat dan Ketentuan</a>
        </div>
    </footer>
@endsection
