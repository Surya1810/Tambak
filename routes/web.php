<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KolamController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TambakController;
use App\Http\Controllers\UserController;
use App\Models\Supplier;
use App\Models\Tambak;
use App\Models\User;
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
    return redirect('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // User | Employee | Owner
    Route::resource('operator', UserController::class);
    Route::get('/owner', [UserController::class, 'owner'])->name('owner.index');
    Route::get('/owner/create', [UserController::class, 'owner_create'])->name('owner.create');
    Route::get('/owner/edit/{id}', [UserController::class, 'owner_edit'])->name('owner.edit');
    Route::post('/owner/store', [UserController::class, 'owner_store'])->name('owner.store');
    Route::post('/owner/update/{id}', [UserController::class, 'owner_update'])->name('owner.update');
    Route::delete('/owner/delete/{id}', [UserController::class, 'owner_destroy'])->name('owner.destroy');

    // Tambak
    Route::resource('tambak', TambakController::class);
    // Satuan
    Route::resource('satuan', SatuanController::class);
    // Gudang
    Route::resource('gudang', GudangController::class);
    // Kategori
    Route::resource('kategori', KategoriController::class);
    // Supplier
    Route::resource('supplier', SupplierController::class);
    // Customer
    Route::resource('customer', CustomerController::class);
    // Akun
    Route::resource('akun', AkunController::class);
    // Barang
    Route::resource('barang', BarangController::class);
    // Kolam    
    Route::resource('kolam', KolamController::class);

    // Profile Section
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password/{id}', [ProfileController::class, 'password'])->name('profile.password');
    Route::delete('/profile/delete/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
