<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//  import model
use App\Models\Medicine;

class MedicineController extends Controller
{
    public function stockEdit(Request $request, $id)
    {
        //  mencari data sesuai id
        $medicine = Medicine::findOrFail($id);
        $medicine->stock = $request->input('stock');
        $medicine->save();

        if (isset($request->stock)) {
            return response()->json(["failed" => "STOCK TIDAK KOSONG !"], 200);
        }

        $medicine = Medicine::findOrFail($id);

        if ($request->stock < $medicine['stock']) {
            return response()->json(["failed" => "STOCK TIDAK BOLEH KECIL DARI STOCK SEBELUMNYA !"], 200);
        }

        return response()->json(["success" => "STOCK BERHASIL DIUBAH !"], 200);
    }

    public function updateStock(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'stock' => 'required|integer|min:0',
        ]);

        // Temukan obat berdasarkan ID
        $medicine = Medicine::find($id);
        if (!$medicine) {
            return response()->json(['error' => 'Obat tidak ditemukan'], 404);
        }

        // Update stok obat
        $medicine->stock = $request->stock;
        $medicine->save();

        return response()->json(['success' => true, 'message' => 'Stok berhasil diupdate!']);
    }

   ///////////////////////////////////////////////////////////////////////////////////////////////////

    //  Request $request = mengambil semua data dari form yang dikirim ke action yg terhubung dengan func ini
    public function index(Request $request)
    {
        //  mengambil semua data
        //  mengambil data berdasarkan id : nama model::all()
        //  nama model sesuaikan dengan data apa ynag mau dimunculim
        //  simple pagination() : berfundi untuk mebuat pagination dengan jumlah data 5per halaman
        //  compact : mengirim data ke blade : compact('namavariable')
        //  $medicines = Medicine::all()->simplePaginate(5);
        //  where('nama_field_migration, 'operator', 'value') : mencari
        //  operator ->=, <, >, <-, <=, >=, !=, like
        //  '%' depan = mencari kata belakang
        //  '%' belakanag = mencari kata depan
        //  orderby : mengurutkan berdasarkan field migration terntentu
        //  ASC : ascending (kecil ke besar);
        //  DSC : descending (besar ke kecil);
        // Mengambil semua data dari tabel obats

        $medicines = Medicine::where('name', 'like', '%' . $request->search . '%')->orderBy('name', 'asc')->simplePaginate(6);
        $totalProduct = Medicine::distinct('name')->count('name');
        
        //compact : mengirim data ke blade : compact('namavariable')
        return view('medicine.index', compact('medicines', 'totalProduct'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('medicine.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //  validasi data agar pengguna mengisi input form ga asal asalan
        //  required : wajib diisi

        $request->validate([
            'name' => 'required|min:5|max:20',
            'description' => 'required|min:1|max:100',
            'type' => 'required',
            'stock' => 'required',
            'price' => 'required|numeric',
        ], [
            'name.required' => 'NAMA HARUS DI ISI !',
            'name.min' => 'NAMA TERLALU PENDEK !',
            'name.max' => 'NAMA TERLALU PANJANG !',
            'description.required' => 'DESKRIPSI HARUS DI ISI !',
            'description.min' => 'DESKRIPSI TERLALU PENDEK !',
            'description.max' => 'DESKRIPSI TERLALU PANJANG !',
            'type.required' => 'TIPE HARUS DI ISI !',
            'stock.required' => 'STOCK HARUS DI ISI !',
            'price.numeric' => 'HARGA HARUS ANGKA !',
            'price.required' => 'HARGA HARUS DI ISI !',
        ]);

        //  menambah data
        //  nama_field_migration, -> $request->name_input_form

        $proses = Medicine::create([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'stock' => $request->stock,
            'price' => $request->price,
        ]);

        if ($proses) {
            return redirect()->route('medicines')->with('success', 'Data Berhasil Ditambahkan');
        } else {
            return redirect()->route('medicines.add')->with('failed', 'Data Gagal Ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //ambil data yang mau di edit sesuai dengan id (id)
        //  where('id', $id) : mencari data sesuai id
        //  first() : mengambil data pertama
        $medicine = Medicine::where('id', $id)->first();
        //  compact : mengirim data ke blade : compact('namavariable')
        return view('medicine.edit', compact('medicine'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required|min:5|max:20',
            'type' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'price' => 'required|numeric',
        ], [
            'name.required' => 'NAMA HARUS DI ISI !',
            'name.min' => 'NAMA TERLALU PENDEK !',
            'name.max' => 'NAMA TERLALU PANJANG !',
            'description.required' => 'DESKRIPSI HARUS DI ISI !',
            'type.required' => 'TIPE HARUS DI ISI !',
            'stock.required' => 'STOCK HARUS DI ISI !',
            'price.numeric' => 'HARGA HARUS ANGKA !',
            'price.required' => 'HARGA HARUS DI ISI !',
        ]);

        //ambli data sebelumnya, cek isi input stock jangan lebi kecil dari stock sebelumnya
        $medicineBefore = Medicine::where('id', $id)->first();
        if ((int) $request->stock < (int) $medicineBefore->stock) {
            return redirect()->back()->with('failed', 'STOCK TIDAK BOLEH KECIL DARI STOCK SEBELUMNYA !');
        }

        //  mengubah data
        $proses = $medicineBefore->update([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'stock' => $request->stock,
            'price' => $request->price,
        ]);
        if ($proses) {
            return redirect()->route('medicines')->with('success', 'Data Berhasil Diubah');
        } else {
            return redirect()->route('medicines.add')->with('failed', 'Data Gagal Diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //  menghapus data, mencari dengan where, lalu hapus dengan delete()
        $proses = Medicine::find($id)->delete();
        if ($proses) {
            return redirect()->back()->with('success', 'Data Berhasil Dihapus');
        } else {
            return redirect()->back()->with('failed', 'Data Gagal Dihapus');
        }
    }
}
