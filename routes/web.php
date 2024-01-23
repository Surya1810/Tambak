<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\AncoController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BibitController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\HargaController;
use App\Http\Controllers\HutangController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KematianController;
use App\Http\Controllers\KolamController;
use App\Http\Controllers\PakanController;
use App\Http\Controllers\PanenController;
use App\Http\Controllers\PiutangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SamplingController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TambakController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});

Route::group(['prefix' => 'owner', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});

// Admin
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    // Owner
    Route::get('/owner', [UserController::class, 'owner'])->name('owner.index');
    Route::get('/owner/create', [UserController::class, 'owner_create'])->name('owner.create');
    Route::get('/owner/edit/{id}', [UserController::class, 'owner_edit'])->name('owner.edit');
    Route::post('/owner/store', [UserController::class, 'owner_store'])->name('owner.store');
    Route::post('/owner/update/{id}', [UserController::class, 'owner_update'])->name('owner.update');
    Route::delete('/owner/delete/{id}', [UserController::class, 'owner_destroy'])->name('owner.destroy');
    // Tambak
    Route::resource('tambak', TambakController::class)->except([
        'index'
    ]);
    Route::get('/tambak', [TambakController::class, 'admin'])->name('tambak.admin');

    // Satuan
    Route::resource('satuan', SatuanController::class);
    // Kategori
    Route::resource('kategori', KategoriController::class);
});

// Owner
Route::group(['prefix' => 'owner', 'middleware' => 'auth'], function () {

    // Tambak
    Route::get('/tambak', [TambakController::class, 'owner'])->name('tambak.owner');

    // User | Employee
    Route::resource('operator', UserController::class);

    // Supplier
    Route::resource('supplier', SupplierController::class);
    // Customer
    Route::resource('customer', CustomerController::class);

    // Kolam    
    Route::resource('kolam', KolamController::class);
});

// Operator
Route::group(['prefix' => 'operator', 'middleware' => 'auth'], function () {
    // Data Pakan
    Route::resource('pakan', PakanController::class);

    // Data Sampling
    Route::resource('sampling', SamplingController::class);
    // Data Bibit
    Route::resource('bibit', BibitController::class);
    // Data Anco
    Route::resource('anco', AncoController::class);
    Route::get('/anco/create/{kolam}/{tanggal}', [AncoController::class, 'pakan'])->name('get.pakan');

    // Data Panen
    Route::resource('panen', PanenController::class);
    // Data Kematian
    Route::resource('kematian', KematianController::class);


    // Gudang
    Route::resource('gudang', GudangController::class);
    // Barang
    Route::resource('barang', BarangController::class);
    // Transaksi Barang
    Route::resource('transaksi', TransaksiController::class);
});

// Akuntan
Route::group(['prefix' => 'akuntan', 'middleware' => 'auth'], function () {
    // Akun
    Route::resource('akun', AkunController::class);

    // Data Harga
    Route::resource('harga', HargaController::class);

    // Jurnal Umum & Buku Besar
    Route::resource('jurnal', JurnalController::class);
    // Pembayaran Hutang
    Route::resource('hutang', HutangController::class);
    Route::post('/hutang/bayar/{id}', [HutangController::class, 'bayar'])->name('hutang.bayar');
    // Pemberian Piutang
    Route::resource('piutang', PiutangController::class);
    Route::post('/piutang/bayar/{id}', [PiutangController::class, 'bayar'])->name('piutang.bayar');

    // // Pembelian
    // Route::resource('jurnal', JurnalController::class);
    // // Purchase Order
    // Route::resource('jurnal', JurnalController::class);
});

Route::middleware('auth')->group(function () {
    // Profile Section
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password/{id}', [ProfileController::class, 'password'])->name('profile.password');
    Route::delete('/profile/delete/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
