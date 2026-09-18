<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin|super_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Payment Verification Center (bKash, Nagad, COD manual verification)
    Route::prefix('payments')->name('payments.')->group(function () {
        Route::get('/pending', [App\Http\Controllers\Admin\PaymentVerificationController::class, 'pending'])->name('pending');
        Route::get('/{payment}/verify', [App\Http\Controllers\Admin\PaymentVerificationController::class, 'show'])->name('show');
        Route::post('/{payment}/verify', [App\Http\Controllers\Admin\PaymentVerificationController::class, 'verify'])->name('verify');
        Route::post('/{payment}/reject', [App\Http\Controllers\Admin\PaymentVerificationController::class, 'reject'])->name('reject');
        Route::get('/proof/{id}/secure-view', [App\Http\Controllers\Admin\PaymentVerificationController::class, 'viewScreenshot'])->name('screenshot');
    });

    // Orders Management
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('index');
        Route::get('/{order}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('show');
        Route::put('/{order}/status', [App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('updateStatus');
    });

    // Vendor Management
    Route::prefix('vendors')->name('vendors.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\VendorController::class, 'index'])->name('index');
        Route::get('/{vendor}', [App\Http\Controllers\Admin\VendorController::class, 'show'])->name('show');
        Route::post('/{vendor}/approve', [App\Http\Controllers\Admin\VendorController::class, 'approve'])->name('approve');
        Route::post('/{vendor}/reject', [App\Http\Controllers\Admin\VendorController::class, 'reject'])->name('reject');
        Route::post('/{vendor}/toggle-status', [App\Http\Controllers\Admin\VendorController::class, 'toggleStatus'])->name('toggleStatus');
        Route::put('/{vendor}/commission', [App\Http\Controllers\Admin\VendorController::class, 'updateCommission'])->name('updateCommission');
    });

    // Withdrawals & Financial Settlement
    Route::prefix('withdrawals')->name('withdrawals.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\WithdrawalController::class, 'index'])->name('index');
        Route::post('/{withdrawal}/approve', [App\Http\Controllers\Admin\WithdrawalController::class, 'approve'])->name('approve');
        Route::post('/{withdrawal}/reject', [App\Http\Controllers\Admin\WithdrawalController::class, 'reject'])->name('reject');
    });

    // Settings (Payments, Bangladesh shipping, platform configuration)
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/payments', [App\Http\Controllers\Admin\SettingController::class, 'payments'])->name('payments');
        Route::post('/payments', [App\Http\Controllers\Admin\SettingController::class, 'updatePayments'])->name('payments.update');
        Route::get('/shipping', [App\Http\Controllers\Admin\SettingController::class, 'shipping'])->name('shipping');
        Route::post('/shipping', [App\Http\Controllers\Admin\SettingController::class, 'updateShipping'])->name('shipping.update');
    });
});
