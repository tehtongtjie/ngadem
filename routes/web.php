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
use App\Http\Controllers\Teknisi\ServiceController as TeknisiServiceController;
use App\Http\Controllers\Teknisi\OrderController as TeknisiOrderController;
use App\Http\Controllers\Teknisi\PendapatanController as TeknisiPendapatanController;

use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;
use App\Http\Controllers\Customer\ServiceController as CustomerServiceController;
use App\Http\Controllers\Customer\PaymentController as CustomerPaymentController;
use App\Http\Controllers\Customer\ProfileController as CustomerProfileController;
use App\Http\Controllers\Customer\ReviewController as CustomerReviewController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// ---
// Rute untuk Admin
Route::middleware(['auth', EnsureUserHasRole::class . ':admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('laporan', AdminLaporanController::class);
        Route::resource('layanan', AdminLayananController::class);
        Route::resource('pembayaran', AdminPembayaranController::class);
        Route::resource('customer', AdminCustomerController::class)->except(['create', 'store']);
        Route::resource('pesanan', AdminPesananController::class)->except(['create', 'store', 'destroy']);
        Route::resource('teknisi', AdminTeknisiController::class);
        Route::resource('ulasan', AdminUlasanController::class)->except(['create', 'store', 'edit', 'update']);
    });

// ---
// Rute untuk Teknisi
Route::middleware(['auth', EnsureUserHasRole::class . ':teknisi'])
    ->prefix('teknisi')
    ->name('teknisi.')
    ->group(function () {
        Route::get('/dashboard', [TeknisiDashboardController::class, 'index'])->name('dashboard');


        Route::get('/orders/{order}/upload-report', [TeknisiOrderController::class, 'uploadReport'])->name('orders.upload_report');
        Route::post('/orders/{order}/upload-report', [TeknisiOrderController::class, 'storeReport'])->name('orders.store_report');

        Route::get('/orders/completed', [TeknisiOrderController::class, 'completed'])->name('orders.completed');
        Route::get('/orders/assigned', [TeknisiOrderController::class, 'assigned'])->name('orders.assigned');
        Route::get('/orders/pending', [TeknisiOrderController::class, 'pending'])->name('orders.pending');
        Route::get('/orders/declined', [TeknisiOrderController::class, 'declined'])->name('orders.declined');
        Route::get('/orders/history', [TeknisiOrderController::class, 'history'])->name('orders.history');

        Route::resource('orders', TeknisiOrderController::class)->except(['create', 'store']);
        Route::resource('customer', TeknisiCustomerController::class)->except(['create', 'store']);
        Route::resource('service', TeknisiServiceController::class)->except(['create', 'store']);
        Route::resource('pendapatan', TeknisiPendapatanController::class)->only(['index']);
    });

// ---
// Rute untuk Customer
Route::middleware(['auth', EnsureUserHasRole::class . ':customer'])
    ->prefix('customer')
    ->name('customer.')
    ->group(function () {
        Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');
        Route::get('/services', [CustomerServiceController::class, 'index'])->name('service.index');
        Route::resource('orders', CustomerOrderController::class)->only(['index', 'store', 'show', 'create']);

        Route::resource('payments', CustomerPaymentController::class)->only(['index', 'show']);
        Route::get('/payments/{payment}/upload', [CustomerPaymentController::class, 'uploadProof'])->name('payments.upload');
        Route::post('/payments/{payment}/upload', [CustomerPaymentController::class, 'storeProof'])->name('payments.store-proof');

        Route::resource('profile', CustomerProfileController::class)->only(['index', 'show', 'edit', 'update']);
        Route::resource('review', CustomerReviewController::class)->only(['index', 'show']);
    });

require __DIR__.'/auth.php';