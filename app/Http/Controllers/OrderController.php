<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create()
    {
        $medicines = Medicine::where('stock', '>', 0)->get();

        return view('order.create', compact('medicines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_customer' => 'required',
            'medicines' => 'required',
        ]);

        $countNumber = array_count_values($request->medicines);
        $arrayFormat = [];

        foreach ($countNumber as $key => $value) {
            $detailMedicine = Medicine::find($key);

            // Check if stock is sufficient
            if ($detailMedicine['stock'] < $value) {
                $msg = 'Tidak Dapat Membeli Obat "' . $detailMedicine['name'] . '", Sisa Obat "' . $detailMedicine['stock'] . '", Obat Tidak Cukup!';
                return redirect()->back()->withInput()->with('failed', $msg);
            }

            $medicineFormat = [
                'id' => $key,
                'name' => $detailMedicine['name'],
                'price' => $detailMedicine['price'],
                'quantity' => $value,
                'subPrice' => $value * $detailMedicine['price']
            ];

            array_push($arrayFormat, $medicineFormat);
        }

        $totalPrice = array_sum(array_column($arrayFormat, 'subPrice'));

        $addOrder = Order::create([
            'user_id' => Auth::user()->id,
            'medicines' => $arrayFormat,
            'name_customer' => $request->name_customer,
            'total_price' => $totalPrice
        ]);

        if ($addOrder) {
            foreach ($arrayFormat as $medicine) {
                $medicineBefore = Medicine::find($medicine['id']);
                $medicineBefore->update([
                    'stock' => $medicineBefore['stock'] - $medicine['quantity']
                ]);
            }

            return redirect()->back()->with('success', 'Order Berhasil Ditambahkan');
        }
    }
}
