<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//  import model
use App\Models\Medicine;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */

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
        // '%' depan = mencari kata belakang
        // '%' belakanag = mencari kata depan
        $medicines = Medicine::where('name', 'like', '%' . $request->search . '%')->simplePaginate(5);

        //compact : mengirim data ke blade : compact('namavariable')
        return view('medicine.index', compact('medicines'));
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
            'type' => 'required',
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        //  menambah data
        //  nama_field_migration, -> $request->name_input_form
        
        $proses = Medicine::create([
            'type' => $request->type,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);
        
        if ($proses) {
            return redirect()->route('medicines')->with('success', 'Data Berhasil Ditambahkan');
        } else {
            return redirect()->route('medicines')->with('failed', 'Data Gagal Ditambahkan');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
