<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Customer\DashboardController::class, 'index'])->name('dashboard');

    // Customer Orders & Tracking
    Route::get('/orders', [App\Http\Controllers\Customer\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [App\Http\Controllers\Customer\OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{order}/track', [App\Http\Controllers\Customer\OrderController::class, 'track'])->name('orders.track');
    Route::post('/orders/{order}/cancel', [App\Http\Controllers\Customer\OrderController::class, 'cancel'])->name('orders.cancel');

    // Bangladesh Saved Addresses
    Route::resource('addresses', App\Http\Controllers\Customer\AddressController::class);

    // Wishlist
    Route::get('/wishlist', [App\Http\Controllers\Customer\WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle/{product}', [App\Http\Controllers\Customer\WishlistController::class, 'toggle'])->name('wishlist.toggle');

    // Verified Reviews
    Route::post('/reviews/{orderItem}', [App\Http\Controllers\Customer\ReviewController::class, 'store'])->name('reviews.store');
});
