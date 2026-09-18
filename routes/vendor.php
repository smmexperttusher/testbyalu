<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:vendor'])->prefix('vendor')->name('vendor.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Vendor\DashboardController::class, 'index'])->name('dashboard');

    // Vendor Products & Inventory
    Route::resource('products', App\Http\Controllers\Vendor\ProductController::class);
    Route::post('/inventory/{product}/adjust', [App\Http\Controllers\Vendor\InventoryController::class, 'adjust'])->name('inventory.adjust');

    // Vendor Order Items & Fulfillment
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [App\Http\Controllers\Vendor\OrderController::class, 'index'])->name('index');
        Route::get('/{order}', [App\Http\Controllers\Vendor\OrderController::class, 'show'])->name('show');
        Route::put('/item/{item}/status', [App\Http\Controllers\Vendor\OrderController::class, 'updateItemStatus'])->name('updateItemStatus');
    });

    // Vendor Financials & Withdrawals
    Route::prefix('earnings')->name('earnings.')->group(function () {
        Route::get('/', [App\Http\Controllers\Vendor\EarningController::class, 'index'])->name('index');
    });

    Route::prefix('withdrawals')->name('withdrawals.')->group(function () {
        Route::get('/', [App\Http\Controllers\Vendor\WithdrawalController::class, 'index'])->name('index');
        Route::post('/request', [App\Http\Controllers\Vendor\WithdrawalController::class, 'requestWithdrawal'])->name('request');
    });

    // Store Settings
    Route::get('/store/settings', [App\Http\Controllers\Vendor\StoreSettingController::class, 'edit'])->name('store.edit');
    Route::put('/store/settings', [App\Http\Controllers\Vendor\StoreSettingController::class, 'update'])->name('store.update');
});
