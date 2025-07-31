<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


// Route::get('/', function () {
//     return view('auth.login');
// })->name('home');

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.auth');

Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');

// Route Customer
Route::get('/master/customer',[CustomerController::class, 'index'])->name('master.customer');
Route::post('/master/customer/store',[CustomerController::class, 'store'])->name('master.customer.store');

// Route Service
Route::get('/master/service',[ServiceController::class, 'index'])->name('master.service');

// Route Transaction
Route::get('/transaction',[OrderController::class, 'index'])->name('order');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
