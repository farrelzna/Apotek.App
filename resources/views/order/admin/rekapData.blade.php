@extends('Templates.app', ['title' => 'Show List || Apotek'])

@section('content-dinamis')
    <div class="container mt-5">
        @if (Auth::user()->role === 'Admin')
        <div class="d-flex justify-content-between mb-4 align-items-center">
            <h2 class="h5">Data Medicine</h2>
            <div class="d-flex gap-2">
                <form class="d-flex" role="search" action="{{ route('orders.admin') }}" method="GET">
                    <a href="{{  route('orders.export.excel') }}" class="btn btn-success btn-sm me-2 w-100">Export Excel</a>
                    <input class="form-control form-control-sm me-2" type="date"
                    placeholder="Cari Pesanan" name="search" value="{{ request()->search }}">
                    <button class="btn btn-outline-primary btn-sm" type="submit">Cari</button>
                    <a href="{{ route('orders.admin') }}" class="btn btn-secondary btn-sm ms-2">Clear</a>
                </form>
            </div>
        </div>
        @endif
        
        <div class="row mb-4">
            <div class="col-md">
                <div class="card border-light shadow-sm p-3">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Pesanan</th>
                                    <th>Kasir</th>
                                    <th>Tanggal</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                                @foreach ($orders as $index => $order)
                                    <tr>
                                        <td class="text-center">{{ ($orders->currentPage() - 1) * $orders->perPage() + ($index + 1) }}</td>
                                        <td>{{ $order->name_customer }}</td>
                                        <td>
                                            @foreach ($order['medicines'] as $medicine)
                                                <strong>{{ $medicine['name'] }}</strong> | {{ $medicine['quantity'] }}  | Rp. {{ number_format($medicine['price'], 0, ',', '.') }}
                                                <br>
                                            @endforeach
                                        </td>
                                        <td>{{ $order['user']['name'] }}</td>
                                        {{-- <td>{{ $order['created_at']->format('d-m-Y') }}</td> --}}
                                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d F Y') }}</td>
                                        <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-end mt-3 mb-3">
                        {{ $orders->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
    
@endsection
