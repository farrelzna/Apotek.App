@extends('Templates.app', ['title' => 'Users || APOTEK'])

@section('content-dinamis')
    <div class="container mt-5">

        <!-- Statistik Card dengan Gaya Sederhana -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card border-light shadow-sm text-center p-3">
                    <h5 class="card-title">Total Account</h5>
                    <p class="card-text display-6"></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-light shadow-sm text-center p-3">
                    <h5 class="card-title">User Accounts</h5>
                    <p class="card-text display-6"></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-light shadow-sm text-center p-3">
                    <h5 class="card-title">Cashier Accounts</h5>
                    <p class="card-text display-6"></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-light shadow-sm text-center p-3">
                    <h5 class="card-title">Online Accounts</h5>
                    <p class="card-text display-6"></p>
                </div>
            </div>
        </div>
        <!-- End Statistik Card dengan Gaya Sederhana -->

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h5">Data Users</h2>
            <a href="{{ route('show.account.create') }}" class="btn btn-success">+ Add Account</a>
        </div>

        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        <!-- Tabel User -->
        <div class="row mb-4">
            <div class="col-md">
                <div class="card border-light shadow-sm text-center p-3">
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr class="table-light">
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ ucfirst($item->role) }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('users.edit', $item->id) }}"
                                                class="btn btn-primary btn-sm me-2">Edit</a>
                                            <button class="btn btn-danger btn-sm"
                                                onclick="showModal('{{ $item->id }}', '{{ $item->name }}')">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="" id="form-delete-user" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete User Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete User data "<span id="nama-user"></span>"?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        function showModal(id, name) {
            let action = '{{ route('users.delete', ':id') }}'.replace(':id', id);
            $('#form-delete-user').attr('action', action);
            $('#exampleModal').modal('show');
            $('#nama-user').text(name);
        }
    </script>
@endpush
