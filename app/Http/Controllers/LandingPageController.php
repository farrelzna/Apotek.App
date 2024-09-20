<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    //menampilknan banyak data lebih dari satu
    public function index()
    {
        //  view = memanggil file blade di resources/views
        //  tanda . digunakan untuk sub-folder
        //  menggunakan kebac case
        
        return view('landing-page');
    }

    public function create()
    {
        //  menampilkan form tambah data
    }

    public function store(Request $request)
    {
        //  menyimpan data baru
    }

    public function show(string $id)
    {
        //  menampilkan hanya satu data
    }

    public function edit(string $id)
    {
        //  menampilkan form edit
    }

    public function update(Request $request, string $id)
    {
        //  mengubah data ke database
    }

    public function destroy(string $id)
    {
        //  menghapus data dari database
    }
}
