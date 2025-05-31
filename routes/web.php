<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureUserHasRole;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LaporanController as AdminLaporanController;
use App\Http\Controllers\Admin\LayananController as AdminLayananController;
use App\Http\Controllers\Admin\PembayaranController as AdminPembayaranController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\PesananController as AdminPesananController;
use App\Http\Controllers\Admin\TeknisiController as AdminTeknisiController;
use App\Http\Controllers\Admin\UlasanController as AdminUlasanController;

use App\Http\Controllers\Teknisi\DashboardController as TeknisiDashboardController;

use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Route untuk Admin
Route::middleware(['auth', EnsureUserHasRole::class . ':admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        // Contoh route admin lain, sesuaikan dengan kebutuhan
        Route::resource('laporan', AdminLaporanController::class);

        Route::resource('layanan', AdminLayananController::class)-> except(['create', 'store','destroy']);

        Route::resource('pembayaran', AdminPembayaranController::class);

        Route::resource('customer', AdminCustomerController::class)->except(['create', 'store']);

        Route::resource('pesanan', AdminPesananController::class)->except(['create', 'store','destroy']);

        Route::resource('teknisi', AdminTeknisiController::class);

        Route::resource('ulasan', AdminUlasanController::class)->except(['create', 'store','edit','update']);
    });

// Route untuk Teknisi
Route::middleware(['auth', EnsureUserHasRole::class . ':teknisi'])
    ->prefix('teknisi')
    ->name('teknisi.')
    ->group(function () {
        Route::get('/dashboard', [TeknisiDashboardController::class, 'index'])->name('dashboard');
        
        // Tambahkan route teknisi lain jika ada
    });

// Route untuk Customer
Route::middleware(['auth', EnsureUserHasRole::class . ':customer'])
    ->prefix('customer')
    ->name('customer.')
    ->group(function () {
        Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');
        
        // Tambahkan route customer lain jika ada
    });

require __DIR__.'/auth.php';
