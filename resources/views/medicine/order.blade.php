@extends('Templates.app', ['title' => 'Order || Apotek'])

@section('content-dinamis')
    <div class="d-block mxauto my-6 w-auto p-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Orders</h2>
            <a href="{{ route('medicines.add') }}" class="btn btn-success mb-3">+ Tambah</a>
        </div>
    </div>

    <div class="container">
        <div class="row">
            @if (count($medicine) > 0)
                @foreach ($medicine as $index => $item)
                    {{-- Memulai baris baru setelah setiap 2 item --}}
                    @if ($index % 2 == 0)
        </div>
        <div class="row mb-4"> {{-- Menutup row lama dan membuka row baru --}}
            @endif
            <div class="col-md-6 mb-4"> {{-- Kolom yang berisi satu card --}}
                <div class="card align-middle d-flex justify-content-around" style="width: 100%;">
                    <img src="" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item['name'] }}</h5>
                        <h6 class="card-title">Rp. {{ number_format($item['price'], 0, ',', '.') }} - {{ $item['type'] }}</h6>
                        <p class="card-text">{{ $item['description'] }}</p>
                        {{-- Memindahkan informasi Stock di sini sebelum tombol --}}
                        <h6 class="card-title">Stock : {{ $item['stock'] }}</h6>
                        {{-- Membuat tombol Beli dan Keranjang bersebelahan --}}
                        <div class="d-flex justify-content-between mt-3">
                            <a href="#" class="btn btn-success w-50">Beli</a>
                            <a href="#" class="btn btn-primary">Keranjang</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="col-12 text-center">
                <h4 class='text-bold'>Empty Data</h4>
            </div>
            @endif
        </div>
    </div>
@endsection
