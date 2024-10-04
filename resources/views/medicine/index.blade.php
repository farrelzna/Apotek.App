@extends('Templates.app', ['title' => 'Obat II Apotek'])

@section('content-dinamis')
    <div class="d-block mxauto my-6 w-auto p-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2>List Medicine</h2>
            <a href="{{ route('medicines.add') }}" class="btn btn-success mb-3">+ Tambah</a>
        </div>

        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        <table class="table table-bordered table-striped text-center align-middle">
            <thead>
                <tr class="table-secondary">
                    <th>#</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Price</th>
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
                                onclick="editStock('{{ $item['id'] }}')"
                                style="cursor: pointer;">
                                <span style="cursor: pointer; text-decoration: underline;">{{ $item->stock }}</span>
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
                        <td colspan="6" class='text-center text-bold'>Empty Data</td>
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
                            <h5 class="modal-title" id="editStockLabel">Edit Stock</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="medicine-id">
                            <div class="form-group">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" name="stock" id="stock" class="form-control"> 
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
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
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Medicine Data</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete medicine data "<span id="nama-obat"></span>" ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

@push('script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    //fungsi untuk menampilkan modal
    //isi untuk action form
    function showModal(id, name) {
        let action = '{{route("medicines.delete", ":id") }}';
        action = action.replace (':id', id);

        $('#form-delete-obat').attr('action', action);
        //munculkan modal yang id nya exampleModal
        $('#exampleModal').modal('show');
        //innerText pada element html id nama-obat
        console.log(name);
        $('#nama-obat').text(name);
    }

    //fungsi untuk menampilkan modal edit stok sama masukin nilai stok yang mau di edit
    function editStock(id, stock) {
        $('#editStockModal').modal('show');
        $('#medicine-id').val(id);
        $('#stock').val(stock);
    }

    //event listener buat handle submit form secara AJAX
    $('#form-edit-stock').on('submit', function(e){
        // biar form gak ke submit dengan cara biasa (refresh halaman)
        e.preventDefault();

        //ambil id obat dari input hidden
        let id = $('#medicine-id').val();
        //ambil stok baru yang diinput user
        let stock = $('#stock').val();
        // bikin URL buat update stok dengan metode PUT
        let actionUrl = "{{ url('/medicines/update-stock')}}/" + id;

        //kirim request AJAX buat update stok
        $.ajax({
            url: actionUrl, //URL tujuan buat update stok
            type: 'PUT', //guankan metode PUT buat update date
            data: {
                _token: '{{ csrf_token() }}', //Token CSRF biar aman
                stock: stock //data stok baru yang mau di kirim ke server database
            },
            success: function(response) {
                //tutup modal kelas update berhasil
                $('#editStockModal').modal('hide');
                //refresh halaman biar perubahan stok kelihatan
                alert('Stock Update Successful')
                location.reload();
            },
            error: function(xhr) {
                //kasih alert kalau ada error pas update stok
                alert(err.responseJSON.message);
                // console.log(xhr);
            }
    })})
</script>
@endpush