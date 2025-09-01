<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PickupController;
use App\Http\Controllers\ReceivableController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


// Route::get('/', function () {
//     return view('auth.login');
// })->name('home');

Route::get('/', [AuthController::class, 'login'])->name('beranda');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.auth');

Route::middleware(['authenticate'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Route Master
    Route::prefix('master')->group(function () {

        // Route Master Customer
        Route::prefix('customer')->group(function () {
            Route::get('/', [CustomerController::class, 'index'])->name('master.customer');
            Route::post('/store', [CustomerController::class, 'store'])->name('master.customer.store');
        });

        // Route Master Service
        Route::middleware('role:owner,admin')->group(function() {

            Route::get('/service', [ServiceController::class, 'index'])->name('master.service');
            Route::get('/work', [WorkController::class, 'index'])->name('master.work');
            Route::get('/employee', [EmployeeController::class, 'index'])->name('master.employee');
        });
    });

    // Route Transaction
    Route::get('/transaction', [OrderController::class, 'index'])->name('order');
    Route::get('/transaction/print/{id}', [OrderController::class, 'print'])->name('order.print');

    // Route Pickup
    Route::get('pickup', [PickupController::class, 'index'])->name('pickup');
    Route::get('/pickup/print/{id}', [PickupController::class, 'print'])->name('pickup.print');

    // Route Receivable
    Route::get('receivable', [ReceivableController::class, 'index'])->name('receivable');

    // Route User

    // Route Logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout.auth');

});
Route::middleware(['authenticate','role:admin'])->group(function() {

    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/toko', [TokoController::class, 'index'])->name('toko');
});





// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Route::middleware(['auth'])->group(function () {
//     Route::redirect('settings', 'settings/profile');

//     Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
//     Volt::route('settings/password', 'settings.password')->name('settings.password');
//     Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
// });

require __DIR__ . '/auth.php';
