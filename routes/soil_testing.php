<?php

use App\Http\Controllers\SoilTestController;
use App\Http\Controllers\PaymentWebhookController;
use Illuminate\Support\Facades\Route;

// Soil Testing Routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/soil/dashboard', [SoilTestController::class, 'dashboard'])->name('soil.dashboard');
    
    // Test Management
    Route::post('/soil/tests', [SoilTestController::class, 'store'])->name('soil.tests.store');
    Route::get('/vendors/nearby', [SoilTestController::class, 'nearbyVendors'])->name('vendors.nearby');
    Route::post('/soil/tests/{soilTest}/book', [SoilTestController::class, 'book'])->name('soil.tests.book');
    Route::post('/soil/tests/{soilTest}/pay', [SoilTestController::class, 'pay'])->name('soil.tests.pay');
    Route::post('/soil/tests/{soilTest}/confirm-pickup', [SoilTestController::class, 'confirmPickup'])->name('soil.tests.confirm-pickup');
    
    // Sample Recording
    Route::post('/samples/{sampleLocation}/record', [SoilTestController::class, 'recordSample'])->name('samples.record');
    
    // Results & Analysis
    Route::get('/soil/tests/{soilTest}/overview', [SoilTestController::class, 'overview'])->name('soil.tests.overview');
    Route::get('/soil/tests/{soilTest}/analysis', [SoilTestController::class, 'analysis'])->name('soil.tests.analysis');
    Route::get('/soil/history', [SoilTestController::class, 'history'])->name('soil.history');
});

// Payment Webhooks (no auth required)
Route::post('/payments/webhook', [PaymentWebhookController::class, 'handle'])->name('payments.webhook');
