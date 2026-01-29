<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HistoryOrderController;

/*
|---------------------------------
| LOGIN
|---------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|---------------------------------
| SEMUA WAJIB LOGIN
|---------------------------------
*/
Route::middleware('auth')->group(function () {

    // OVERVIEW
    Route::get('/', [OverviewController::class, 'index'])->name('overview');

    // CART
    Route::get('/cart/add/{id}', [OverviewController::class, 'addToCart'])
        ->name('cart.add');

    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])
        ->name('cart.remove');

    // PRODUCT
    Route::resource('product', ProductController::class);

    // CATEGORY
    Route::resource('category', CategoryController::class);

    // PAYMENT
    Route::get('/payment/{order}', [PaymentController::class, 'index'])
        ->name('payment.index');

    Route::post('/payment/{order}/pay', [PaymentController::class, 'pay'])
        ->name('payment.pay');

    Route::get('/payment/{order}/receipt', [PaymentController::class, 'receipt'])
        ->name('payment.receipt');

    // HISTORY
    Route::get('/history-order', [HistoryOrderController::class, 'index'])
        ->name('history.index');
});
