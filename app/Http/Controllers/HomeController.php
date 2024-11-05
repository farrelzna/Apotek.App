<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    //menampilknan banyak data lebih dari satu
    public function index()
    {
        //  view = memanggil file blade di resources/views
        //  tanda . digunakan untuk sub-folder
        //  menggunakan kebac case
        
        return view('home');
    }

}
