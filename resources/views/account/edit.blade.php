@extends('Templates.app', ['title' => 'Edit obat || apotek'])

@section('content-dinamis')
    @if (Session::get('failed'))
        <div class="alert alert-danger">{{ Session::get('failed') }}</div>
    @endif

    <div class="mt-3 m-auto my-6 w-auto p-4" style="width:65%;">

        <form action="{{ route('users.edit.update', $users['id']) }}" method="POST" class="p-4 mt-2"
            style="border-radius: 10px; box-shadow:-20px -20px 60px rgba(0, 0, 0, 0.20);">
            @csrf
            @method('PATCH')

            <div class="form-group ">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $users['name'] }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="{{ $users['email'] }}">
            </div>
            <div class="form-group">
                <label for="passwordw" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" value="{{ $users['password'] }}">
            </div>
            <div class="form-group ">
                <label for="role" class="form-label">Role</label>
                <select name="role" id="role" class="form-select">
                    <option value="Admin" {{ $users['role'] == 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Apoteker" {{ $users['role'] == 'Apoteker' ? 'selected' : '' }}>Apoteker</option>
                    <option value="Users" {{ $users['role'] == 'Users' ? 'selected' : '' }}>Pengguna</option>
                </select>
            </div>

            @error('role')
                <small class="text-danger">{{ $message }}</small>
            @enderror


            @error('name')
                {{-- $message == memunculkan eror terkait dengan price --}}
                <small class="text-danger">{{ $message }}</small>
            @enderror

            @error('email')
                {{-- $message == memunculkan eror terkait dengan stock --}}
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <button type="submit" class="btn btn-success mt-4">Ubah Data</button>
        @endsection

    </form>
</div>
