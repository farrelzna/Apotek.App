@extends('templates.app', ['title' => 'Tambah Obat II Apotek'])

@section('content-dinamis')

    <div class="m-auto my-6 w-auto p-4" style="width: 65%;">
        <form action="{{ route('medicines.store.add') }}" method="POST" class="p-4 mt-2"
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
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="type" class="form-label">Tipe Obat</label>
                <select name="type" id="type" class="form-control">
                    <option hidden selected disabled>Opsi</option>
                    <option value="Tablet">Tablel</option>
                    <option value="Sirup">Sirup</option>
                    <option value="Kapsul">Kapsul</option>
                </select>
            </div>
            <div class="form-group">
                <label for="price" class="form-label">Harga Obat</label>
                <input type="number" name="price" id="price" class="form-control">
            </div>
            <div class="form-group">
                <label for="stock" class="form-label">Stok Obat</label>
                <input type="number" name="stock" id="stock" class="form-control">
            </div>
            <button class="btn btn-block btn-success">Kirim Data</button>
        </form>
    </div>

@endsection
