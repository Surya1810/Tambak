<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TambakController;
use App\Http\Controllers\UserController;
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
    Route::post('/owner/store', [UserController::class, 'owner_store'])->name('owner.store');

    // Tambak
    Route::resource('tambak', TambakController::class);


    // Profile Section
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password/{id}', [ProfileController::class, 'password'])->name('profile.password');
    Route::delete('/profile/delete/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
