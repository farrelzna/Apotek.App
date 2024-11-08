@extends('Templates.app', ['title' => 'Print || Apotek'])

@section('content-dinamis')
    <div class="container mt-5">
        <div class="col-md-8 mx-auto card border-light shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h5">Orders Medicine</h2>
                <a class="btn btn-outline-success btn-sm" href="{{ route('orders.downloadPDF', $order['id'] . '.pdf') }}">Cetak (.pdf)</a>
            </div>

            <div class="mb-4">
                <div class="info">
                    <p>
                        Alamat sepanjang jalan kenangan<br>
                        Email: apotekjayaabadi@gmail.com<br>
                        Phone: 000-111-2222
                    </p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Obat</th>
                                <th>Total</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order['medicines'] as $medicine)
                                <tr>
                                    <td>{{ $medicine['name'] }}</td>
                                    <td>{{ $medicine['quantity'] }}</td>
                                    <td>Rp. {{ number_format($medicine['price'], 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="2"><strong>PPN (10%)</strong></td>
                                @php
                                    $ppn = $order['total_price'] * 0.1;
                                @endphp
                                <td>Rp. {{ number_format($ppn, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Total Harga</strong></td>
                                <td>Rp. {{ number_format($order['total_price'], 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="legalcopy">
                <p class="small text-muted"><strong>Terima kasih atas pembelian Anda!</strong> Lorem ipsum dolor sit amet consectetur adipisicing
                    elit. Maiores natus et numquam ducimus dolorum tenetur.</p>
                <a class="btn btn-outline-primary btn-sm" href="{{ route('orders') }}">Back</a>
            </div>
        </div>
    </div>
@endsection
