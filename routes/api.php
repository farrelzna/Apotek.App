<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*
Route::httpmethod('/url', [namaContorller::namaFunction])->name('nama_route);
httpMethod : 
get -> mengambil data
post -> menambah data
patch/put -> menampilkan data
delete -> menghapus data
/url dan name() harus beda/unique 
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

