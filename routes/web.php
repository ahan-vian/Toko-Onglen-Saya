<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/product/create', [ProductController::class,'create_product'])->name('create_product');
    Route::post('/product/create', [ProductController::class,'store_product'])->name('store_product');
    Route::get('/product', [ProductController::class,'show_product'])->name('show_product');
    Route::get('/product/{product}', [ProductController::class,'detail_product'])->name('detail_product');
    Route::get('/product/edit/{product}', [ProductController::class,'edit_product'])->name('edit_product');
    Route::put('/product/update/{product}', [ProductController::class,'update_product'])->name('update_product');
    Route::delete('/product/{product}',[ProductController::class,'destroy_product'])->name('destroy_product');
    Route::post('/cart/add/{product}', [CartController::class,'add_to_cart'])->name('add_to_cart');
    Route::get('/cart/show', [CartController::class,'show_cart'])->name('show_cart');
    Route::get('/cart/edit/{cart}', [CartController::class,'edit_cart'])->name('edit_cart');
    Route::patch('/cart/update/{cart}', [CartController::class,'update_cart'])->name('update_cart');
    Route::delete('/cart/{cart}', [CartController::class,'destroy_cart'])->name('destroy_cart');
});

require __DIR__.'/auth.php';
