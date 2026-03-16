<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. ZONA PUBLIK (Bisa diakses tanpa login)
// ==========================================
Route::get('/', function () {
    return view('welcome');
});

// Pengunjung biasa bisa melihat daftar dan detail produk
Route::get('/product', [ProductController::class, 'show_product'])->name('show_product');
// (Catatan: Rute ini diletakkan di bawah rute admin agar tidak terjadi konflik URL)


// ==========================================
// 2. ZONA ADMIN (Wajib Login & Wajib Admin)
// ==========================================
Route::middleware(['auth', 'admin'])->group(function () {
    
    // CRUD Produk (Hanya Admin yang bisa kelola produk)
    Route::get('/product/create', [ProductController::class, 'create_product'])->name('create_product');
    Route::post('/product/create', [ProductController::class, 'store_product'])->name('store_product');
    Route::get('/product/edit/{product}', [ProductController::class, 'edit_product'])->name('edit_product');
    Route::put('/product/update/{product}', [ProductController::class, 'update_product'])->name('update_product');
    Route::delete('/product/{product}', [ProductController::class, 'destroy_product'])->name('destroy_product');

    // Manajemen Pesanan Admin
    Route::get('/admin/orders', [OrderController::class, 'index_admin'])->name('index_admin_order');
    Route::post('/order/{order}/confirm', [OrderController::class, 'confirm_payment'])->name('confirm_payment');
    Route::get('/admin/orders/confirmed', [OrderController::class, 'confirmed_orders'])->name('confirmed_orders');
    Route::post('/order/{order}/receipt', [OrderController::class, 'submit_receipt'])->name('submit_receipt');
});


// ==========================================
// 3. ZONA PELANGGAN & UMUM (Wajib Login)
// ==========================================
Route::middleware('auth')->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    // Profil (Admin dan User sama-sama punya profil)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Fitur Belanja Pelanggan
    Route::post('/cart/add/{product}', [CartController::class, 'add_to_cart'])->name('add_to_cart');
    Route::get('/cart/show', [CartController::class, 'show_cart'])->name('show_cart');
    Route::get('/cart/edit/{cart}', [CartController::class, 'edit_cart'])->name('edit_cart');
    Route::patch('/cart/update/{cart}', [CartController::class, 'update_cart'])->name('update_cart');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy_cart'])->name('destroy_cart');

    // Fitur Checkout & Pesanan Pelanggan
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/orders', [OrderController::class, 'index_order'])->name('index_order');
    Route::get('/order/{order}', [OrderController::class, 'show_order'])->name('show_order');
    Route::post('/order/{order}/pay', [OrderController::class, 'submit_payment'])->name('submit_payment');
    Route::post('/order/{order}/complete', [OrderController::class, 'complete_order'])->name('complete_order');
});

// Rute Detail Produk (Diletakkan di bawah agar rute /product/create milik admin tidak terbaca sebagai {product})
Route::get('/product/{product}', [ProductController::class, 'detail_product'])->name('detail_product');

require __DIR__ . '/auth.php';