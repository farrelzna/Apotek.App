@extends('Templates.app', ['title' => 'Create Account || Apotek '])


@section('content-dinamis')

    <div class="m-auto" style="width:60%">
        <form class="p-5 mt-3" style="border: 1px solid white;" action="{{ route('show.account.create') }}" method="POST">

            {{-- memunculkan teks dari with (''failed) --}}
            @if (Session::get('failed'))
                <div class="alert alert-danger">{{ Session::get('failed') }}</div>
            @endif

            {{-- memunculkan eror dari $request->validate --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ol>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ol>
                </div>
            @endif
            {{-- aturan form mengubah/nemanbah/menghapus
            1.method post
            2.name yg diambil dari nama field di migration
            3.harus ada @crsf dibawah <form> : headers token mengirim data post
            4.form search, action halaman return view, form selain search isi action harus berbeda dgn return view
                (bukan ke route yg return view halaman create)
        --}}

            @csrf
            <div>
                <label for="name" class="form-label ">Name</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <div>
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Password Confirmation</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>

                <label for="name" class="form-label">Role</label>
                <select name="role" id="role" class="form-select">
                    <option hidden selected disabled>Select</option>
                    <option value="admin">Admin</option>
                    <option value="apoteker">Apoteker</option>
                    <option value="users">User</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success mt-3">Submit</button>
        </form>
    </div>
@endsection
