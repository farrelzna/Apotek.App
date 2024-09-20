@extends('Templates.app', ['title' => 'Obat II Apotek'])

@section('content-dinamis')
    <div class="d-block mxauto my-6 w-auto p-4">
        <a href="{{ route('medicines.add') }}" class="btn btn-success mb-3">+ Tambah</a>
        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <table class="table table-bordered table-striped text-center">
            <thead>
                <tr class="table-secondary">
                    <th>#</th>
                    <th>Nama obat</th>
                    <th>Tipe</th>
                    <th>Harga</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                @if (count($medicines) > 0)
                    {{-- $medicines sumbernya/namanya dari compact --}}
                    @foreach ($medicines as $index => $item)
                        <tr>
                            <td>{{ ($medicines->currentPage() - 1) * $medicines->perPage() + ($index + 1) }}</td>
                            {{-- $item ['nama_field_migration'] --}}
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['type'] }}</td>
                            <td>Rp.{{ number_format($item['price'], 0, ',', '.') }}</td>
                            {{-- ternary jika stock kurang dari tiga maka akan bewarna merah --}}
                            <td class="{{ $item['stock'] <= 3 ? 'bg-danger text-white' : 'bg-white text-dark' }}">
                                {{ $item->stock }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class='text-center text-bold'>Data Kosong</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="d-flex justify-content-end mt-4">
            {{-- links() : menampilkan tombol navigasi, digunakan hanya ketika di controllernya pake pagiante() atau simplePaginate() --}}
            {{ $medicines->links() }}
        </div>
    </div>
@endsection
