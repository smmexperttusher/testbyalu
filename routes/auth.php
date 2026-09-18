<?php

use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\CustomerAuthController;
use App\Http\Controllers\Auth\VendorAuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dedicated Authentication Routes
| Separated by Persona: Customer, Vendor, Admin
|--------------------------------------------------------------------------
*/

// Generic fallback login redirect
Route::get('/login', function () {
    return redirect()->route('customer.login');
})->name('login');

// 1. Customer Authentication (Shopping, Cart, Checkout)
Route::prefix('customer')->name('customer.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [CustomerAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [CustomerAuthController::class, 'login'])->name('login.submit');
        Route::get('/register', [CustomerAuthController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [CustomerAuthController::class, 'register'])->name('register.submit');
    });
});

// 2. Vendor Authentication (Merchant Portal)
Route::prefix('vendor')->name('vendor.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [VendorAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [VendorAuthController::class, 'login'])->name('login.submit');
        Route::get('/register', [VendorAuthController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [VendorAuthController::class, 'register'])->name('register.submit');
    });
});

// 3. Admin Authentication (Restricted Dedicated Route - Not exposed in public header)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    });
});

// Authenticated Logout
Route::post('/logout', [CustomerAuthController::class, 'logout'])->middleware('auth')->name('logout');
