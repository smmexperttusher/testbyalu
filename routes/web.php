<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Bangladesh Multivendor E-Commerce
|--------------------------------------------------------------------------
*/

// Public Storefront
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/shop', [App\Http\Controllers\ShopController::class, 'index'])->name('shop.index');
Route::get('/category/{slug}', [App\Http\Controllers\ShopController::class, 'category'])->name('shop.category');
Route::get('/product/{slug}', [App\Http\Controllers\ShopController::class, 'product'])->name('shop.product');
Route::get('/vendor/{slug}', [App\Http\Controllers\ShopController::class, 'vendorStore'])->name('shop.vendor');

// Dynamic Geographic Cascading (Bangladesh Division -> District -> Upazila/Thana)
Route::get('/geo/districts/{divisionId}', [App\Http\Controllers\GeoController::class, 'getDistricts'])->name('geo.districts');
Route::get('/geo/upazilas/{districtId}', [App\Http\Controllers\GeoController::class, 'getUpazilas'])->name('geo.upazilas');

// Database-Driven Cart (Strictly requires Customer Authentication)
Route::middleware([\App\Http\Middleware\EnsureCustomerAuthenticated::class])->prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [App\Http\Controllers\CartController::class, 'index'])->name('index');
    Route::post('/add', [App\Http\Controllers\CartController::class, 'add'])->name('add');
    Route::put('/update/{itemId}', [App\Http\Controllers\CartController::class, 'updateQuantity'])->name('update');
    Route::delete('/remove/{itemId}', [App\Http\Controllers\CartController::class, 'remove'])->name('remove');
    Route::post('/clear', [App\Http\Controllers\CartController::class, 'clear'])->name('clear');
});

// Checkout & Mandatory Payment Pipelines (Strictly requires Customer Authentication)
Route::middleware([\App\Http\Middleware\EnsureCustomerAuthenticated::class])->prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/', [App\Http\Controllers\CheckoutController::class, 'index'])->name('index');
    Route::post('/apply-coupon', [App\Http\Controllers\CheckoutController::class, 'applyCoupon'])->name('applyCoupon');
    Route::post('/remove-coupon', [App\Http\Controllers\CheckoutController::class, 'removeCoupon'])->name('removeCoupon');
    
    // 1. Cash on Delivery (Creates order with status = pending, payment = pending)
    Route::post('/process-cod', [App\Http\Controllers\CheckoutController::class, 'processCod'])->name('processCod');

    // 2. bKash Manual Payment (Mandatory Modal submission with phone, txId, screenshot)
    Route::post('/process-bkash', [App\Http\Controllers\CheckoutController::class, 'processBkashProof'])->name('processBkash');

    // 3. Nagad Manual Payment (Mandatory Modal submission with phone, txId, screenshot)
    Route::post('/process-nagad', [App\Http\Controllers\CheckoutController::class, 'processNagadProof'])->name('processNagad');

    // Order Success & Confirmation
    Route::get('/confirmation/{orderNumber}', [App\Http\Controllers\CheckoutController::class, 'confirmation'])->name('confirmation');
});

// Require specialized sub-routes
require __DIR__ . '/admin.php';
require __DIR__ . '/vendor.php';
require __DIR__ . '/customer.php';
require __DIR__ . '/auth.php';
