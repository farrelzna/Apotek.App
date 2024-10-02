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
                            <td class="{{ $item['stock'] <= 3 ? 'bg-danger text-white' : 'bg-white text-dark' }}"
                                onclick="editStock('{{ $item['id'] }}')">
                                {{ $item->stock }}
                            </td>
                            <td class="d-flex justify-content-center py-3">
                                <a href="{{ route('medicines.edit', $item['id']) }}" class="btn btn-primary me-3">Edit</a>
                                <button class="btn btn-danger"
                                    onclick="showModal('{{ $item['id'] }}', '{{ $item['name'] }}')">Delete</button>
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
        <!-- Modal Stock -->
        <div class="modal fade" id="editStockModal" tabindex="-1" aria-labelledby="editStockLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="form-edit-stock" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editStockLabel">Edit Stok</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="medicine-id">
                            <div class="form-group">
                                <label for="stock" class="form-label">Stok</label>
                                <input type="number" name="stock" id="stock" class="form-control" value={{ old('stock') }}> 
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Modal Delete-->
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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        // fungsi untuk menampilkan modal
        function showModal(id, name) {
            // isi untuk action form
            let action = '{{ route('medicines.delete', ':id') }}';
            action = action.replace(':id', id);
            // buat atribut actionpada form
            $('#form-delete-obat').attr('action', action);
            // fungsi untuk menampilkan modal
            // munculkan modal yang id nya exampleModal
            $('#exampleModal').modal('show');
            // innertext pada element html id nama-obat
            $('#nama-obat').text(name);
        }

        function editStock(id, stock) {
            $('#medicine-id').val(id);
            $('#stock').val(stock);
            $('#editStockModal').modal('show');
        }

        $('#form-edit-stock').on('submit', function(e) {
            e.preventDefault();

            let id = $('#medicine-id').val();
            let stock = $('#stock').val();
            let actionUrl = '{{ url('/medicines/update-stok') }}/' + id

            $.ajax({
                url: actionUrl,
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    stock: stock
                },
                success: function(response) {
                    $('#editStockModal').modal('hide');
                    location.reload();
                },
                error: function(xhr) {
                    alert('ada masalah waktu update stok')
                }
            });
        });
    </script>
@endpush