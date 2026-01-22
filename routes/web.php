<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\KelompokController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TujuanController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/tabel_staff', function () {
    return view('tabel_staff');
})->middleware(['auth', 'verified'])->name('tabel_staff');

Route::get('/kelompok', function () {
    return view('kelompok');
})->middleware(['auth', 'verified'])->name('kelompok');

Route::get('/tabel_staff', function () {
    return view('tabel_staff');
})->middleware(['auth', 'verified'])->name('tabel_staff');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('jenis', [JenisController::class, 'index'])->name('jenis');
Route::get('jenis/view/{id}', [JenisController::class, 'show'])->name('jenis.view');
Route::get('jenis/create', [JenisController::class, 'create'])->name('jenis.create');
Route::post('jenis/store', [JenisController::class, 'store'])->name('jenis.store');
Route::delete('jenis/delete/{id}', [JenisController::class, 'destroy'])->name('jenis.delete');

route::get('tujuan', [TujuanController::class, 'tujuan'])->name('tujuan.tujuan');
Route::get('jenis/view/{id}', [JenisController::class, 'show'])->name('tujuan.view');
route::get('tujuan/create', [TujuanController::class, 'create'])->name('tujuan.create');
route::post('tujuan/store', [TujuanController::class, 'store'])->name('tujuan.store');
route::delete('tujuan/delete/{id}', [TujuanController::class, 'destroy'])->name('tujuan.destroy');

Route::get('kelompok', [KelompokController::class, 'index'])->name('kelompok.index');
Route::get('kelompok/create', [KelompokController::class, 'create'])->name('kelompok.create');
Route::get('kelompok/{id}/edit', [KelompokController::class, 'edit'])->name('kelompok.edit');
Route::post('kelompok/store', [KelompokController::class, 'store'])->name('kelompok.store');
Route::delete('kelompok/{id}', [KelompokController::class, 'destroy'])->name('kelompok.destroy');

Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
Route::post('/staff', [StaffController::class, 'store'])->name('staff.store');
Route::get('/staff/{id}/edit', [StaffController::class, 'edit'])->name('staff.edit');
Route::put('/staff/{id}', [StaffController::class, 'update'])->name('staff.update');
Route::delete('/staff/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});





require __DIR__ . '/auth.php';
