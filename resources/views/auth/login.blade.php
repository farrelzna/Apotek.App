@extends('Templates.register', ['title' => 'Login || Apotek'])

@section('content')

    <body class="bg-light">
        <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="card shadow-lg" style="width: 100%; max-width: 600px;">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="text-center">Sign In</h4>
                </div>
                <div class="card-body">
                    @if (Session::get('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif

                    <form action="{{ route('login.process') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" name="email" required class="form-control"
                                placeholder="Enter Your Email">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Confirm Password:</label>
                            <input type="password" name="password" required class="form-control"
                                placeholder="Enter Your Password">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>

                    <div class="text-center mt-3">
                        <a class="link-opacity-75-hover" href="{{ route('register.show') }}">Belum punya akun? Register di sini</a>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
    </body>

    </html>
@endsection
