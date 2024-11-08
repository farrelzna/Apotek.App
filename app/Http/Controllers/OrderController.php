<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Exports\OrdersExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as domPDF;


class OrderController extends Controller
{

    public function index(Request $request)
    {
        // Ambil input pencarian
        $searchDate = $request->search;

        if ($searchDate) {
            // Mengonversi searchDate menjadi format 'Y-m-d' menggunakan Carbon
            $formattedSearchDate = Carbon::parse($searchDate)->format('Y-m-d');

            // Mencari berdasarkan tanggal yang diformat
            $orders = Order::whereDate('created_at', '=', $formattedSearchDate)->simplePaginate(5);
        } else {
            // Jika tidak ada pencarian tanggal, tampilkan semua order
            $orders = Order::simplePaginate(5);
        }

        return view('order.index', compact('orders'));
    }

    public function indexAdmin(Request $request)
    {
        // Ambil input pencarian
        $searchDate = $request->search;

        if ($searchDate) {
            // Mengonversi searchDate menjadi format 'Y-m-d' menggunakan Carbon
            $formattedSearchDate = Carbon::parse($searchDate)->format('Y-m-d');

            // Mencari berdasarkan tanggal yang diformat
            $orders = Order::whereDate('created_at', '=', $formattedSearchDate)->simplePaginate(5);
        } else {
            // Jika tidak ada pencarian tanggal, tampilkan semua order
            $orders = Order::simplePaginate(5);
        }


        return view('order.admin.rekapData', compact('orders'));
    }

    public function exportExcel()
    {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }

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

            return redirect()->route('orders.show', $addOrder)->with('success', 'Order Berhasil Ditambahkan');
        }
    }

    public function show($id)
    {
        $order = Order::find($id);
        return view('order.print', compact('order'));
    }

    public function downloadPdf($id)
    {
        //kita bakal mengambil data order yang nanti diubah menjadi array

        $order = Order::find($id)->toArray();

        //agar data order bisa kita kasih menggunakan share
        view()->share('order', $order);
        //ambil halaman tujuan kita

        $pdf = domPDF::loadView('order.downloadPDF', $order);

        //tinggal buat agar di download
        return $pdf->download('invoice.pdf');
    }
}
