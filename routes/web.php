<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\QrisController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PesananController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', [BarangController::class, 'welcome'])->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/welcome', function () {
    return view('user.welcome');
})->name('user');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::view('/welcome', 'welcome')->name('welcome');
Route::view('/about', 'template-page.about')->name('about');
Route::view('/contact', 'template-page.contact')->name('contact');
Route::view('/cart', 'template-page.cart')->name('cart');
Route::view('/checkout', 'template-page.checkout')->name('checkout');
Route::view('/product-grids', 'template-page.product-grids')->name('product-grids');
Route::view('/product-details', 'template-page.product-details')->name('product-details');
Route::view('/login', 'auth.login')->name('login');
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::view('/logout', 'auth.logout')->name('logout');

//Route user
Route::view('/tabel', 'tabel')->name('tabel');
Route::get('tabel', function () {
    $users = User::all();
    return view('tabel', compact('users'));
})->name('tabel');
Route::get('/users/{id}', function ($id) {
    $user = \App\Models\User::findOrFail($id);
    return view('show', compact('user'));
})->name('users.show');
Route::delete('/users/{id}/hapus', [UsersController::class, 'destroy'])->name('users.hapus');

// route jenis
Route::get('jenis', [JenisController::class, 'index'])->name('jenis');
Route::get('jenis/view/{id}', [JenisController::class, 'show'])->name('jenis.view');
Route::get('jenis/create', [JenisController::class, 'create'])->name('jenis.create');
Route::post('jenis/store', [JenisController::class, 'store'])->name('jenis.store');
Route::delete('jenis/delete/{id}', [JenisController::class, 'destroy'])->name('jenis.delete');

// Route Barang
Route::get('barang', [BarangController::class, 'index'])->name('barang');
Route::get('barang/view/{id}', [BarangController::class, 'show'])->name('barang.view');
Route::get('barang/create', [BarangController::class, 'create'])->name('barang.create');
Route::post('barang/store', [BarangController::class, 'store'])->name('barang.store');
Route::delete('barang/delete/{id}', [BarangController::class, 'destroy'])->name('barang.delete');

//Auth Google
Route::get('/redirect', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/callback', [GoogleController::class, 'callback'])->name('google.callback');
Route::get('/logout', [GoogleController::class, 'logout'])->name('google.logout');

//register Auth Google
Route::get('/lengkapi-data', [GoogleController::class, 'showCompleteForm'])->name('profile.complete');
Route::post('/lengkapi-data', [GoogleController::class, 'submitCompleteForm'])->name('profile.complete.submit');
Route::get('/welcome', function () {
    return view('welcome');
})->name('auth.welcome');

//profil
Route::get('/profile', [GoogleController::class, 'profile'])->name('auth.profile');
Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile'); // ⬅️ ini route 'profile'
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

//untuk barang ke user
Route::get('/welcome', [BarangController::class, 'welcome'])->name('welcome');
Route::get('/', [BarangController::class, 'welcome'])->name('welcome');
Route::get('/user', [BarangController::class, 'welcome'])->name('user');

//detail
Route::get('/detail/{id}', [BarangController::class, 'show'])->name('detail');
Route::get('/produk/{id}', [BarangController::class, 'show'])->name('product.show');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add'); // ini WAJIB ada
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::post('/cart/proses', [CartController::class, 'prosesCheckout'])->name('cart.prosesCheckout');



//checkout
Route::middleware(['auth'])->group(function () {
    // Cart
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::get('/cart/checkout', [CartController::class, 'showCheckout'])->name('cart.checkout');
    // Checkout
    Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout'); // kirim barang terpilih ke halaman checkout
    Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store'); // simpan alamat/order
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process'); // proses pembayaran
    Route::match(['get', 'post'], '/cart/checkout', [CheckoutController::class, 'checkout'])
        ->name('cart.checkout');
});

Route::middleware('auth')->group(function () {
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/checkout', [CartController::class, 'prosesCheckout'])->name('cart.checkout');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
});


// Pembayaran / Chekout
//checkou
Route::get('/checkout', [CheckoutController::class, 'index'])->name('cart.checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('cart.checkout');
Route::get('/alamat/edit/{id}', [CheckoutController::class, 'editAlamat'])->name('alamat.edit');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/checkout', [CartController::class, 'prosesCheckout'])->name('cart.prosesCheckout');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

//ini kontak
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak.form');

Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');

//Qris pages
require __DIR__ . '/auth.php';


Route::get('/order/success', [OrderController::class, 'success'])->name('order.success');
Route::get('/order/pending', [OrderController::class, 'pending'])->name('order.pending');

Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');
Route::get('/pesanan/{id}', [PesananController::class, 'show'])->name('pesanan.show');
Route::delete('/pesanan/{id}', [PesananController::class, 'destroy'])->name('pesanan.destroy');
Route::post('/payment/callback', [PesananController::class, 'callback'])->name('payment.callback');
Route::put('/pesanan/{id}/status', [PesananController::class, 'updateStatus'])->name('pesanan.updateStatus');
