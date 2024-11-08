@extends('Templates.app', ['title' => 'Edit Medicine || Apotek'])

@section('content-dinamis')
    <div class="container mt-5">
        <div class="col-md-8 mx-auto card border-light shadow-sm p-4">
            <form action="{{ route('medicines.edit.update', $medicine['id']) }}" method="POST" class="p-2">
                @csrf
                @if (Session::get('failed'))
                    <div class="alert alert-danger">{{ Session::get('failed') }}</div>
                @endif
                @if (Session::get('failed'))
                    <div class="alert alert-danger">{{ Session::get('failed') }}</div>
                @endif

                {{-- Form Title --}}
                <h3 class="mb-4">Edit Medicine</h3>
                
                {{-- Name and Description Side by Side --}}
                @method('PATCH')
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nama Obat</label>
                        {{-- old('name') : mengambil isi input data dari form sebelum di submit --}}
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ $medicine['name'] }}">
                    </div>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <div class="col-md-6">
                            <label for="stock" class="form-label">Stok Obat</label>
                            <input type="number" name="stock" id="stock" class="form-control"
                                value="{{ $medicine['stock'] }}">
                        @error('stock')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                
                {{-- Type and Price Side by Side --}}
                <div class="row mb-3">
                    <div class="col-md-6">
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
                    <div class="col-md-6">
                        <label for="price" class="form-label">Harga Obat</label>
                        <input type="number" name="price" id="price" class="form-control"
                        value="{{ $medicine['price'] }}">
                        @error('price')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                
                {{-- description Input --}}
                <div class="md-6 mb-4">
                    <label for="description" class="form-label">Deskripsi</label>
                    <input type="text" name="description" id="description" class="form-control"
                        value={{ $medicine['description'] }}>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                </div>
                
                {{-- Submit Button --}}
                <div class="text-center">
                    <button type="submit" class="btn btn-success w-100 mt-3">Kirim Data</button>
                </div>
            </form>
        </div>
    </div>
@endsection
