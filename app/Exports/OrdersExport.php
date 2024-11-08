<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class OrdersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Order::limit(10)->get();
    }

    public function headings(): array
    {
        return [
            "#",
            "Nama Kasir",
            "Daftar Obat",
            "Nama Pembeli",
            "Total Harga",
            "Tanggal Pembelian",
        ];
    }

    public function map($order): array {

        $daftarObat = '';

        foreach ($order->medicines as $key => $value) {
            $format = $key+1 . '. ' . $value['name'] . ' | ' . $value['quantity'] . ' (pcs) | Rp. ' . number_format($value['price'], 0, ',', '.');
            $daftarObat .= $format;
        }

        return [
            $order->id,
            $order->user->name,
            $daftarObat,
            $order->name_customer,
            "Rp. " . number_format($order->total_price, 0, ',', '.'),
            \Carbon\Carbon::parse($order->created_at)->format('d F Y'),
        ];
    }
}
