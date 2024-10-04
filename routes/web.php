<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\UsersController;
use Symfony\Component\HttpKernel\Profiler\Profile;

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

// Route::get('/', function(){
// return view('welcome');
// })->name('welcome');

Route::get('/home', [HomeController::class,'index'])->name('home');


//mengolola data medicines

Route::get('/medicines', [MedicineController::class, 'index'])->name('medicines');
Route::get('/medicines/add', [MedicineController::class, 'create'])->name('medicines.add');
Route::post('/medicines/add', [MedicineController::class, 'store'])->name('medicines.add.store');

//path dinamis : nilainya akan berubah ubah (harus diissi ketika ingin mengakses route -> ketika akses di blade nya menjadi href="{{route('name_route,$isi path dinamis)}}")}} atau action="{{route('nama_route, $isiPathDinamis)}}"

Route::delete('/medicines/delete{id}', [MedicineController::class,'destroy'])->name('medicines.delete');

Route::get('/medicines/edit/{id}', [MedicineController::class,'edit'])->name('medicines.edit');

Route::patch('/medicines/edit{id}', [MedicineController::class, 'update'])->name('medicines.edit.update');

// Route::get('/stock/edit/{id}', [MedicineController::class],'stockEdit')->name('medicines.stock.edit');

Route::put('/medicines/update-stock/{id}',[MedicineController::class, 'stockEdit'])->name('medicines.stock.edit');




//  mengolola data users
Route::get('/', [UsersController::class, 'showLogin'])->name('login');
Route::get('/register', [UsersController::class, 'create'])->name('register.show');
Route::post('/register', [UsersController::class, 'store'])->name('register.process');
Route::post('/login', [UsersController::class, 'processLogin'])->name('login.process');
Route::post('/logout', [UsersController::class, 'logout'])->name('logout');

//  Route yang dilindungi oleh middleware auth (hanya bisa diakses jika login)
Route::middleware('auth')->group(function () {
    Route::get('/medicines', [MedicineController::class, 'index'])->name('medicines');
    Route::get('/users', [UsersController::class, 'index'])->name('users');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});

//  mengolola data users 
Route::get('/users', [UsersController::class, 'index'])->name('users');
Route::get('/users/add', [UsersController::class, 'showCreateAccount'])->name('show.account.create');

Route::post('/users/add', [UsersController::class, 'createAccount'])->name('create.account');
Route::delete('/users/delete{id}', [UsersController::class,'destroy'])->name('users.delete');
Route::get('/users/edit/{id}', [UsersController::class,'edit'])->name('users.edit');
Route::patch('/users/edit{id}', [UsersController::class, 'update'])->name('users.edit.update');
//  menampilkan profile users
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');