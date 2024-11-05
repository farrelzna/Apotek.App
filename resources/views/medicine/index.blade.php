@extends('Templates.app', ['title' => 'Obat || Apotek'])

@section('content-dinamis')
    <div class="container mt-5">

        <!-- Statistik Card dengan Gaya Sederhana -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card border-light shadow-sm text-center p-3">
                    <h5 class="card-title">Total Product</h5>
                    <p class="card-text display-6"></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-light shadow-sm text-center p-3">
                    <h5 class="card-title">Total Sales</h5>
                    <p class="card-text display-6"></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-light shadow-sm text-center p-3">
                    <h5 class="card-title">Total Stock</h5>
                    <p class="card-text display-6"></p>
                </div>
            </div>
        </div>
        <!-- End Statistik Card -->

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h5">Data Medicine</h2>
            <a href="{{ route('medicines.add') }}" class="btn btn-success">+ Add Products</a>
        </div>

        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        <!-- Tabel dengan Sorting -->
        <div class="row mb-4">
            <div class="col-md">
                <div class="card border-light shadow-sm text-center p-3">
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr class="table-light">
                                <th>#</th>
                                <th><a href="#" class="text-dark">Name</a></th>
                                <th><a href="#" class="text-dark">Type</a></th>
                                <th><a href="#" class="text-dark">Price</a></th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($medicines->count() > 0)
                                @foreach ($medicines as $index => $item)
                                    <tr>
                                        <td>{{ ($medicines->currentPage() - 1) * $medicines->perPage() + ($index + 1) }}
                                        </td>
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ $item['type'] }}</td>
                                        <td>Rp.{{ number_format($item['price'], 0, ',', '.') }}</td>
                                        <td class="{{ $item['stock'] <= 3 ? 'bg-danger text-white' : '' }}"
                                            onclick="editStock('{{ $item['id'] }}', '{{ $item['stock'] }}')"
                                            style="cursor: pointer;">
                                            <span
                                                style="cursor: pointer; text-decoration: underline;">{{ $item->stock }}</span>
                                        </td>
                                        <td class="d-flex justify-content-center">
                                            <a href="{{ route('medicines.edit', $item['id']) }}"
                                                class="btn btn-primary btn-sm me-2">Edit</a>
                                            <button class="btn btn-danger btn-sm"
                                                onclick="showModal('{{ $item['id'] }}', '{{ $item['name'] }}')">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class='text-center'>Empty Data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-4">
            {{ $medicines->links() }}
        </div>

        <!-- Modal Edit Stok -->
        <div class="modal fade" id="editStockModal" tabindex="-1" aria-labelledby="editStockModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="form-edit-stock" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editStockModalLabel">Edit Stock</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="medicine-id" name="medicine_id">
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" class="form-control" id="stock" name="stock" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Modal Edit Stok -->

        <!-- Modal Hapus -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="" id="form-delete-obat" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete Medicine Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete medicine "<span id="nama-obat"></span>"?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Modal Hapus -->

    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function showModal(id, name) {
            let action = '{{ route('medicines.delete', ':id') }}'.replace(':id', id);
            $('#form-delete-obat').attr('action', action);
            $('#exampleModal').modal('show');
            $('#nama-obat').text(name);
        }

        function editStock(id, stock) {
            $('#editStockModal').modal('show');
            $('#medicine-id').val(id);
            $('#stock').val(stock);
        }

        $('#form-edit-stock').on('submit', function(e) {
            e.preventDefault();
            let id = $('#medicine-id').val();
            let stock = $('#stock').val();
            let actionUrl = "{{ url('/medicines/update-stock') }}/" + id;

            $.ajax({
                url: actionUrl,
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    stock: stock
                },
                success: function(response) {
                    $('#editStockModal').modal('hide');
                    alert('Stock Update Successful');
                    location.reload();
                },
                error: function(xhr) {
                    alert(xhr.responseJSON.message);
                }
            });
        });
    </script>
@endpush
