<?php

//pemanggil controller
use App\Models\Medicine;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MedicineController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//  Route::httpmethod('/url',[namacontroller::namafunction])->nam('nama_route);
//  httpmethod :
//  get -> mengambil data 
//  post -> menambah data 
//  patch/put -> mengubah data 
//  delete -> menghapus data 
//  /url dan name() harus befa/unique

Route::get('/home', function () {
    return view('welcome');
})->name('welcome');

//      url : kebab case, name: snack case , controller function : camel case 
Route::get('/landing-page', [LandingPageController::class, 'index'])->name('landing_page');

//      meneapilkan/mengelola data medicines
Route::get('/medicines', [MedicineController::class, 'index'])->name('medicines');
Route::get('/medicines/add', [MedicineController::class, 'create'])->name('medicines.add');
Route::post('/medicines/add', [MedicineController::class, 'store'])->name('medicines.store.add');
//      (id) : path dinamis, nilainya akan berubah ubah (harus diisi ketika , mengakses route) -> ketika akses di blade maka aknan menjadi href="{{ route('nama_rout, $isipathdinamis') }}"
//      fungsi path dinamis : spesifikasi data yang akan dproses
Route::delete('/medicines/{id}', [MedicineController::class, 'destroy'])->name('medicines.delete'); 
Route::get('/medicines/edit/{id}', [MedicineController::class, 'edit'])->name('medicines.edit');
Route::patch('/medicines/edit/{id}', [MedicineController::class, 'update'])->name('medicines.edit.update');