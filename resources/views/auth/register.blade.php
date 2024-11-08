@extends('Templates.app', ['title' => 'Register || Apotek'])

@section('content-dinamis')

    <body clas`s="bg-light">
        <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="card shadow-lg" style="width: 100%; max-width: 600px;">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="text-center">Sign Up</h4>
                </div>
                <div class="card-body">
                    @if (Session::get('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                    <form action="{{ route('register.process') }}" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" required class="form-control"
                                    placeholder="Enter Your name">
                                @if ($errors->has('name'))
                                    <div class="text-danger mt-1">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" required class="form-control"
                                    placeholder="Enter Your email">
                                @if ($errors->has('email'))
                                    <div class="text-danger mt-1">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" required class="form-control"
                                    placeholder="Enter Your password">
                                @if ($errors->has('password'))
                                    <div class="text-danger mt-1">{{ $errors->first('password') }}</div>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" required
                                    class="form-control" placeholder="Confirm Your password">
                                @if ($errors->has('password_confirmation'))
                                    <div class="text-danger mt-1">{{ $errors->first('password_confirmation') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Role</label>
                            <select name="role" id="role" class="form-select">
                                <option hidden selected disabled>Pilih</option>
                                <option value="Apoteker" >Apoteker</option>
                                <option value="Users">Pengguna</option>
                            </select>
                            @if ($errors->has('role'))
                                <div class="text-danger mt-1">{{ $errros->first('email') }}</div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Register</button>
                    </form>

                    <div class="text-center mt-3">
                        <a href="{{ route('login') }}" class="link-opacity-75-hover no-underline">Already have an account?
                            Login here</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
@endsection
