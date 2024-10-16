@extends('Templates.app', ['title' => 'Edit Obat II Apotek'])

@section('content-dinamis')
    <div class="mt-5 m-auto my-6 w-auto p-4" style="width: 65%;">
        <form action="{{ route('medicines.edit.update', $medicine['id']) }}" method="POST" class="p-4 mt-2" style="border-radius: 10px; box-shadow:-20px -20px 60px #bebebe;">
            @if (Session::get('failed'))
                <div class="alert alert-danger">{{ Session::get('failed') }}</div>
            @endif
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="name" class="form-label">Nama Obat</label>
                {{-- old('name') : mengambil isi input data dari form sebelum di submit --}}
                <input type="text" name="name" id="name" class="form-control" value="{{ $medicine['name'] }}">
            </div>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <div class="form-group">
                <label for="description" class="form-label">Deskripsi</label>                
                <input type="text" name="description" id="description" class="form-control" value={{ old('name') }}>
            </div>
            @error('description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <div class="form-group mt-3">
                <label for="type" class="form-label">Tipe Obat</label>
                <select name="type" id="type" class="form-control">
                    <option hidden selected disabled>Opsi</option>
                    <option value="Tablet" {{ $medicine['type'] == 'tablet' ? 'selected' : '' }}>Tablet</option>
                    <option value="Sirup" {{ $medicine['type'] == 'sirup' ? 'selected' : '' }}>Sirup</option>
                    <option value="Kapsul" {{ $medicine['type'] == 'kapsul' ? 'selected' : '' }}>Kapsul</option>
                </select>
                @error('type')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="price" class="form-label">Harga Obat</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ $medicine['price'] }}">
            </div>
            @error('price')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <div class="form-group mt-3">
                <label for="stock" class="form-label">Stok Obat</label>
                <input type="number" name="stock" id="stock" class="form-control" value="{{ $medicine['stock'] }}">
            </div>
            @error('stock')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <button type="submit" class="btn btn-block btn-success mt-4">Kirim Data</button>
        </form>
    </div>
@endsection