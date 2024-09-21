@extends('Templates.app', ['title' => 'Obat II Apotek'])

@section('content-dinamis')
    <div class="d-block mxauto my-6 w-auto p-4">
        <a href="{{ route('medicines.add') }}" class="btn btn-success mb-3">+ Tambah</a>
        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <table class="table table-bordered table-striped text-center align-middle">
            <thead>
                <tr class="table-secondary">
                    <th>#</th>
                    <th>Nama Obat</th>
                    <th>Tipe</th>
                    <th>Harga</th>
                    <th>Stock</th>
                    <th>Action</th>
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
                                {{ $item->stock }}
                            </td>
                            <td class="d-flex justify-content-center py-3">
                                <button class="btn btn-primary me-3">Edit</button>
                                <button class="btn btn-danger"
                                    onclick="showModal('{{ $item->id }}', '{{ $item->name }}')">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class='text-center text-bold'>Data Kosong</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="d-flex justify-content-end mt-4">
            {{-- links() : menampilkan tombol navigasi, digunakan hanya ketika di controllernya pake pagiante() atau simplePaginate() --}}
            {{ $medicines->links() }}
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="" id="form-delete-obat" method="POST">
                    @csrf
                    {{-- menimpa method "POST" diganti menjadi delete, sesuai dengan http method untuk menghapus data --}}
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data Obat</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah anda yakin ingin menghapus data obat "<span id="nama-obat"></span>" ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    {{-- script --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>

        //  fungsi untuk menampilkan
        function showModal(id, name) {
            //  isi untk action form
            let action = '{{ route("medicines.delete", ":id") }}';
            action = action.replace(':id', id);
            //buat attribute action pada form
            $('#form-delete-obat').attr('action', action);
            //  munculkan modal id nya exampleModal
            //  id = id yang dikirimkan dari controller
            $('#exampleModal').modal('show');
            //  set id
            $('#nama-obat').text(name);
        }
    </script>
@endpush
