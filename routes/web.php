<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UsersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
*/

//INI ADALAH HTTP METHOD//
//Route::httpmethod('/url', [namaController::namaFunction])->name('nama_route);
//get -> mengambil data
//post -> menambah data
//patch/put -> MENGUBAH DATA
// delete -> menghapus data
// /url ->
//path dinamis : nilainya akan berubah ubah (harus diissi ketika ingin mengakses route -> ketika akses di blade nya menjadi href="{{route('name_route,$isi path dinamis)}}")}} atau action="{{route('nama_route, $isiPathDinamis)}}"

// Route::get('/', function(){
// return view('welcome');
// })->name('welcome');

Route::get('/home', [HomeController::class, 'index'])->name('home');

//  Route yang dilindungi oleh middleware auth (hanya bisa diakses jika login)
Route::middleware('isGuest')->group(function () {
    Route::get('/', [UsersController::class, 'showLogin'])->name('login');
    Route::get('/register', [UsersController::class, 'create'])->name('register.show');
    Route::post('/register', [UsersController::class, 'store'])->name('register.process');
    Route::post('/login', [UsersController::class, 'processLogin'])->name('login.process');
});

Route::middleware('isLogin')->group(function () {

    Route::middleware('isAdmin')->group(function () {
        //mengolola data medicines
        Route::get('/users', [UsersController::class, 'index'])->name('users');
        Route::get('/users/edit/{id}', [UsersController::class, 'edit'])->name('users.edit');
        Route::post('/users/add', [UsersController::class, 'createAccount'])->name('create.account');
        Route::delete('/users/delete{id}', [UsersController::class, 'destroy'])->name('users.delete');
        Route::patch('/users/edit{id}', [UsersController::class, 'update'])->name('users.edit.update');
        Route::get('/users/add', [UsersController::class, 'showCreateAccount'])->name('show.account.create');

        Route::get('/orders/admin', [OrderController::class, 'indexAdmin'])->name('orders.admin');
        Route::get('/orders/export/excel', [OrderController::class, 'exportExcel'])->name('orders.export.excel');   
    });

    Route::middleware('isApoteker')->group(function () {
        Route::get('/medicines/add', [MedicineController::class, 'create'])->name('medicines.add');
        Route::get('/medicines/edit/{id}', [MedicineController::class, 'edit'])->name('medicines.edit');
        Route::post('/medicines/add', [MedicineController::class, 'store'])->name('medicines.add.store');
        Route::delete('/medicines/delete{id}', [MedicineController::class, 'destroy'])->name('medicines.delete');
        Route::patch('/medicines/edit{id}', [MedicineController::class, 'update'])->name('medicines.edit.update');
        Route::put('/medicines/update-stock/{id}', [MedicineController::class, 'stockEdit'])->name('medicines.stock.edit');

        Route::get('/orders', [OrderController::class, 'index'])->name('orders');
        Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
        Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');
        Route::get('/orders/struk/{id}', [OrderController::class, 'show'])->name('orders.show');
        Route::get('/download/{id}', [OrderController::class, 'downloadPDF'])->name('orders.downloadPDF');
    });

    Route::get('/medicines', [MedicineController::class, 'index'])->name('medicines');

    Route::get('/profile', [UsersController::class, 'indexProfile'])->name('profile');
});

Route::post('/logout', [UsersController::class, 'logout'])->name('logout');
