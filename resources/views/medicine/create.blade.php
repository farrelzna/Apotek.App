@extends('templates.app', ['title' => 'Tambah Obat II Apotek'])

@section('content-dinamis')

    <div class="mt-5 m-auto my-6 w-auto p-4" style="width: 65%;">
        <form action="{{ route('medicines.add.store') }}" method="POST" class="p-4 mt-2"
            style="border-radius: 10px; box-shadow:-20px -20px 60px #bebebe;">
            @if (Session::get('failed'))
                <div class="alert alert-danger">{{ Session::get('failed') }}</div>
            @endif
            {{-- munculkan error dari $request->validate --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ol>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ol>
                </div>
            @endif
            {{-- aturan form menambah/mengubah/menghapus : 
                1. pastikan <form> ada action dan @method
                    -Get = data di tampilkan di url, ketika form berfunsi seperti pencarian
                    -post = kebalikanya, ketika form berfungsi seperti menambah/mengubah/menghapus
                    -action = diisi dari 
                2. pastikan ada button dngn type submit
                3. pastikan ada name
                4. method post
                5. name nya diambil dari field di migration
                6. harus ada @csrf dibwah <form> : header token mengirim post
                7. form search, action halaman return view, form selain search isi action harus berbeda dengan return view (bukan ke route ynag return view halaman create)
            --}}
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">Nama Obat</label>
                {{-- old('name') : mengambil isi input data dari form sebelum di submit --}}
                <input type="text" name="name" id="name" class="form-control" value={{ old('name') }}>
            </div>
            <div class="form-group mt-3">
                <label for="type" class="form-label">Tipe Obat</label>
                <select name="type" id="type" class="form-control">
                    <option hidden selected disabled>Opsi</option>
                    <option value="Tablet" {{ old('type') == 'Tablet' ? 'selected' : '' }}>Tablet</option>
                    <option value="Sirup" {{ old('type') == 'Sirup' ? 'selected' : '' }}>Sirup</option>
                    <option value="Kapsul" {{ old('type') == 'Kapsul' ? 'selected' : '' }}>Kapsul</option>
                </select >
            </div>
            <div class="form-group mt-3">
                <label for="price" class="form-label">Harga Obat</label>
                <input type="number" name="price" id="price" class="form-control" value{{ old('price') }}>
            </div>
            <div class="form-group mt-3">
                <label for="stock" class="form-label">Stok Obat</label>
                <input type="number" name="stock" id="stock" class="form-control" value={{ old('stock') }}>
            </div>
            <button class="btn btn-block btn-success mt-4">Kirim Data</button>
        </form>
    </div>

@endsection
