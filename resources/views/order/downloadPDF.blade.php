<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .bg-white {
            background-color: white;
        }
        .mt-4 {
            margin-top: 1.5rem;
        }
        .p-4 {
            padding: 1.5rem;
        }
        .container {
            margin: 2.5rem;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table-bordered {
            border: 1px solid #ddd;
        }
        .table-striped tr:nth-child(odd) {
            background-color: #f9f9f9;
        }
        .table-light {
            background-color: #f8f9fa;
        }
        th, td {
            padding: 0.75rem;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
        }
        .payment {
            font-weight: bold;
        }
        .text-green {
            color: green;
        }
        .text-muted {
            color: #6c757d;
        }
        .d-flex {
            display: flex;
        }
        .justify-content-between {
            justify-content: space-between;
        }
        .justify-content-center {
            justify-content: center;
        }
        center {
            text-align: center;
        }
        .info h2 {
            margin: 0;
            color: green;
        }
        .info p {
            color: #6c757d;
        }
    </style>
</head>
<body>

    <div class="bg-white mt-4 p-4">
        <center id="top">
            <div class="info">
                <h2 class="text-green">Apotek Jaya</h2>
                <p class="text-muted">Struk Pembelian</p>
            </div>
        </center>

        <div class="d-flex justify-content-between mt-3">
            <div>
                <strong>Tanggal : </strong> {{ date('d-m-Y') }}<br />
                <strong>No. Order : </strong> {{$order['id'] }}
            </div>
        </div>

        <div id="mid" class="mt-4">
            <p>
                <strong>Alamat:</strong> Sepanjang Jalan Kenangan<br />
                <strong>Email:</strong> apotekjaya@gmail.com<br />
                <strong>Phone:</strong> 0123 8219 38091
            </p>
        </div>

        <div class="container m-5">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Obat</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Harga (Rp)</th>
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

            @php
                $ppn = $order['total_price'] * 0.1;
                $totalHarga = $order['total_price'] + $ppn;
            @endphp

            <tr>
                <td colspan="2" class="payment">PPN (10%)</td>
                <td class="payment">Rp. {{ number_format($ppn, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="2" class="payment">Total Harga</td>
                <td class="payment">Rp. {{ number_format($totalHarga, 0, ',', '.') }}</td>
            </tr>
        </table>
        </div>

        <div style="display: flex; justify-content:center;">
            <p class="text-muted">Terimakasih atas pembelian Anda!</p>
            <p class="text-muted">Semoga lekas sembuh.</p>
        </div>

        <p class="d-flex justify-content-center text-muted mt-4">Kami berharap Anda puas dengan pelayanan kami, jangan ragu untuk kembali lagi.</p>
    </div>

</body>
</html>