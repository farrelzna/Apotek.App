@extends('templates.app', ['title' => 'Create Medicine || Apotek'])

@section('content-dinamis')
    <div class="container mt-5">
        <div class="col-md-8 mx-auto card border-light shadow-sm p-4">
            <form action="{{ route('medicines.add.store') }}" method="POST" class="p-2">
                @csrf

                {{-- Success and Failure Messages --}}
                @if (Session::has('failed'))
                    <div class="alert alert-danger">{{ Session::get('failed') }}</div>
                @endif

                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form Title --}}
                <h3 class="mb-4">Add Medicine</h3>

                {{-- Name and Description Side by Side --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nama Obat</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control"
                            placeholder="Masukkan nama obat">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="stock" class="form-label">Stok Obat</label>
                        <input type="number" name="stock" id="stock" value="{{ old('stock') }}" class="form-control"
                            placeholder="Masukkan jumlah stok">
                        @error('stock')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Type and Price Side by Side --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="type" class="form-label">Tipe Obat</label>
                        <select name="type" id="type" class="form-select">
                            <option disabled selected hidden>Pilih tipe obat</option>
                            <option value="Tablet" {{ old('type') == 'Tablet' ? 'selected' : '' }}>Tablet</option>
                            <option value="Sirup" {{ old('type') == 'Sirup' ? 'selected' : '' }}>Sirup</option>
                            <option value="Kapsul" {{ old('type') == 'Kapsul' ? 'selected' : '' }}>Kapsul</option>
                        </select>
                        @error('type')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="price" class="form-label">Harga Obat</label>
                        <input type="number" name="price" id="price" value="{{ old('price') }}"
                            class="form-control" placeholder="Masukkan harga obat">
                        @error('price')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- description Input --}}
                <div class="md-6 mb-4">
                    <label for="description" class="form-label">Deskripsi</label>
                    <input type="text" name="description" id="description" value="{{ old('description') }}"
                        class="form-control" placeholder="Masukkan deskripsi">
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
