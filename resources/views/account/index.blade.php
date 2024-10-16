@extends('Templates.app', ['title' => 'Users || APOTEK'])

@section('content-dinamis')
    <div class="d-block mxauto my-6 w-auto p-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2>List Users</h2>
            <a href="{{ route('show.account.create') }}" class="btn btn-success mb-3">+ Tambah</a>
        </div>
        
        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        <table class="table table-bordered table-striped text-center align-middle">
            <thead>
                <tr class="table-secondary">
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
                        <td>{{ $item->role }}</td>
                        <td class="d-flex justify-content-center py-1">
                            <a href="{{ route('users.edit', $item['id']) }}" class="btn btn-primary me-3">Edit</a>
                            <button class="btn btn-danger"
                                onclick="showModal('{{ $item->id }}', '{{ $item->name }}')">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Hapus -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="" id="form-delete-user" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Users Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete User data "<span id="nama-user"></span>" ?
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
            let action = '{{ route('users.delete', ':id') }}';
            action = action.replace(':id', id);
            $('#form-delete-user').attr('action', action);
            $('#exampleModal').modal('show');
            $('#nama-user').text(name);
        }
    </script>
@endpush
