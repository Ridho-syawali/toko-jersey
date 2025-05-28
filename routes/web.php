<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
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
    return view('home');
});

// Cart dummy
Route::get('/cart', function () {
    return view('cart.cart');
})->name('cart');

// Produk: read all & by id (JSON response)
Route::get('/products', [ProdukController::class, 'index']);
Route::get('/products/{id}', [ProdukController::class, 'show'])->name('products.show');

// Order: CRUD (JSON response)
Route::get('/order', [OrderController::class, 'index']);
Route::get('/order/{id}', [OrderController::class, 'show']);
Route::post('/order', [OrderController::class, 'store']);
Route::put('/order/{id}', [OrderController::class, 'update']);
Route::delete('/order/{id}', [OrderController::class, 'destroy']);

// Cart routes (hanya untuk user login)
Route::middleware('auth')->group(function () {
    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'show'])->name('cart');
    Route::get('/cart/update-page/{itemId}', [\App\Http\Controllers\CartController::class, 'updatePage'])->name('cart.updatePage');
    Route::post('/cart/add', [\App\Http\Controllers\CartController::class, 'add']);
    Route::post('/cart/update/{itemId}', [\App\Http\Controllers\CartController::class, 'update']);
    Route::post('/cart/remove/{itemId}', [\App\Http\Controllers\CartController::class, 'remove']);
    Route::post('/cart/apply-coupon', [\App\Http\Controllers\CartController::class, 'applyCoupon']);
    Route::post('/cart/checkout', [\App\Http\Controllers\CartController::class, 'checkout']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
